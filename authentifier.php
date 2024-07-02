<?php
session_start();
$loginError = '';
if (isset($_SESSION['loginError'])) {
    $loginError = $_SESSION['loginError'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .background {
            background: linear-gradient(135deg, rgba(6, 57, 112, 1) 0%, rgba(6, 57, 112, 0.5) 100%);
        }
        .form-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        .show-hide-button {
            cursor: pointer;
        }
    </style>
</head>
<body class="background flex items-center justify-center min-h-screen">
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <div class="w-full max-w-sm p-8 space-y-6 bg-white rounded-lg shadow-lg form-container" x-data="{ showPass: false }">
        <div class="text-center mb-4">
            <h6 class="font-semibold text-[#063970] text-2xl">Login</h6>
        </div>
        <form class="space-y-5" action="verification.php" method="POST">
            <div>
                <input id="loginAdmin" type="text" name="loginAdmin" class="block w-full py-3 px-4 mt-2 text-gray-800 appearance-none border-2 border-gray-200 focus:text-gray-900 focus:outline-none focus:border-gray-300 rounded-md" placeholder="Login" required/>
            </div>
            <div class="relative w-full">
                <input :type="showPass ? 'text' : 'password'" id="password" name="motPasse" class="block w-full py-3 px-4 mt-2 text-gray-800 appearance-none border-2 border-gray-200 focus:text-gray-900 focus:outline-none focus:border-gray-300 rounded-md" placeholder="Mot de passe" required/>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 show-hide-button" @click="showPass = !showPass">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path d="M12 17.6a7.5 7.5 0 01-7.5-7.5c0-2.194.944-4.176 2.44-5.563M7.99 6.99a9.5 9.5 0 000 10.02"/>
                        <path d="M12 6.5C8.4 6.5 5.5 9.402 5.5 12s2.9 5.5 6.5 5.5 6.5-2.898 6.5-5.5S15.6 6.5 12 6.5zM12 14a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                    
                </div>
                <span class="text-red-500 text-sm"><?= $loginError ?></span>
            </div>
            <button type="submit" class="w-full py-3 mt-6 bg-[#063970] rounded-md font-medium text-white uppercase focus:outline-none hover:bg-[#052c5e]">
                S'authentifier
            </button>
        </form>
    </div>
</body>
</html>
