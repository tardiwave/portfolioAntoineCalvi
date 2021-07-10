<?php

namespace App\Validators;

use App\Validator;
use App\Table\SettingsTable;
class SettingsValidator extends AbstractValidator{

    public function __construct(array $data, SettingsTable $table, ?int $id = null)
    {
        Validator::lang('fr');
        parent::__construct($data);
        $this->validator->rule('required', ['perPage', 'imageGap']);
    }
}