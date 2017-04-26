<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/radiorain/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <title> Log In</title>
    </head>
    <body>
        <h1>Log In</h1>
        <p>Effettuare il login per visualizzare la pagina richiesta.</p>
        <?php if (isset($loginError)): ?>
            <p> <?php htmlout($loginError); ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <div>
                <label for="name">name:<input type="text" name="name"
                                                id="name"></label>
            </div>
            <div>
                <label for="password">password:<input type="password" name="password"
                                                id="password"></label>
            </div>
            <div>
                <input type="hidden" name="action" value="login">
                <input type="submit" value="Login">
            </div>
        </form>
            <p><a href="/radiorain/">Torna alla home </a></p>
    </body>
</html>