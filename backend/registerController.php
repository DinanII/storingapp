<?php

    // Username
    $username = $_POST["username"];
    if(empty($username))
    {
        $msg = "Vul een username in";
        header("Location: ../login?action=register.php?msg=$msg");
    }

    // Controle: Bestaat user niet in tabel
    require_once "conn.php";
    $query = "SELECT * FROM users WHERE username = :username";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":username" => $username
    ]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($statement->rowCount() >= 1)
    {
        $msg = "Er bestaat al een account met deze username!";
        header("Location: ../login?action=register.php?msg=$msg");
    }

    // Naam
    $name = $_POST["name"];
    if(empty($name) || $name == "")
    {
        $msg = "Vul een naam in \n";
        header("Location: ../login?action=register.php?msg=$msg");
    }


    // Email
    $emailInput = $_POST["email"];

    // Email leeg?
    if(empty($emailInput) || $emailInput == "")
    {
        $msg = "Voer een email in \n";
        header("Location: ../login?action=register.php?msg=$msg");
    }

    // Geldigheid email
    if(filter_var($emailInput, FILTER_VALIDATE_EMAIL) === false)
    {
        $msg = "Het zojuist ingevoerde emailadres is ongeldig \n ";
        header("Location: ../login?action=register.php?msg=$msg");
    }





    // Wachtwoord
    $passwInput = $_POST["password"];
    $passwInputCheck = $_POST["password_check"];

    // Leeg
    if(empty($passwInput) || empty($passwInputCheck) || $passwInput == "" || $passwInputCheck == "")
    {
        $msg = "Een of meerdere wachtwoordvelden niet ingevuld \n";
        header("Location: ../login?action=register.php?msg=$msg");
    }

    if($passwInput != $passwInputCheck)
    {
        $msg = "Wachtwoord is onjuist \n";
        header("Location: ../login.php?action=register.php?msg=$msg");
    }

    // password hash | Let op de variabelenamen
    $password = password_hash($passwInput, PASSWORD_DEFAULT);



    // Admin
    $admin = 0;
    $manager = 0;



    // insert
    require_once "conn.php";


    $query = "INSERT INTO users (name, username, password) VALUES (:name, :username, :password)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":name" => $name,
        ":username" => $username,
        ":password" => $password,
  
    ]);
    
    $registered = true;

    if($registered)
    {
        require_once "conn.php";

        $query = "SELECT * FROM users WHERE username = :username";
        $statement = $conn->prepare($query);
        $statement->execute([
            ":username" => $username
        ]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["department"] = $user["afdeling"];
        header("Location: ../meldingen/index.php");
    }

?>