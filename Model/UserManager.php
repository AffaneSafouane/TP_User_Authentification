<?php
class UserManager
{
    private PDO $db;

    public function __construct(PDO $db1)
    {
        $this->db = $db1;
    }

    public function login(User $user): User|null
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE email = :email');

        $req->execute([
            "email" => $user->getEmail()
        ]);

        $data = $req->fetch();

        if ($data && password_verify($user->getPassword(), $data['password'])) {
            $verifiedUser = new User();
            $verifiedUser->hydrate($data);
            return $verifiedUser;
        }

        return null;
    }

    public function create(User $user): bool
    {
        $passwordHash = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $user->setPassword($passwordHash);

        $req = $this->db->prepare(
            'INSERT INTO users (lastName, firstName, email, address, postalCode, city, password, admin) VALUES (:lastName, :firstName, :email, :address, :cp, :city, :password, :admin)'
        );

        $req->execute(
            [
                'lastName' => $user->getLastName(),
                'firstName' => $user->getFirstName(),
                'email' => $user->getEmail(),
                'address' => $user->getAddress(),
                'cp' => $user->getPostalCode(),
                'city' => $user->getCity(),
                'password' => $passwordHash,
                'admin' => 0
            ]
        );

        if ($req->errorCode() != null) {
            return false;
        }

        return true;
    }

    /** 
     * @return User[]
     */
    public function findAll(): array
    {
        $users = [];
        $req = $this->db->prepare(
            'SELECT * FROM users'
        );
        $req->execute();
        $fetchUsers = $req->fetchAll();
        foreach ($fetchUsers as $fetchUser) {
            $user = new User();
            $user->hydrate($fetchUser);
            $users[] = $user;
        }
        return $users;
    }

    final public function findOne(int $id): ?User
    {
        $req = $this->db->prepare(
            'SELECT * FROM users WHERE id = ?'
        );
        $req->bindParam('i', $id);
        $fetchUser = $req->fetch();
        if (!$fetchUser) {
            return null;
        }
        $user = new User();
        $user->hydrate($fetchUser);
        return $user;
    }

    final public function findByEmail(string $email): ?User
    {
        $req = $this->db->prepare(
            'SELECT * FROM users WHERE email = ?'
        );

        $req->bindParam('s', $email);
        $fetchUser = $req->fetch();
        if (!$fetchUser) {
            return null;
        }

        $user = new User();
        $user->hydrate($fetchUser);

        return $user;
    }

    final public function update(User $user): bool
    {
        $req = $this->db->prepare(
            'UPDATE users SET email=:email, password=:password, firstName=:firstName, lastName:lastName, address=:address, postalCode=:postalCode, city=:city WHERE id = :id'
        );

        $req->execute(
            [
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'address' => $user->getAddress(),
                'postalCode' => $user->getPostalCode(),
                'city' => $user->getCity()
            ]
        );

        if ($req->errorCode() != null) {
            return false;
        }

        return true;
    }

    final public function delete(User $user): bool
    {
        $req = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $req->execute([
            'id' => $user->getId()
        ]);

        if ($req->errorCode() != null) {
            return false;
        }

        return true;
    }
}
