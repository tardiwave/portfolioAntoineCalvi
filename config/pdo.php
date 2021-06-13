<?php
    $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '0000');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>