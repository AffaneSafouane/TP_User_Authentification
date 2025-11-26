<?php
require_once 'Validator/StringSanitizer.php';

class CreateUserValidator extends StringSanitizer
{
    public int $id;
    public string $email;
    public string $password;
    public string $firstName;
    public string $lastName;
    public string $address;
    public string $postalCode;
    public string $city;

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

        foreach ($this->data as $input) {
            if (!isset($input) || empty($input)) {
                $errors['empty'] = 'Veuillez remplir tous les champs du formulaire';
                return $errors;
            }
        }
        
        if (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Veuillez entrer une adresse email valide';
        }

        $this->checkLength('password', 6, 255, $errors);
        $this->checkLength('firstName', 3, 50, $errors);
        $this->checkLength('lastName', 3, 50, $errors);
        $this->checkLength('address', 3, 150, $errors);

        if (strlen($this->data['postalCode']) !== 5 || !ctype_digit($this->data['postalCode'])) {
            $errors['postalCode'] = 'Veuillez entrer un code postal à 5 chiffres';
        }

        return $errors;
    }
}
