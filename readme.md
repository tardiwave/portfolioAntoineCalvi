# Portfolio Antoine Calvi

This project was bootstrapped by [Antoine Tardivel](https://www.antoinetardivel.com/).

## ⚡️ Prepare the app locally

* Execute `composer install`
* Execute `composer dump-autoload`
* Use bdd.sql to create tables in the database

## ⚡️ Start the app locally

* Change the connection informations in Connection.php in /utils/
* Execute `php -S localhost:8000 -t .\public\` in root file

## 💨 Publish the app

* Change the connection informations in Connection.php in /utils/
* remove admirer.php in /public/
* Prohibit the display of php errors in the browser -> uncomment `//error_reporting(0);` in /public/index.php
