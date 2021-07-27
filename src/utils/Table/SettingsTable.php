<?php

namespace App\Table;

use App\Models\Settings;

use \PDO;

final class SettingsTable extends Table{

    protected $table = 'settings';

    protected $class = Settings::class;

}  