<?php
require_once 'Validator/CreateUserValidator.php';
require_once 'Validator/UserLoginValidator.php';

class UserController
{
    private PDO $db;
    private $userManager;
    private $user;

    public function __construct(PDO $db1)
    {
        require_once 'Model/User.php';
        require_once 'Model/UserManager.php';
        $this->userManager = new UserManager($db1);
        $this->db = $db1;
    }

    public function login(): void
    {
        $title = 'Login';
        ob_start();
        require 'View/pages/login.php';
        $content = ob_get_clean();

        require 'View/layout.php';
    }

    public function doLogin(): void
    {
        $validation = new UserLoginValidator($_POST);
        $errors = $validation->validate();
        if (!empty($errors)) {
            $_SESSION['ERRORS'] = $errors;
            header('Location: index.php?ctrl=user&action=login');
            exit;
        }

        $this->user = new User();
        $this->user->setEmail($_POST['email']);
        $this->user->setPassword($_POST['password']);

        $result = $this->userManager->login($this->user);

        if ($result):
            $_SESSION['SUCCESS'] = "Connexion réussie. Bonjour " . $result->getFirstName() .".";
            $_SESSION['USER'] = $result;
            header('Location: index.php?ctrl=category&action=display');
            exit;
        else:
            $_SESSION['ERRORS'] = "Identifiants incorrects.";
            header('Location: index.php?ctrl=user&action=login');
            exit;
        endif;
    }

    public function create(): void 
    {
        $title = 'Create';
        ob_start();
        require 'View/pages/create.php';
        $content = ob_get_clean();

        require 'View/layout.php';
    }

    public function doCreate(): void
    {
        $validation = new CreateUserValidator($_POST);
        $errors = $validation->validate();
        if (!empty($errors)) {
            $_SESSION['ERRORS'] = $errors;
            header('Location: index.php?ctrl=user&action=create');
            exit;
        }

        $alreadyExist = $this->userManager->findByEmail($_POST['email']);
        if (!$alreadyExist) {
            $newUser = new User();
            $newUser->hydrate($_POST);
            $this->userManager->create($newUser);
            $_SESSION['SUCCESS'] = 'Utilisateur créer avec succés';
            header('Location: index.php?ctrl=user&action=login');
            exit;
        } else {
            $_SESSION['ERRORS'] = "ERROR : This email (" . $_POST['email'] . ") is used by another user";
            header('Location: index.php?ctrl=user&action=create');
            exit;
        }
    }

    public function logout(): void
    {
        unset($_SESSION['USER']);
        header('Location: index.php?ctrl=user&action=login');
        exit;
    }

    public function usersList(): void
    {
        if (!isset($_SESSION['USER'])) {
            header('Location: index.php?ctrl=category&action=unauthorized');
            exit;
        }

        $title = 'User List';
        $users = $this->userManager->findAll();
        ob_start();
        require 'View/pages/userList.php';
        $content = ob_get_clean();

        require 'View/layout.php';
    }
}