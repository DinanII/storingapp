<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../head.php"?>
    <title>Melding bewerken</title>
</head>
<body>
    <?php require_once "../header.php" ?>

    <main>
        <?php 

            $conn = require_once "../backend/conn.php";
            $id = $_GET['id'];
            $query = "SELECT * FROM meldingen WHERE id = :id";
            $statement = $conn->prepare($query);
            $statement->execute([":id" => $id]);

        ?>
        <form action="../backend/meldingenController.php">
            <input type="hidden" id="<?php echo $id ?>">
        </form>
    </main>
</body>
</html>