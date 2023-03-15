<?php

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


$melder = $_POST['melder'];

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
    $prioriteit = "Ja";
}
else 
{
    $prioriteit = "Nee";
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
$query = "INSERT INTO meldingen (attractie, capaciteit, melder, attrType, prioriteit, overige_info, gemeld_op) VALUES(:attractie, :capaciteit, :melder, :attrType, :prioriteit, :overige_info, :gemeld_op)";


//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([

    ":attractie" => $attractie,
    ":capaciteit" => $capaciteit,
    ":melder" => $melder,
    ":attrType" => $attrType,
    ":prioriteit" => $prioriteit,
    ":overige_info" => $overige_info,
    ":gemeld_op" => $gemeldOp
]);



header("Location: ../meldingen/index.php?msg=Melding opgeslagen");
?>