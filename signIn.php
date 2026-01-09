<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi</title>
</head>
    <body>
        <h1>Recensioni film</h1>
        <h2>Hai già un account? Accedi</h2>

        <?php    
            $nickname=$email="";
            $nicknameErr=$emailErr="";
            $exists=false;
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty($_POST["nickname"]) || !preg_match("/^[a-zA-ZÀ-ÿ'!? -]+$/",$_POST["nickname"])){
                    $nicknameErr="Nickname obbligatorio";
                }else{
                    if (preg_match("/^[a-zA-Z-' ]*$/",$nickname)) {
                        $nickname=sanitize($_POST["nickname"]);
                    }
                }

                if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                    $emailErr="Email obbligatorio. Rispettare il formato mail valido";
                }else{
                    $email=sanitize($_POST["email"]);
                }

                $users = fopen("utenti.csv", "r") or die("Unable to open file!");    
                while(($currentLine = fgets($users)) !== false){
                    $subUser=explode(",",$currentLine);
                    if ($subUser[2] === $nickname && $subUser[3]=== $email) {
                        $exists = true;
                    }
                }
                fclose($users);
                if (!$exists) {
                    echo "<h3>Credenziali errate, riprovare.<br></h3>";
                } else {

                    $_SESSION["nickname"]=$nickname;

                    #echo "Trovato!";
                    header("Location: review.php");
                }
            }

            #Funzioni
            function sanitize($data){
                $data=trim($data);
                $data=stripslashes($data);
                $data=htmlspecialchars($data);
                return $data;
            }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"    method="post">
            <label for="nickname">Nickname:</label><br>
                <input type="text" name="nickname" value="<?php echo $nickname;?>">
                <span class="error">* <?php echo $nicknameErr;?></span><br><br>

                <label for="email">Email:</label><br>
                <input type="email" name="email" value="<?php echo $email;?>">
                <span class="error">* <?php echo $emailErr;?></span><br><br>

                <input type="submit" value="Accedi">
        </form>

        <h3><a href="index.php">Sei nuovo? Registrati</a></h3>
    </body>
</html>