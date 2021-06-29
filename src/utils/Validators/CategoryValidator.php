<?php

namespace App\Validators;

use App\Validator;
use App\Table\CategoryTable;

class CategoryValidator extends AbstractValidator{

    public function __construct(array $data, CategoryTable $table, ?int $id = null)
    {
        Validator::lang('fr');
        parent::__construct($data);
        $this->validator->rule('required', ['name', 'slug']);
        $this->validator->rule('lengthBetween', ['name', 'slug'], 5, 200);
        $this->validator->rule('slug', 'slug');
        $this->validator->rule(function($field, $value) use ($table, $id){
            return !$table->exist($field, $value, $id);
        }, 'slug', 'Ce slug est déjà utilisé.');
    }

}