<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinescope - Home Page</title>
    <link rel="stylesheet" href="static\css\style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="">

    <!--
    <header class=" mt-[4vh] h-[8vh] w-[90%] border-t-[1px] border-b-[1px] border-white">
        <div class="logo flex gap-2 items-center h-[100%]">
            <img src="" alt="logo">
            <h3 class="text-white">CINESCOPE</h3>
        </div>
        <div class="menu h-[100%]">

        </div>
    </header>
    -->

    <!--Git profile-->
    <div class="gitLink absolute h-[55vh] w-[100vw] flex justify-end mt-[20px] mr-[20px]">
        <a href="https://github.com/FrancescoScanni"><img class="w-[60px] h-[60px] ml-[40px]" src="static\media\git.png" alt=""></a>
    </div>
    
    <!--Leading image-->
    <div class="mainIMG">
        <img src="static\media\mainMOB.jpg" class="w-[100vw] h-[55vh] rounded-b-[30px]" alt="">
    </div>

    <!--Hero containing card and user items-->
    <div class="mainHero flex flex-col items-center mt-[14px]">
        <h1 class="text-[56px] font-semibold font-serif text-center">Cinescope<span class="font-bold text-[#da813c]">.</span></h1>
        <!--Browsing Menu-->
        <div class="menu flex gap-4 mt-3">
            <div class="menuItem "><a href="allReviews.php">Reviews</a></div>
            <div class="menuItem"><a href="menuDom\film.php">Films</a></div>
        </div>
        <!--User logs-->
        <div class="user w-[100%] bg-[#0e56ff] flex justify-between mt-9 h-[8vh] bg-[#000000] rounded-[15px] px-[16px] py-[15px]">
            <div class="logs flex gap-3">
                <div class="log signIn">
                    <button class="white">Log in</button>
                </div>
                <div class="split bg-[#ffffff] w-[1px]"></div>
                <div class="log signUp">
                    <button>Sign up</button>
                </div>
            </div>
            
            <div class="icon w-[45px] rounded-[10px] bg-[#fffeff]">
                <img src="static\media\user.png" class="p-1 w-[100%] h-[100%]" alt="">
            </div>
        </div>
        <!--Repo link-->
        <div class="repo menuItem  mt-7 text-center w-[]">
            <a href="https://github.com/FrancescoScanni/Film-Review-App.git">GitHub Repo link</a>
        </div>
    </div>
    <!--Footer for copyright-->
    <footer class="text-[#000000] text-[12px] mt-[20px]">© 2026 Francesco Scanni | All rights reserved</footer>
    

    <script src="static\js\main.js"></script>
</body>
</html>