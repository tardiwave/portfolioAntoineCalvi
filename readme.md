# Template php

This project was bootstrapped by [Antoine Tardivel](https://www.antoinetardivel.com/).

## ⚡️ Préparer l'app en local

* Executer `composer update`
* Executer `composer dump-autoload`

## ⚡️ Lancer l'app en local 

* Change the connection informations in Connection.php in /utils/
* Executer `php -S localhost:8000 -t .\public\` in root file

## 💨 Publier l'app

* Change the connection informations in Connection.php in /utils/
* remove admirer.php in /public/
* Prohibit the display of php errors in the browser -> uncomment `//error_reporting(0);` in /public/index.php