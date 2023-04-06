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
            require_once "../backend/conn.php"; // 1. Databaseverbinding (conn.php) ophalen.
            $query = "SELECT * FROM meldingen"; // 2. Query typen 
            $statement = $conn->prepare($query); // 3. Statement preparen
            $statement->execute(); // 4. Statement uitvoeren
            $meldingen = $statement->FetchAll(PDO::FETCH_ASSOC); // 5. Resultaat opslaan
        ?>

        <table>
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
                        <td><?php echo $melding["attrType"];?></td>
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
