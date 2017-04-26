<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/access.inc.php';

if (!userIsLoggedIn()) {
    include'../login.html.php';
    exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'upload') {
    // Bail out if the file isn't really an upload
    if (!is_uploaded_file($_FILES['upload']['tmp_name'])) {
        $error = 'There was no file uploaded!';
        include $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/error.html.php';
        exit();
    }
    $uploadfile = $_FILES['upload']['tmp_name'];
    $uploadname = $_FILES['upload']['name'];
    $uploadtype = $_FILES['upload']['type'];
    $uploaddesc = $_POST['desc'];
    //$uploaddata = file_get_contents($uploadfile);

    include 'db.inc.php';
    //percorso della cartella dove mettere i file caricati dagli utenti
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/radiorain/upload/file/';
    if (move_uploaded_file($uploadfile, $uploaddir . $uploadname)) {
        //Se l'operazione è andata a buon fine...
        echo 'File inviato con successo.';
    } else {
        //Se l'operazione è fallta...
        echo 'Upload NON valido!';
    }
    try {
        $sql = 'INSERT INTO filestore SET
        filename = :filename,
        mimetype = :mimetype,
        description = :description';
        $s = $pdo->prepare($sql);
        $s->bindValue(':filename', $uploadname);
        $s->bindValue(':mimetype', $uploadtype);
        $s->bindValue(':description', $uploaddesc);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Database error storing file! ' . $e;
        include $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/error.html.php';
        exit();
    }


    header('Location: .');
    exit();
}


include 'files.html.php';
?>