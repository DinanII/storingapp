<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Aanpassen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    <?php 

    if(!isset($_GET['id'])){
        echo "Geef in je aanpaslink op de index.php het id van betreffende item mee achter de URL in je a-element om deze pagina werkend te krijgen na invoer van je vijfstappenplan";
        exit;

    }
    ?>
    <?php
        $conn = require_once '../header.php'; ?>

    <div class="container">
        <h1>Melding aanpassen</h1>

        <?php
        //Haal het id uit de URL:
        $id = $_GET['id'];

        //1. Haal de verbinding erbij
        require_once "../backend/conn.php";

        //2. Query, vul deze aan met een WHERE zodat je alleen de melding met dit id ophaalt
        $query = "SELECT * FROM meldingen WHERE id = $id";

        //3. Van query naar statement
        $statement = $conn->prepare($query);

        //4. Voer de query uit, voeg hier nog de placeholder toe
        $statement->execute();
        

        // $statement->execute([
        //     $attractie => ":attractie", 
        //     $capaciteit =>":capaciteit",
        //     $melder => ":melder",
        //     $attrType => ":attrType",
        //     $prioriteit => ":prioriteit",
        //     $overige_info => ":overige_info",
        // ]);

        //5. Ophalen gegevens, tip: gebruik hier fetch().
        $melding = $statement->Fetch(PDO::FETCH_ASSOC);
        ?>

        <form action="../backend/meldingenController.php?id=<?php echo $melding["id"];?>" method="POST">
            <input type="hidden" name="action" value="update">

            <div class="form-group">
                <label>Naam attractie:</label>
                <p><?php echo $melding['attractie'] ?></p>
            </div>
            <!-- Zorg dat het type wordt getoond, net als de naam hierboven -->
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input"
                    value="<?php echo $melding['capaciteit']; ?>">
            </div>
            <div class="form-group">
                <label for="prioriteit">Prio:</label>
                <!-- Let op: de checkbox blijft nu altijd uit, pas dit nog aan -->
                <input type="checkbox" name="prioriteit" id="prioriteit">
                <label for="prioriteit">Melding met prioriteit</label>
            </div>
            <div class="form-group"> 
                <label for="melder">Naam melder:</label>
                <!-- Voeg hieronder nog een value-attribuut toe, zoals bij capaciteit -->
                <input type="text" name="melder" id="melder" class="form-input">
            </div>
            <div class="form-group">
                <label for="overig">Overige info:</label>
                <textarea name="overige_info" id="overige_info" class="form-input" rows="4"><?php echo $melding["overige_info"]; ?></textarea>
            </div>
            
            <input type="submit" value="Melding opslaan">

        </form>
        <form action="../backend/meldingenController.php" method="POST">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Verwijderen">
        </form>

    </div>  

</body>

</html>
