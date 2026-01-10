<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - Codescope</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body class="bg-[#fffeff] w-[100vw] flex flex-col items-center min-h-screen h-[100%]">
        <h1 class="text-[42px] font-semibold mt-[40px]">Cinescope<span class="text-[#da813c]">.</span></h1>
        <p class="px-[40px] text-[16px] text-center font-semibold">Log in to share and discover and mark from 1 to 10 famous films from an online archive.</p>

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
                    echo "<h3>Wrong credentials, try again.<br></h3>";
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

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"    method="post" class="bg-[#0e56ff] p-8 rounded-[24px] w-[90%] mx-auto mt-10">
            <label for="nickname" class="block text-[22px] text-white font-semibold">Nickname:</label><br>
            <input type="text" name="nickname" class="w-full p-2 rounded mt-1 mb-2" value="<?php echo $nickname;?>">
            <span class="error text-[12px] text-yellow-300">* <?php echo $nicknameErr;?></span><br><br>

            <label for="email" class="block text-white font-semibold text-[22px]">Email:</label><br>
            <input type="email" name="email" class="w-full p-2 rounded mt-1 mb-2" value="<?php echo $email;?>">
            <span class="error text-[12px] text-yellow-300">* <?php echo $emailErr;?></span><br><br>

            <input type="submit" class="w-full bg-[#da813c] text-white font-bold py-2 px-4 rounded cursor-pointer mt-6" value="Log in">
        </form>

        <h3 class="text-center mt-10 text-[#000000] text-[20px] "><a href="registra.php">New? Sign up and discover</a></h3>
        <footer class=" absolute text-[#000000] text-[12px] mt-[92vh]">© 2026 Francesco Scanni | All rights reserved</footer>
    </body>
</html>