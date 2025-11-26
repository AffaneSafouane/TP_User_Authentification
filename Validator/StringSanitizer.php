<?php
class StringSanitizer
{
    /**
     * @var string[]
     */
    public array $data = [];

    /**
     * Summary of __construct
     * @param string[] $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Get the value of data
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Set the value of data
     * @var string[]
     * @return self
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function sanitizeInput(array $fieldsToExclude = []): void
    {
        foreach($this->data as $key => $value) {
            if(in_array($key, $fieldsToExclude)) {
                continue;
            }
            
            $value = trim($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            $this->data[$key] = $value;
        }
    }

    public function checkLength(String $field, int $min, int $max, array &$errors): void
    {
        $len = strlen($this->data[$field] ?? '');
        if($len < $min || $len > $max) {
            $errors[$field] = "Le champs $field doit contenir entre $min et $max de caractères.";
        }
    }
}
