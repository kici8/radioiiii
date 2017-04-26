<?php

function userIsLoggedIn() {
    if (isset($_POST['action'])and $_POST['action'] == 'login') {
        if (!isset($_POST['name'])or $_POST['name'] == '' or ! isset($_POST['password']) or $_POST['password'] == '') {
            $GLOBALS['loginError'] = 'Riempire entrambi i campi';
            return FALSE;
        }

        $password = md5($_POST['password'] . 'radiorain');

        if (databaseContainsUser($_POST['name'], $password)) {
            session_start();
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['password'] = $password;
            return TRUE;
        } else {
            session_start();
            unset($_SESSION['loggedIn']);
            unset($_SESSION['name']);
            unset($_SESSION['password']);
            $GLOBALS['loginError'] = 'Password o username.';
            return FALSE;
        }
    }

    if (isset($_POST['action']) and $_POST['action'] == 'logout') {
        session_start();
        unset($_SESSION['loggedIn']);
        unset($_SESSION['name']);
        unset($_SESSION['password']);
        header('Location: ' . $_POST['goto']);
        exit();
    }

    session_start();
    if (isset($_SESSION['loggedIn'])) {
        return databaseContainsUser($_SESSION['name'], $_SESSION['password']);
    }
}

function databaseContainsUser($name, $password) {
    include 'db.inc.php';

    try {
        $sql = 'SELECT COUNT(*) FROM utente
                WHERE name=:name AND password=:password';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $name);
        $s->bindValue(':password', $password);
        $s->execute();
    } catch (PDOException $ex) {
        $error = 'Errore in ricerca utente';
        include 'error.html.php';
        exit();
    }

    $row = $s->fetch();
    if ($row[0] > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

?>