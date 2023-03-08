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


$extra = $_POST["extra"];

if(isset($_POST['prioriteit']))
{
    $prioriteit = "True";
}
else 
{
    $prioriteit = "False";
}


echo $attractie . " / " . $capaciteit . " / " . $melder . "/" . $attrType . "/" . $extra . "/" . $prioriteit;

//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, capaciteit, melder, attrType, prioriteit, extra) VALUES(:attractie, :capaciteit, :melder, :attrType, :prioriteit, :extra)";


//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([

    ":attractie" => $attractie,
    ":capaciteit" => $capaciteit,
    ":melder" => $melder,
    ":attrType" => $attrType,
    ":prioriteit" => $prioriteit,
    ":extra" => $extra,
]);

if(isset($errors))
{
    var_dump($errors);
    die();
}

header("Location: ../meldingen/index.php?msg=Melding opgeslagen");
?>