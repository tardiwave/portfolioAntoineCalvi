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

    public function input(string $key, string $label, bool $required): string
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
        $star = null;
        $needed = null;
        if($required){
            $star = "<span title='required'>*</span>";
            $needed = "required";
        }
        return <<<HTML
        <div>
            <div class="mb-3">
                <label for="field{$key}" class="form-label">{$label} {$star}</label>
                <input type="{$type}" class="form-control" id="field{$key}" class="{$this->inputClass($key)}" name="{$key}" value="{$value}" {$needed}>
                {$this->getinvalidFeedback($key)}
            </div>
        </div>
HTML;
    }

    public function file(string $key, string $label): string
    {
        $inputClass = '';
        if(isset($this->errors[$key])){
            $inputClass .= ' is-invalid';
        }
        return <<<HTML
        <div class="w-100">
            <div class="mb-3 w-100">
                <label for="fieldimage" class="form-label">{$label}<span title="required">*</span></label>
                <input type="file" class="form-control w-100" id="field{$key}" class="{$this->inputClass($key)}" name="image" enctype="multipart/form-data">
                {$this->getinvalidFeedback($key)}
            </div>
        </div>
HTML;
    }

    public function checkbox($key, string $label): string
    {
        $checked = null;
        $value = $this->getValue($key);
        if($value === 'on'){
            $checked = 'checked';
        }else{
            $checked = '';
        }
        return <<<HTML
        <div>
            <div class="mb-3">
                <input type="checkbox" id="scales" name="{$key}" {$checked}>
                <label for="field{$key}" class="form-label">{$label}</label> 
                {$this->getinvalidFeedback($key)}
            </div>
        </div>
HTML;
    }

    public function textarea(string $key, string $label, bool $required): string
    {
        $value = $this->getValue($key);
        $star = null;
        $needed = null;
        if($required){
            $star = "<span title='required'>*</span>";
            $needed = "required";
        }
        return <<<HTML
        <div>
            <div class="mb-3">
                <label for="field{$key}" class="form-label">{$label} {$star}</label>
                <textarea type="text" class="form-control" id="field{$key}" class="{$this->inputClass($key)}" name="{$key}"  {$needed}>{$value}</textarea>
                {$this->getinvalidFeedback($key)}
            </div>
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
            <div class="mb-3">
                <label for="field{$key}" class="form-label">{$label}<span title="required">*</span></label>
                <select type="text" class="form-control" id="field{$key}" class="{$this->inputClass($key)}" name="{$key}[]" multiple>
                    {$optionsHTML}
                </select>
                {$this->getinvalidFeedback($key)}
            </div>
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
                $allErrors = $this->errors[$key];
                $upFChar = function($value)
                {
                    $value = ucfirst(ltrim($value));
                    return $value;
                };
                $allErrors = array_map($upFChar, $allErrors);
                $error = implode('<br>', $allErrors);
            }else {
                $error = $this->errors[$key];
            }
            return "<div class='form-text text-danger'>" . $error . "</div>";
        }
        return '';
    }

}

