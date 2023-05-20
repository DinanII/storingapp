<?php 
    session_start();
    if(isset($_SESSION["user_id"]))
    {
        require_once "backend/config.php";
        $msg = "je bent al ingelogd";
        header("Location: $base_url/meldingen/index.php?msg=je bent al ingelogd");
        exit;
    }
    if(!isset($_GET["action"]) || $_GET["action"] == "login") 
    {
        $action = "login";
        $controller = "loginController.php";
    }
    else if($_GET["action"] == "register") 
    {
        $action = "register";
        $controller = "registerController.php";
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

        <form action="backend/<?php echo $controller; ?>" method="POST">
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" placeholder="Username">
            </div>
            <?php if($action == "register"):?>
                    <div class="form-group">
                        <label for="name">Naam:</label>
                        <input type="text" name="name" id="username-field" class="login-form-field" placeholder="Naam" required />
                    </div>
                    <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" id="username-field" class="login-form-field" placeholder="E-mail adress" required>
                    </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" id="passw" placeholder="Uw geheime code">
            </div>
            <?php if($action == "register"):?>
                        <div class="form-group">
                            <label for="password_check">Herhaal Password:</label>
                            <input type="password" name="password_check" id="password-field-check" class="login-form-field" placeholder="Uw geheime code" required>
                        </div>
                    <?php endif;?>
            <input type="submit" value="submit">
        </form>
        <div class="container">
            <?php if($action == "login"): ?>
                Geen account? <a href="login.php?action=register">Registreren</a>
            <?php else: ?>
                Al een account? <a href="login.php?action=login">Inloggen</a>
            <?php endif;?>
        </div>
    </div>

</body>

</html>
