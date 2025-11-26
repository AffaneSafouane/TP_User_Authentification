<?php
require_once 'Validator/StringSanitizer.php';

class UserLoginValidator extends StringSanitizer
{
    public string $email;
    public string $password;

    public function hydrate(array $data)
    {
        foreach($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function validate(): array
    {
        $errors = [];

        $this->sanitizeInput(['password']);

        if (empty($this->data['email']) || empty($this->data['password'])) {
            $errors['empty'] = 'Veuillez remplir tous les champs (email et mot de passe).';
            return $errors; 
        }
        
        if (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Veuillez entrer une adresse email valide.';
        }

        return $errors;
    }
}