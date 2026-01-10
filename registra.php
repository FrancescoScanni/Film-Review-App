<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
</head> 
    <body>
        <h1>Recensioni film</h1>
        <h2>Registrati</h2>

        <?php
            #File managment
            $users = fopen("utenti.csv", "a+") or die("Unable to open file!");
            $exists=false;

            #Form validation
            $name=$surname=$nickname=$email=$password="";
            $nameErr=$surnameErr=$nicknameErr=$emailErr=$passwordErr="";
            $user="";
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if (empty($_POST["name"]) || !preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])){
                    $nameErr="Nome obbligatorio. Ricorda, solo lettere alfabetiche.";
                }else{
                    $name=sanitize($_POST["name"]);
                }

                if(empty($_POST["surname"])|| !preg_match("/^[a-zA-Z-' ]*$/",$_POST["surname"])){
                    $surnameErr="Cognome obbligatorio. Ricorda, solo lettere alfabetiche.";
                }else{
                    $surname=sanitize($_POST["surname"]);
                }

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

                if(empty($_POST["password"]) || !preg_match("/^(?=.*[0-9])(?=.*[^a-zA-Z0-9])\S{10,}$/", $_POST["password"]) ){
                    $passwordErr="Passkey obbligatorio";
                }else{
                    $password=sanitize($_POST["password"]);
                }


                if (!empty($name) && !empty($surname) && !empty($nickname) && !empty($email) && !empty($password)) {

                    $user = "$name,$surname,$nickname,$email,$password\n";
                    $exists = false;
                    $users = fopen("utenti.csv", "r") or die("Unable to open file!");
                    while (($currentLine = fgets($users)) !== false) {
                        $subUser = explode(",", $currentLine);
                        if ($subUser[2] === $nickname && $subUser[3] === $email) {
                            $exists = true;
                            break;
                        }
                    }
                    fclose($users);

                if (!$exists) {
                    $users = fopen("utenti.csv", "a");
                    fwrite($users, $user);
                    fclose($users);
                    echo "Utente registrato con successo";
                } else {
                    header("Location: signIn.php");
                }
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

                <label for="nome">Nome:</label><br>
                <input type="text" name="name" value="<?php echo $name;?>">
                <span class="error">* <?php echo $nameErr;?></span><br><br>

                <label for="cognome">Cognome:</label><br>
                <input type="text" name="surname" value="<?php echo $surname;?>">
                <span class="error">* <?php echo $surnameErr;?></span><br><br>

                <label for="nickname">Nickname:</label><br>
                <input type="text" name="nickname" value="<?php echo $nickname;?>">
                <span class="error">* <?php echo $nicknameErr;?></span><br><br>

                <label for="email">Email:</label><br>
                <input type="email" name="email" value="<?php echo $email;?>">
                <span class="error">* <?php echo $emailErr;?></span><br><br>

                <label for="password">Password:</label><br>
                <input type="password" name="password" value="<?php echo $password;?>">
                <span class="error">* <?php echo $passwordErr;?></span><br><br>


                <input type="submit" value="Registrati">
        </form>
            
        <h3><a href="signIn.php">Hai già un account? Accedi</a></h3>
    </body>
</html>