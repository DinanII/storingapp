<!doctype html>
<html lang="nl">

<?php
    session_start();
    if(!isset($_SESSION["user_id"]))
    {
        $msg = "je moet nog inloggen";
        header("Location: ../login.php?msg=$msg");
        exit;
    }
?>

<head>
    <title>StoringApp / Meldingen / Nieuw</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>

    <div class="container">
        <h1>Nieuwe melding</h1>

        <form action="../backend/meldingenController.php" method="POST">
            <input type="hidden" name="action" value="create">
            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie" class="form-input">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value="">- Kies een type - </option>
                    <option value="achtbaan">Achtbaan</option>
                    <option value="draaiend">Draaiend</option>
                    <option value="kinder">Kinderattractie</option>
                    <option value="horeca">Horeca</option>
                    <option value="show">Show</option>
                    <option value="water">Water</option>
                    <option value="overig">Overig</option>
                </select>


            </div>
            <div class="form-group">

                <input type="hidden" name="action" value="create">

                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input">
            </div>
            <div>
                <div class="form-group">
                    <label for="prioriteit">Prio</label>
                    <input type="checkbox" name="prioriteit" id="prioriteit">
                    <label for="prioriteit">Melding met prioriteit</label>
                </div>
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <span><?php echo $_SESSION["username"]; ?></span>
                <!-- <input type="text" name="melder" id="melder" class="form-input"> -->
            </div>
            <div class="form-group">
                <label for="overige_info">Overige info</label>
                <textarea name="overige_info" id="overige_info" cols="80" rows="10"></textarea>
            </div>
            
            <input type="submit" value="Verstuur melding">

        </form>
    </div>  

</body>

</html>
