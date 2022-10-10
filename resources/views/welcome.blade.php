<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>

        <!-- Styles -->
        <style>
            
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            
            <div class="h-screen pb-14 bg-right bg-cover" style="background-image:url('');">
                <!--Nav-->
                <div class="w-full container mx-auto p-6">
                        
                    <div class="w-full flex items-center justify-between">
                        <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"  href="#"> 
                            <svg class="h-8 fill-current text-indigo-600 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"/></svg> LWALLET
                        </a>
                        
                        <div class="flex w-1/2 justify-end content-center">		
                            
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                @endif
                            @endauth
                        @endif


                        </div>
                        
                    </div>

                </div>

                <!--Main-->
                <div class="container pt-24 md:pt-48 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
                    
                    <!--Left Col-->
                    <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
                        <h1 class="my-4 text-3xl md:text-5xl text-purple-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1 upper">Follow who sabi road</h1>
                        <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">Manage all your finances on the go with Lwallet app!</p>
                    
                        <p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center md:text-left fade-in">Download our app:</p>
                        <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in">
                            <img src="App Store.svg" class="h-12 pr-4 bounce-top-icons">
                            <img src="Play Store.svg" class="h-12 bounce-top-icons">
                        </div>

                    </div>
                    
                    <!--Right Col-->
                    <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
                        <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom" src="devices.svg">
                    </div>
                    
                    <!--Footer-->
                    <div class="w-full pt-16 pb-6 text-sm text-center md:text-left fade-in">
                        <a class="text-gray-500 no-underline hover:no-underline" href="#">&copy; LWALLET 2022</a>
                    </div>
                    
                </div>
                
            </div>

        </div>
    </body>
</html>
