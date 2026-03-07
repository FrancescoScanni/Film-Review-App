<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinescope - Home Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        body { font-family: ui-serif, Georgia, Cambria, "Times New Roman", Times, serif; }
    </style>
</head>
<body class="bg-white flex flex-col items-center min-h-screen">

    <div class="absolute z-10 w-full flex justify-end p-5 md:p-10">
        <a href="https://github.com/FrancescoScanni" class="hover:opacity-80 transition-opacity">
            <img class="w-[50px] h-[50px] md:w-[70px] md:h-[70px]" src="static/media/git.png" alt="GitHub Profile">
        </a>
    </div>

    
    
    <div class="w-full lg:hidden xl:hidden">
        <img src="static/media/mainMOB.jpg" 
             class="w-full h-[50vh] md:h-[60vh] lg:h-[70vh] object-cover rounded-b-[30px] md:rounded-b-[50px] shadow-lg" 
             alt="Hero Image">
    </div>

    <main class="mainHero flex flex-col items-center mt-6 px-4 w-full max-w-[600px] md:max-w-[800px]">
        
        <h1 class="text-[56px] md:text-[80px] font-semibold text-center leading-tight">
            Cinescope<span class="font-bold text-[#da813c]">.</span>
        </h1>

        <!--Sub-Paragraph-->
        <div class="hidden md:flex w-full  lg:h-[40vh]  rounded-b-[50px] shadow-sm flex-col justify-center items-center px-10 text-center">
            <h2 class="text-3xl lg:text-3xl font-serif font-semibold text-gray-800 mb-5">
                Dive into the World of Cinema
            </h2>
            <p class="text-gray-600 text-lg max-w-[700px] leading-relaxed">
                Welcome to your ultimate destination for film critique and cinematic exploration. At Cinescope, we dive deep into the latest blockbusters, timeless classics, and hidden indie gems. Read our in-depth reviews, discover your next favorite movie, and join a community of passionate cinephiles.
            </p>
        </div>

        <div class="menu flex gap-6 mt-3 text-lg md:text-xl font-medium">
            <div class="menuItem hover:text-[#ffffff] bg-[#da813c]  p-2 rounded-[15px] transition-colors">
                <a href="signIn.php">Reviews</a>
            </div>
        
        </div>

        <div class="user w-full max-w-[400px] md:max-w-[500px] bg-black lg:bg-[#0e56ff] flex justify-between items-center mt-9 h-[70px] rounded-[20px] px-5 shadow-xl">
            <div class="logs flex gap-4 items-center h-full">
                <div class="log signIn text-white font-medium hover:text-[#da813c] cursor-pointer">
                    <button>Log in</button>
                </div>
                <div class="split bg-white/30 w-[1px] h-[30%]"></div>
                <div class="log signUp text-white font-medium hover:text-[#da813c] cursor-pointer">
                    <button>Sign up</button>
                </div>
            </div>
            
            <div class="icon w-[45px] h-[45px] rounded-[12px] bg-white overflow-hidden flex items-center justify-center">
                <img src="static/media/user.png" class="w-[80%] h-[80%] object-contain" alt="User Icon">
            </div>
        </div>

        <div class="repo menuItem mt-8 text-center text-gray-600 hover:text-black transition-all">
            <a href="https://github.com/FrancescoScanni/Film-Review-App.git" class="border-b border-gray-300 pb-1">
                GitHub Repo link
            </a>
        </div>
    </main>

    <footer class="text-gray-500 text-[12px] my-10 text-center">
        © 2026 Francesco Scanni | All rights reserved
    </footer>
    
    <script src="static/js/main.js"></script>
</body>
</html>