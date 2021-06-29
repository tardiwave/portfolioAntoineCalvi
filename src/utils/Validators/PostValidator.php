<?php

namespace App\Validators;

use App\Validator;
use App\Table\PostTable;

class PostValidator extends AbstractValidator{

    public function __construct(array $data, PostTable $table, ?int $postId = null, array $categoriesIds)
    {
        Validator::lang('fr');
        parent::__construct($data);
        $this->validator->rule('required', ['name', 'slug']);
        $this->validator->rule('lengthBetween', ['name', 'slug'], 5, 200);
        $this->validator->rule('slug', 'slug');
        $this->validator->rule(function($field, $value) use ($table, $postId){
            return !$table->exist($field, $value, $postId);
        }, 'slug', 'Ce slug est déjà utilisé.');
        $this->validator->rule('image', 'image');
        $this->validator->rule('subset', 'categories_ids', array_keys($categoriesIds));
    }

}