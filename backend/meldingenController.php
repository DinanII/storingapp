<?php
session_start();
if(!isset($_SESSION["user_id"]))
{
    $msg = "je moet nog inloggen";
    header("Location: ../login.php?msg=$msg");
    exit;
}

$action = $_POST['action'];

if ($action == "create")
{
    //Variabelen vullen
    $attractie = $_POST['attractie'];

    if(empty($attractie))
    {
        $errors[] = "Vul de attractie-naam in";
    }


    $capaciteit = $_POST['capaciteit']; 

    if(!is_numeric($capaciteit))
    {
        $errors[] = "De capaciteit moet een nummer zijn";
    }


    $melder = $_SESSION["username"];

    if(empty($melder))
    {
        $errors[] = "Dit veld mag niet leeg zijn!";
    }


    $attrType = $_POST['type'];

    if(empty($attrType))
    {
        $errors[] = "Het type mag niet leeg zijn!";
    }


    $overige_info = $_POST["overige_info"];

    if(isset($_POST['prioriteit']))
    {
        $prioriteit = true;
    }
    else 
    {
        $prioriteit = false;
    }


    $gemeldOp = date('Y-m-d');

    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    //1. Verbinding
    require_once 'conn.php';

    //2. Query
    $query = "INSERT INTO meldingen (creator_id, status, attractie, capaciteit, melder, attrType, prioriteit, overige_info, gemeld_op) VALUES(:creator_id, :status, :attractie, :capaciteit, :melder, :attrType, :prioriteit, :overige_info, :gemeld_op)";


    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
        ":creator_id" => $_SESSION["user_id"],
        ":status" => "todo",
        ":attractie" => $attractie,
        ":capaciteit" => $capaciteit,
        ":melder" => $melder,
        ":attrType" => $attrType,
        ":prioriteit" => $prioriteit,
        ":overige_info" => $overige_info,
        ":gemeld_op" => $gemeldOp
    ]);



    header("Location: ../meldingen/index.php?msg=Melding opgeslagen");
}
else if ($action == "update")
{
    $capaciteit = $_POST["capaciteit"];
    $melder = strval($_POST["melder"]);
    $overige_info = $_POST["overige_info"];
    $id = $_GET['id'];

    if(isset($_POST["prioriteit"]))
    {
        $prioriteit = true;
    }
    else 
    {
        $prioriteit = false;
    }

    require_once "conn.php";
    $query = "UPDATE meldingen SET capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, overige_info = :overige_info WHERE id = :id";
    
    $statement = $conn->prepare($query);
    $statement->execute([
        ":capaciteit" => $capaciteit,
        ":prioriteit" => $prioriteit,
        ":melder" => $melder,
        ":overige_info" => $overige_info,
        ":id" => $id             
    ]);

}
else if ($action == "delete")
{
    $id = $_POST["id"];
    
    require_once "../backend/conn.php";

    $query = "DELETE FROM meldingen WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":id" => $id
    ]);
}
header("Location: ../meldingen/index.php");
?>