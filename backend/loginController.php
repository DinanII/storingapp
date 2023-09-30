<?php
    session_start();

    $user = $_POST["username"];
    $pass = $_POST["password"];

    require_once "conn.php";

    $query = "SELECT * FROM users WHERE username = :username";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":username" => $user
    ]);

    $item = $statement->fetch(PDO::FETCH_ASSOC);

    if($statement->rowCount() < 1)
    {
        die("Account bestaat niet");
    }

    if(!password_verify($pass, $item["password"]))
    {
        die("Wachtwoord is onjuist");
    }


    $_SESSION["user_id"] = $item["id"];
    $_SESSION["username"] = $item["username"];
    require_once "config.php";
    header("Location: $base_url/meldingen/index.php");
?>