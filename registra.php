<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Cinescope</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head> 
    <body class="bg-[#fffeff] w-[100vw] flex flex-col items-center">
        <h1 class="text-[42px] font-semibold mt-[40px]">Cinescope<span class="text-[#da813c]">.</span></h1>
        <p class="px-[40px] text-[16px] text-center font-semibold">Join our community to share and discover movie reviews from film lovers worldwide.</p>

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

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="bg-[#0e56ff] p-8 rounded-[24px] w-[90%] mx-auto mt-10">
            <label for="nome" class="block text-white font-semibold">Name:</label>
            <input type="text" name="name" value="<?php echo $name;?>" class="w-full p-2 rounded mt-1 mb-2">
            <span class="error text-[12px] text-yellow-300">* <?php echo $nameErr;?></span><br>

            <label for="cognome" class="block text-white font-semibold">Surname:</label>
            <input type="text" name="surname" value="<?php echo $surname;?>" class="w-full p-2 rounded mt-1 mb-2">
            <span class="error text-[12px] text-yellow-300">* <?php echo $surnameErr;?></span><br>

            <label for="nickname" class="block text-white font-semibold">Nickname:</label>
            <input type="text" name="nickname" value="<?php echo $nickname;?>" class="w-full p-2 rounded mt-1 mb-2">
            <span class="error text-[12px] text-yellow-300">* <?php echo $nicknameErr;?></span><br>

            <label for="email" class="block text-white font-semibold">Email:</label>
            <input type="email" name="email" value="<?php echo $email;?>" class="w-full p-2 rounded mt-1 mb-2">
            <span class="error text-[12px] text-yellow-300">* <?php echo $emailErr;?></span><br>

            <label for="password" class="block text-white font-semibold">Password:</label>
            <input type="password" name="password" value="<?php echo $password;?>" class="w-full p-2 rounded mt-1 mb-4">
            <span class="error text-[12px] text-yellow-300">* <?php echo $passwordErr;?></span><br>

            <input type="submit" value="Create Account" class="w-full bg-[#da813c] text-white font-bold py-2 px-4 rounded cursor-pointer mt-6">
        </form>

        <h3 class="text-center mt-4 text-[#000000]"><a href="signIn.php" class="underline hover:text-gray-300">Already have an account? Sign in</a></h3>
        <footer class="text-[#000000] text-[12px] mt-[20px]">© 2026 Francesco Scanni | All rights reserved</footer>
    </body>
</html>