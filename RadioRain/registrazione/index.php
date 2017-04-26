<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/access.inc.php';


include $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/db.inc.php';

$pageTitle = 'Nuovo Utente';
$action = 'addform';
$name = '';
$email = '';
$id = '';
$button = 'Registrazione';

include 'registrazione.html.php';

if (isset($_GET['addform'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/db.inc.php';
    try {
        $sql = 'INSERT INTO utente SET
            name = :name,
            email = :email';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();
    } catch (PDOException $ex) {
        $error = 'Errore in registrazione utente' . $ex;
        include $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/error.html.php';
        exit();
    }

    $id = $pdo->lastInsertId();

    if ($_POST['password'] != '') {
        $password = md5($_POST['password'] . 'radiorain');
        try {
            $sql = 'UPDATE utente SET
                password=:password
                WHERE id=:id';
            $s = $pdo->prepare($sql);
            $s->bindValue(':password', $password);
            $s->bindValue(':id', $id);
            $s->execute();
        } catch (PDOException $ex) {
            $error = 'Errore in impostazione password utente' . $ex;
            include $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/error.html.php';
            exit();
        }
    }
    header('Location: ..');
    exit();
}
?>
    