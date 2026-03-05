<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reviews</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fffeff] min-h-screen flex flex-col items-center">

    <h1 class="text-[42px] font-semibold mt-[40px]">
        Cinescope<span class="text-[#da813c]">.</span>
    </h1>

    <p class="text-center mt-2 text-[18px] font-semibold">
        Here are all the sorted reviews
    </p>

    <div class="bg-[#0e56ff] text-white p-8 rounded-[24px] w-[90%] max-w-[500px] mt-10">

<?php   
    $nickname=$_SESSION["nickname"];
    $recensioni = fopen("$nickname.csv", "r");
    $allRecensioni=[];

    while(($currentLine = fgets($recensioni)) !== false){
        $subUser=explode(",",$currentLine);
        $allRecensioni[]=$subUser[0].",".$subUser[1].",".$subUser[2];
    }

    if(!empty($allRecensioni)){
        usort($allRecensioni, function ($a, $b) {
            $votoA = (int) explode(",", $a)[2];
            $votoB = (int) explode(",", $b)[2];
            return $votoB <=> $votoA;
        }); 

        $i=0;
        foreach($allRecensioni as $rec){
            $i++;
            echo "<p class='mb-2 font-semibold'>$i. $rec</p>";
        }
        $i=0;

    }else{
        echo "<p class='text-yellow-300 font-semibold'>No reviews yet</p>";
    }
?>

    </div>

    <h4 class="mt-6 text-center">
        <a href="review.php"
           class="underline text-[#0e56ff] hover:text-[#da813c] font-semibold">
           Back
        </a>
    </h4>

</body>
</html>