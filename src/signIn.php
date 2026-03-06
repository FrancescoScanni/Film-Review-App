<?php
    session_start();
    
    $nickname = $email = "";
    $nicknameErr = $emailErr = "";
    $exists = false;
    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Messaggio tradotto in: "Nickname is required"
        if (empty($_POST["nickname"]) || !preg_match("/^[a-zA-ZÀ-ÿ'!? -]+$/", $_POST["nickname"])) {
            $nicknameErr = "Nickname is required";
        } else {
            $nickname = sanitize($_POST["nickname"]);
        }

        // Messaggio tradotto in: "Email is required. Please use a valid format"
        if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email is required. Please use a valid email format";
        } else {
            $email = sanitize($_POST["email"]);
        }

        if (!empty($nickname) && !empty($email)) {
            $users = fopen("utenti.csv", "r") or die("Unable to open file!");    
            while (($currentLine = fgets($users)) !== false) {
                $subUser = explode(",", $currentLine);
                if (isset($subUser[2]) && isset($subUser[3])) {
                    if (trim($subUser[2]) === $nickname && trim($subUser[3]) === $email) {
                        $exists = true;
                        break;
                    }
                }
            }
            fclose($users);

            if (!$exists) {
                // Messaggio tradotto in: "Invalid credentials, please try again."
                $errorMessage = "Invalid credentials, please try again.";
            } else {
                $_SESSION["nickname"] = $nickname;
                header('Location: review.php');
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
    <title>Log in - Cinescope</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fffeff] w-full flex flex-col items-center min-h-screen">

    <div class=" md:flex w-full h-[25vh] bg-gray-50 rounded-b-[30px] border-b border-gray-100 flex-col justify-center items-center px-10 text-center mt-5 shadow-sm">
        <h2 class="text-4xl lg:text-5xl font-serif font-semibold text-gray-800 mb-4">
            Welcome Back to the Front Row
        </h2>
        <p class="text-gray-600 text-lg max-w-[700px] leading-relaxed">
            Ready to rate your next cinematic experience? Log in to access our global movie archive, share your 1-to-10 scores, and see what other film lovers are talking about.
        </p>
    </div>
    

    <?php if ($errorMessage): ?>
        <div class="mt-4 text-red-600 font-bold"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" 
          class="bg-[#0e56ff] p-8 rounded-[24px] w-[90%] md:max-w-[450px] mt-5 shadow-xl">
        
        <label for="nickname" class="block text-[22px] text-white font-semibold">Nickname:</label>
        <input type="text" name="nickname" class="w-full p-2 rounded mt-1 mb-2 outline-none focus:ring-2 focus:ring-[#da813c]">
        <span class="error text-[12px] text-yellow-300">* <?php echo $nicknameErr;?></span><br>

        <label for="email" class="block text-white font-semibold text-[22px] mt-4">Email:</label>
        <input type="email" name="email" class="w-full p-2 rounded mt-1 mb-2 outline-none focus:ring-2 focus:ring-[#da813c]">
        <span class="error text-[12px] text-yellow-300">* <?php echo $emailErr;?></span><br>

        <input type="submit" class="w-full bg-[#da813c] text-white font-bold py-3 px-4 rounded cursor-pointer mt-6 hover:bg-[#c47132] transition-colors" value="Log in">
    </form>

    <h3 class="text-center mt-5 text-[#000000] text-[16px]">
        <a href="registra.php" class="underline hover:text-[#0e56ff]">New? Sign up and discover</a>
    </h3>

    <footer class="text-[#000000] text-[12px] mt-auto pt-10 pb-4">
        © 2026 Francesco Scanni | All rights reserved
    </footer>

</body>
</html>