<?php

namespace App\Table;

use App\Models\News;

use \PDO;

final class NewsTable extends Table{

    protected $table = 'news';

    protected $class = News::class;

}  