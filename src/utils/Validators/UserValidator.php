<?php

namespace App\Validators;

use App\Validator;
use App\Table\UserTable;
class UserValidator extends AbstractValidator{

    public function __construct(array $data, UserTable $table, ?int $id = null)
    {
        Validator::lang('fr');
        parent::__construct($data);
        $this->validator->rule('required', ['firstname', 'lastname', 'mail', 'work', 'birth', 'status', 'description']);
        $this->validator->rule('lengthBetween', ['description'], 5, 500);
    }
}