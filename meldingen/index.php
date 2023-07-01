<?php 
    session_start();
    if(!isset($_SESSION["user_id"]))
    {
        $msg = "je moet nog inloggen";
        header("Location: ../login.php?msg=$msg");
        exit;
    }

?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once "../head.php"; ?>
</head>

<body>

    <?php require_once "../header.php"; ?>
    
    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        
        <!-- <div style="height: 300px; background: #ededed; display: flex; justify-content: center; align-items: center; color: #666666;">Hier komen de meldingen...</div> -->


        <?php

            if( (empty($_GET["category"])) || (($_GET["category"]) == "") )
            {
                require_once "../backend/conn.php"; // 1. Databaseverbinding (conn.php) ophalen.
                $query = "SELECT * FROM meldingen "; // 2. Query typen // WHERE creator_id = :user_id ... ORDER BY gemeld_op DESC
                $statement = $conn->prepare($query); // 3. Statement preparen
                $statement->execute(); // 4. Statement uitvoeren  // [":user_id" => $_SESSION["user_id"]
                $meldingen = $statement->FetchAll(PDO::FETCH_ASSOC); // 5. Resultaat opslaan
            }
            else if(!empty($_GET["category"]))
            {
                require_once "../backend/conn.php"; // 1. Databaseverbinding (conn.php) ophalen.
                $query = "SELECT * FROM meldingen WHERE attrType = :category "; // 2. Query typen // creator_id = :user_id AND ...  ORDER BY gemeld_op DESC
                $statement = $conn->prepare($query); // 3. Statement preparen
                $statement->execute([
                    ":category" => $_GET["category"]
                ]); // 4. Statement uitvoeren
                $meldingen = $statement->FetchAll(PDO::FETCH_ASSOC); // 5. Resultaat opslaan
            }
        ?>


        <div class="flexbcontainer">
            
            <span class="amout">Aantal meldingen: <strong><?php echo Count($meldingen); ?></strong></span>  
    
            <!-- Action attribuut leeg? -> Formulier wordt naar pagina zelf verzonden -->
            <form action="" method="GET">
                <select name="category" id="status">
                    <option value=""> - Kies status om te filteren - </option>
                    <option value="achtbaan">Achtbaan</option>
                    <option value="draaiend">Draaiend</option>
                    <option value="kinder">Kinder</option>
                    <option value="horeca">Horeca</option>
                    <option value="show">Show</option>
                    <option value="water">Water</option>
                    <option value="overig">Overig</option>
                </select>
                <input type="submit" value="filter">
            </form>
        </div>
    
        <table class="meldingen">
            <tr>
                <th>Attractie</th>
                <th>Capaciteit</th>
                <th>Attractietype</th>
                <th>Melder</th>
                <th>Overige Info</th>
                <th>Prioriteit</th>
                <th>Gemeld op</th>
                <th>Aanpassen</th>
            </tr>
            <?php 
               
                foreach($meldingen as $melding): ?>
                    <tr>
                        <td><?php echo $melding["attractie"];?></td>
                        <td><?php echo $melding["capaciteit"];?></td>
                        <td><?php echo ucfirst($melding["attrType"]);?></td>
                        <td><?php echo $melding["melder"];?></td>
                        <td><?php echo $melding["overige_info"];?></td>
                        <td><?php echo $melding["prioriteit"]; ?></td>
                        <td><?php echo $melding["gemeld_op"]; ?></td>
                        <td><a href="edit.php?id=<?php echo $melding["id"];?>">Aanpassen</a></td>
                    </tr>
                    <?php endforeach; 
                
            ?>

        </table>
        <!-- PHP Print_r-->
        <!-- <p>
            <pre><?php // print_r($meldingen)  ?></pre>
        </p> -->
    </div>  

</body>

</html>
