<?php

namespace App\Http\Requests;

use App\Database\Models\Contract\Model;

class Validation
{
    private string $input; // input name
    private string $value; // value that user enter
    private array $errors = []; // errors will appeare
    private array $oldValues = [];
    /**
     * Get the value of input
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set the value of input
     *
     * @return  self
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->value = $value;
        $this->oldValues[$this->input] = $value; // make old value have thee value of input

        return $this;
    }

    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }
    public function required()
    {
        if (empty($this->value)) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} is required";
        }
        return $this;
    }
    public function max(int $max)
    {
        if (strlen($this->value) > $max) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} characters is greater than {$max}";
        }
        return $this;
    }
    public function min(int $min)
    {
        if (strlen($this->value) < $min) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} characters is less than {$min}";
        }
        return $this;
    }
    public function in(array $values)
    {
        if (!in_array($this->value, $values)) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} should be " . implode($values);
        }
        return $this;
    }
    public function regex(string $pattern, string $massage = "")
    {
        if (!preg_match($pattern, $this->value)) { // preg_match check if pattern is identical to the requirement or not and return 0 ,1
            $this->errors[$this->input][__FUNCTION__] = $massage ? $massage : "invalid {$this->input}  ";
        }
        return $this;
    }
    // to return one error
    public function getError(string $input): ?string // return string or null
    {
        if (isset($this->errors[$input])) {
            foreach ($this->errors[$input] as $error) {
                return $error;
            }
        }
        return null;
    }
    // design of error
    public function getMessage(string $input)
    {
        return "<p class='text-danger font-weight-bold'> " . ucwords(str_replace('_', ' ', $this->getError($input))) . " </p>";
    }
    public function confirmed(string $confirmationValue)
    {
        if ($this->value != $confirmationValue) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} not confirmed ";
        }
        return $this;
    }

    /**
     * Get the value of oldValues
     */
    public function getOldValues(string $input): ?string
    {
        return $this->oldValues[$input] ?? null;
    }
    public function unique(string $table, string $column)
    {
        $query = "SELECT * FROM {$table} WHERE {$column} = ?";
        $model = new Model; // becouse i dont kown which table will be used
        $stmt = $model->conn->prepare($query);
        $stmt->bind_param('s', $this->value);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {  // error exeist
            $this->errors[$this->input][__FUNCTION__] = "this {$this->input} already exists ";
        }
    }
    public function exists(string $table, string $column)
    {
        $query = "SELECT * FROM {$table} WHERE {$column} = ?";
        $model = new Model; // becouse i dont kown which table will be used
        $stmt = $model->conn->prepare($query);
        $stmt->bind_param('s', $this->value);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0  ) {  // error exeist
            $this->errors[$this->input][__FUNCTION__] = "this {$this->input}  not exists ";
        }
    }
    public function digits(int $digits)
    {
        if (strlen($this->value)  != $digits) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} {$digits} digits required ";
        }
        return $this;
    }
}

// $validation = new Validation;
// $validation->setInput("first name")->setValue("")->required()->min(2)->max(32);
// print_r($validation->getErrors());
