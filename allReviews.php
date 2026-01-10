<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutte le recensioni</title>
</head>
<body>
    <h1>Ecco tutte le recensioni ordinate</h1>
    <?php   
    $nickname=$_SESSION["nickname"];
    $recensioni = fopen("$nickname.csv", "r");
    while(($currentLine = fgets($recensioni)) !== false){
        $subUser=explode(",",$currentLine);
        $allRecensioni[]=$subUser[0].",".$subUser[1].",".$subUser[2];
    }

    if(!empty($allRecensioni)){
        usort($allRecensioni, function ($a, $b) { #ordinamento persnalizzato
        $votoA = (int) explode(",", $a)[2];
        #echo $votoA;
        $votoB = (int) explode(",", $b)[2];
        #echo $votoB;
        return $votoB <=> $votoA;
    }); 
    $i=0;
    foreach($allRecensioni as $rec){
        $i++;
        echo "<p>$i. $rec</p>";
    }
    $i=0;
    }else{
        echo "Ancora nessuna recensione";
    }
    ?>
    <h4><a href="review.php">Indietro</a></h4>
</body>
</html>