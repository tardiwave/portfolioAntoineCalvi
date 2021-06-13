<?php

namespace App\HTML;

class Form {

    private $data;

    private $errors;

    public function __construct(
        $data,
        array $errors
    )
    {
        $this->data = $data;

        $this->errors = $errors;

    }

    public function input(string $key, string $label): string
    {
        $value = $this->getValue($key);
        $type = 'text';
        if($key === 'password'){
            $type = 'password';
        }
        $inputClass = '';
        if(isset($this->errors[$key])){
            $inputClass .= ' is-invalid';
        }
        return <<<HTML
        <div>
            <div>
                <label for="field{$key}">{$label}</label>
                <input type="{$type}" id="field{$key}" class="{$this->inputClass($key)}" name="{$key}" value="{$value}" required>
                <span title="required">*</span>
            </div>
            {$this->getinvalidFeedback($key)}
        </div>
HTML;
    }

    public function textarea(string $key, string $label): string
    {
        $value = $this->getValue($key);
        return <<<HTML
        <div>
            <div>
                <label for="field{$key}">{$label}</label>
                <textarea type="text" id="field{$key}" class="{$this->inputClass($key)}" name="{$key}" required>{$value}</textarea>
                <span title="required">*</span>
            </div>
            {$this->getinvalidFeedback($key)}
        </div>
HTML;
    }

    public function select(string $key, string $label, array $options = []): string
    {
        $optionsHTML = [];
        $values = $this->getValue($key);
        foreach($options as $k => $v){
            $selected = in_array($k, $values) ? " selected" : "";
            $optionsHTML[] = "<option value=\"$k\"$selected>$v</option>";
        } 
        $optionsHTML = implode('', $optionsHTML);
        return <<<HTML
        <div>
            <div>
                <label for="field{$key}">{$label}</label>
                <select type="text" id="field{$key}" class="{$this->inputClass($key)}" name="{$key}[]" multiple>
                    {$optionsHTML}
                </select>
                <span title="required">*</span>
            </div>
            {$this->getinvalidFeedback($key)}
        </div>
HTML;
    }

    private function getValue(string $key)
    {
        if(is_array($this->data)){
            return $this->data[$key] ?? null;
        }
        $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
        $value = $this->data->$method();
        if($value instanceof \DateTimeInterface){
            return $value->format('Y-m-d H:i:s');
        }
        return $value;
    }

    private function inputClass(string $key): string
    {
        $inputClass = '';
        if(isset($this->errors[$key])){
            $inputClass .= ' is-invalid';
        }
        return $inputClass;
    }
    private function getinvalidFeedback(string $key): string
    {
        if(isset($this->errors[$key])){
            if(is_array($this->errors[$key])){
                $error = implode('<br>', $this->errors[$key]);
            }else {
                $error = $this->errors[$key];
            }
            return '<div>' . $error . '</div>';
        }
        return '';
    }

}

