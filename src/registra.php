<?php
    # File management
    $users = fopen("utenti.csv", "a+") or die("Unable to open file!");
    $exists = false;

    # Form validation
    $name = $surname = $nickname = $email = $password = "";
    $nameErr = $surnameErr = $nicknameErr = $emailErr = $passwordErr = "";
    $user = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"]) || !preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"])) {
            $nameErr = "Nome obbligatorio. Ricorda, solo lettere alfabetiche.";
        } else {
            $name = sanitize($_POST["name"]);
        }

        if (empty($_POST["surname"]) || !preg_match("/^[a-zA-Z-' ]*$/", $_POST["surname"])) {
            $surnameErr = "Cognome obbligatorio. Ricorda, solo lettere alfabetiche.";
        } else {
            $surname = sanitize($_POST["surname"]);
        }

        if (empty($_POST["nickname"]) || !preg_match("/^[a-zA-ZÀ-ÿ'!? -]+$/", $_POST["nickname"])) {
            $nicknameErr = "Nickname obbligatorio";
        } else {
            $nickname = sanitize($_POST["nickname"]);
        }

        if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email obbligatorio. Rispettare il formato mail valido";
        } else {
            $email = sanitize($_POST["email"]);
        }

        if (empty($_POST["password"]) || !preg_match("/^(?=.*[0-9])(?=.*[^a-zA-Z0-9])\S{10,}$/", $_POST["password"])) {
            $passwordErr = "Passkey obbligatorio";
        } else {
            $password = sanitize($_POST["password"]);
        }

        if (!empty($name) && !empty($surname) && !empty($nickname) && !empty($email) && !empty($password)) {
            $user = "$name,$surname,$nickname,$email,$password\n";
            $exists = false;
            $users = fopen("utenti.csv", "r") or die("Unable to open file!");
            while (($currentLine = fgets($users)) !== false) {
                $subUser = explode(",", $currentLine);
                if (isset($subUser[2]) && isset($subUser[3]) && $subUser[2] === $nickname && $subUser[3] === $email) {
                    $exists = true;
                    break;
                }
            }
            fclose($users);

            if (!$exists) {
                $users = fopen("utenti.csv", "a");
                fwrite($users, $user);
                fclose($users);
                echo "<h1 class='text-center text-green-600 font-bold'>Successfully signed in!</h1>";
            } else {
                header("Location: signIn.php");
                exit();
            }
        }
    }

    function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Cinescope</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head> 
<body class="bg-[#fffeff] min-h-screen flex flex-col items-center">

    <h1 class="text-[42px] md:text-[56px] font-semibold mt-[40px] text-center">
        Cinescope<span class="text-[#da813c]">.</span>
    </h1>

    <div class="hidden md:flex flex-col items-center mt-6 mb-4 px-10 text-center max-w-[800px]">
        <h2 class="text-2xl font-serif font-semibold text-gray-800 mb-2">Join the Cinephile Community</h2>
        <p class="text-gray-600 text-lg leading-relaxed">
            Create your account to start sharing your thoughts on the latest films. 
            Cinescope is where your voice matters—join thousands of users in the ultimate movie review experience.
        </p>
    </div>

    <p class="md:hidden px-[40px] text-[16px] text-center font-semibold mt-2">
        Join our community to share and discover movie reviews from film lovers worldwide.
    </p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" 
          class="bg-[#0e56ff] p-8 rounded-[24px] w-[90%] md:max-w-[500px] mt-10 shadow-2xl">
        
        <div class="mb-4">
            <label for="name" class="block text-white font-semibold">Name:</label>
            <input type="text" name="name" value="<?php echo $name;?>" class="w-full p-2 rounded mt-1 border-none focus:ring-2 focus:ring-[#da813c] outline-none">
            <span class="error text-[11px] text-yellow-300 font-medium"><?php echo $nameErr ? "* $nameErr" : ""; ?></span>
        </div>

        <div class="mb-4">
            <label for="surname" class="block text-white font-semibold">Surname:</label>
            <input type="text" name="surname" value="<?php echo $surname;?>" class="w-full p-2 rounded mt-1 border-none focus:ring-2 focus:ring-[#da813c] outline-none">
            <span class="error text-[11px] text-yellow-300 font-medium"><?php echo $surnameErr ? "* $surnameErr" : ""; ?></span>
        </div>

        <div class="mb-4">
            <label for="nickname" class="block text-white font-semibold">Nickname:</label>
            <input type="text" name="nickname" value="<?php echo $nickname;?>" class="w-full p-2 rounded mt-1 border-none focus:ring-2 focus:ring-[#da813c] outline-none">
            <span class="error text-[11px] text-yellow-300 font-medium"><?php echo $nicknameErr ? "* $nicknameErr" : ""; ?></span>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-white font-semibold">Email:</label>
            <input type="email" name="email" value="<?php echo $email;?>" class="w-full p-2 rounded mt-1 border-none focus:ring-2 focus:ring-[#da813c] outline-none">
            <span class="error text-[11px] text-yellow-300 font-medium"><?php echo $emailErr ? "* $emailErr" : ""; ?></span>
        </div>

        <div class="mb-6">
            <label for="password" class="block text-white font-semibold">Password:</label>
            <input type="password" name="password" class="w-full p-2 rounded mt-1 border-none focus:ring-2 focus:ring-[#da813c] outline-none">
            <span class="error text-[11px] text-yellow-300 font-medium"><?php echo $passwordErr ? "* $passwordErr" : ""; ?></span>
        </div>

        <input type="submit" value="Create Account" 
               class="w-full bg-[#da813c] hover:bg-[#c47132] text-white font-bold py-3 px-4 rounded-xl cursor-pointer transition-all shadow-md active:scale-95">
    </form>

    <h3 class="text-center mt-6 text-[#000000] font-medium">
        <a href="signIn.php" class="underline hover:text-[#0e56ff] transition-colors">Already have an account? Sign in</a>
    </h3>

    <footer class="text-[#000000] text-[12px] mt-auto pt-10 pb-4">
        © 2026 Francesco Scanni | All rights reserved
    </footer>

</body>
</html>