<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recensioni</title>
</head>
    <body>
        <h1>Benvenuto! <?php echo $_SESSION["nickname"]; ?>, pubblica qui le tue recensioni.</h1>
        <h3>Attribuisci un voto da 1 a 10 in base al film</h3>

        <?php   
            $allRecensioni=[];
            $allUsers=[];
            $nickname=$_SESSION["nickname"];
            $recensioni = fopen("$nickname.csv", "a+") or die("Unable to open file!");

            
            $film=$voto="";
            $filmErr=$votoErr="";
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if (empty($_POST["film"]) || !preg_match("/^[a-zA-Z-' ]*$/",$_POST["film"])){
                        $filmErr="Film obbligatorio. Ricorda, solo lettere alfabetiche.";
                }else{
                        $film=sanitize($_POST["film"]);
                }
                if(empty($_POST["voto"])){
                        $votoErr="Cognome obbligatorio. Ricorda, solo lettere alfabetiche.";
                }else{
                        $voto=sanitize($_POST["voto"]);
                }

                if(empty($filmErr) && empty($votoErr)){
                    $recensione = $_SESSION["nickname"] . "," . $film . "," . $voto . "\n";
                    $file = fopen("$nickname.csv", "a");
                    fwrite($file, $recensione);
                    fclose($file);
                }

                $recensioni = fopen("$nickname.csv", "r");
                while(($currentLine = fgets($recensioni)) !== false){
                    $subUser=explode(",",$currentLine);
                    if (!in_array($subUser[0], $allUsers)) {
                        $allUsers[] = $subUser[0];
                    }
                    $allRecensioni[]=$subUser[0].",".$subUser[1].",".$subUser[2];
                }
                usort($allRecensioni, function ($a, $b) { #ordinamento persnalizzato
                    $votoA = (int) explode(",", $a)[2];
                    #echo $votoA;
                    $votoB = (int) explode(",", $b)[2];
                    #echo $votoB;
                    return $votoB <=> $votoA;
                }); 
            }
                #print_r($allUsers);     
            
            #Funzioni
            function sanitize($data){
                $data=trim($data);
                $data=stripslashes($data);
                $data=htmlspecialchars($data);
                return $data;
            }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="">Film</label>
            <input type="" name="film">
            <span class="error"><?php echo $filmErr; ?></span>
            <br><br>
            <label for="">Voto</label>
            <input type="number" name="voto" min="0" max="10">
            <span class="error"><?php echo $votoErr; ?></span>
            <br><br>
            <input type="submit" value="Pubblica">
        </form>

        <br><hr>
        <h4><a href="allReviews.php">Visualizza tutte le recensioni oridinate</a></h4>
        
    </body>
</html>