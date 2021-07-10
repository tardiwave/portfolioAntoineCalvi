<?php

namespace App\Validators;

use App\Validator;
use App\Table\NewsTable;
class NewsValidator extends AbstractValidator{

    public function __construct(array $data, NewsTable $table, ?int $id = null)
    {
        Validator::lang('fr');
        parent::__construct($data);
    }
}