<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fffeff] min-h-screen flex flex-col items-center">

    <h1 class="text-[42px] font-semibold mt-[40px]">
        Cinescope<span class="text-[#da813c]">.</span>
    </h1>

    <p class="text-center mt-2 text-[18px] font-semibold px-6">
        Welcome <span class="text-[#0e56ff]"><?php echo $_SESSION["nickname"]; ?></span>, publish your movie reviews here.
    </p>

    <p class="text-center text-[14px] text-gray-600 mt-1">
        Give a rating from 1 to 10 based on the movie
    </p>

<?php   
    $allRecensioni=[];
    $allUsers=[];
    $nickname=$_SESSION["nickname"];
    $recensioni = fopen("$nickname.csv", "a+") or die("Unable to open file!");

    
    $film=$voto="";
    $filmErr=$votoErr="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["film"]) || !preg_match("/^[a-zA-Z-' ]*$/",$_POST["film"])){
                $filmErr="Movie required. Remember, only alphabetical letters.";
        }else{
                $film=sanitize($_POST["film"]);
        }
        if(empty($_POST["voto"])){
                $votoErr="Please enter a rating.";
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
        usort($allRecensioni, function ($a, $b) {
            $votoA = (int) explode(",", $a)[2];
            $votoB = (int) explode(",", $b)[2];
            return $votoB <=> $votoA;
        }); 
    }

    function sanitize($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
          method="post"
          class="bg-[#0e56ff] p-8 rounded-[24px] w-[90%] max-w-[500px] mt-10">

        <label class="block text-white font-semibold text-[20px]">Movie name</label>
        <input type="text" name="film" 
               class="w-full p-2 rounded mt-1 mb-2">
        <span class="text-[12px] text-yellow-300"><?php echo $filmErr; ?></span>

        <br><br>

        <label class="block text-white font-semibold text-[20px]">Rating (1-10)</label>
        <input type="number" name="voto" min="1" max="10"
               class="w-full p-2 rounded mt-1 mb-2">
        <span class="text-[12px] text-yellow-300"><?php echo $votoErr; ?></span>

        <br><br>

        <input type="submit" value="Publish"
               class="w-full bg-[#da813c] text-white font-bold py-2 px-4 rounded cursor-pointer mt-4 hover:opacity-90 transition">
    </form>

    <hr class="w-[80%] mt-10">

    <h4 class="mt-6 text-center">
        <a href="allReviews.php" 
           class="underline text-[#0e56ff] hover:text-[#da813c] font-semibold">
           View all sorted reviews
        </a>
        <br><br>
        <a href="index.php" 
           class="underline text-[#0e56ff] hover:text-[#da813c] font-semibold">
           Home screen (logout)
        </a>
    </h4>

</body>
</html>