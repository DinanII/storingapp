<?php 
    session_start();
    if(isset($_SESSION["user_id"]))
    {
        require_once "backend/config.php";
        $msg = "je bent al ingelogd";
        header("Location: $base_url/meldingen/index.php?msg=je bent al ingelogd");
        exit;
    }

?>



<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <?php require_once 'header.php'; ?>
    
    <?php
        if(isset($_GET["msg"]))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
    ?>
    <div class="container home">

    <form action="backend/loginController.php" method="POST">
        <div class="form-group">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="password" id="passw">
        </div>
        <input type="submit" value="submit">
    </form>

    </div>

</body>

</html>
