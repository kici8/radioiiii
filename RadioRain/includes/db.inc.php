<?php

try
{
    $pdo= new PDO('mysql:host=localhost;dbname=radiorain','root','root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
} catch (PDOException $e) 
{
    $error='Impossibile connettersi al server di database.';
    include 'error.html.php';
    exit();
}
?>
