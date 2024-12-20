<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="shortcut icon" href="{{ asset('logo-min.png') }}" type="image/x-icon">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-dvh flex flex-col">


    <header class="bg-white shadow ">
        <div class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8">
            <a class="block text-teal-600" href="{{ route('home') }}">
                <span class="sr-only">Home</span>
                <picture>
                    <img class="h-10 aspect-square" src="{{ asset('logo-min.png') }}" alt="logo">
                </picture>
                {{-- <svg class="h-8" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0.41 10.3847C1.14777 7.4194 2.85643 4.7861 5.2639 2.90424C7.6714 1.02234 10.6393 0 13.695 0C16.7507 0 19.7186 1.02234 22.1261 2.90424C24.5336 4.7861 26.2422 7.4194 26.98 10.3847H25.78C23.7557 10.3549 21.7729 10.9599 20.11 12.1147C20.014 12.1842 19.9138 12.2477 19.81 12.3047H19.67C19.5662 12.2477 19.466 12.1842 19.37 12.1147C17.6924 10.9866 15.7166 10.3841 13.695 10.3841C11.6734 10.3841 9.6976 10.9866 8.02 12.1147C7.924 12.1842 7.8238 12.2477 7.72 12.3047H7.58C7.4762 12.2477 7.376 12.1842 7.28 12.1147C5.6171 10.9599 3.6343 10.3549 1.61 10.3847H0.41ZM23.62 16.6547C24.236 16.175 24.9995 15.924 25.78 15.9447H27.39V12.7347H25.78C24.4052 12.7181 23.0619 13.146 21.95 13.9547C21.3243 14.416 20.5674 14.6649 19.79 14.6649C19.0126 14.6649 18.2557 14.416 17.63 13.9547C16.4899 13.1611 15.1341 12.7356 13.745 12.7356C12.3559 12.7356 11.0001 13.1611 9.86 13.9547C9.2343 14.416 8.4774 14.6649 7.7 14.6649C6.9226 14.6649 6.1657 14.416 5.54 13.9547C4.4144 13.1356 3.0518 12.7072 1.66 12.7347H0V15.9447H1.61C2.39051 15.924 3.154 16.175 3.77 16.6547C4.908 17.4489 6.2623 17.8747 7.65 17.8747C9.0377 17.8747 10.392 17.4489 11.53 16.6547C12.1468 16.1765 12.9097 15.9257 13.69 15.9447C14.4708 15.9223 15.2348 16.1735 15.85 16.6547C16.9901 17.4484 18.3459 17.8738 19.735 17.8738C21.1241 17.8738 22.4799 17.4484 23.62 16.6547ZM23.62 22.3947C24.236 21.915 24.9995 21.664 25.78 21.6847H27.39V18.4747H25.78C24.4052 18.4581 23.0619 18.886 21.95 19.6947C21.3243 20.156 20.5674 20.4049 19.79 20.4049C19.0126 20.4049 18.2557 20.156 17.63 19.6947C16.4899 18.9011 15.1341 18.4757 13.745 18.4757C12.3559 18.4757 11.0001 18.9011 9.86 19.6947C9.2343 20.156 8.4774 20.4049 7.7 20.4049C6.9226 20.4049 6.1657 20.156 5.54 19.6947C4.4144 18.8757 3.0518 18.4472 1.66 18.4747H0V21.6847H1.61C2.39051 21.664 3.154 21.915 3.77 22.3947C4.908 23.1889 6.2623 23.6147 7.65 23.6147C9.0377 23.6147 10.392 23.1889 11.53 22.3947C12.1468 21.9165 12.9097 21.6657 13.69 21.6847C14.4708 21.6623 15.2348 21.9135 15.85 22.3947C16.9901 23.1884 18.3459 23.6138 19.735 23.6138C21.1241 23.6138 22.4799 23.1884 23.62 22.3947Z"
                    fill="currentColor" />
            </svg> --}}
            </a>

            <div class="flex flex-1 items-center justify-end md:justify-between">
                <nav aria-label="Global" class="hidden md:block">
                    <ul class="flex items-center gap-6 text-sm">
                        {{-- <li>
                        <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> About </a>
                    </li>

                    <li>
                        <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> Careers </a>
                    </li>

                    <li>
                        <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> History </a>
                    </li>

                    <li>
                        <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> Services </a>
                    </li>

                    <li>
                        <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> Projects </a>
                    </li>

                    <li>
                        <a class="text-gray-500 transition hover:text-gray-500/75" href="#"> Blog </a>
                    </li> --}}
                    </ul>
                </nav>

                <div class="flex items-center gap-4">


                    @if (Route::has('login'))
                        <div class="sm:flex sm:gap-4">
                            @auth
                                <a class="block rounded-md bg-firefly-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-firefly-700"
                                    href="{{ route('dashboard') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            @else
                                <a class="block rounded-md bg-firefly-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-firefly-700"
                                    href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                                @if (Route::has('register'))
                                    <a class="hidden rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-firefly-600 transition hover:text-firefly-600/75 sm:block"
                                        href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif


                    <button
                        class="block rounded bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden">
                        <span class="sr-only">Toggle menu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="flex flex-col justify-center grow ">

        <section class="container mx-auto">
            <div class="max-w-screen-xl  px-4 py-8 sm:px-6 sm:py-12 lg:px-32 2xl:px-8 lg:py-16 mx-auto">
                <div class="grid grid-cols-1 gap-y-8 lg:grid-cols-2 lg:items-center lg:gap-x-16">
                    <div class="mx-auto max-w-lg text-center lg:mx-0 ltr:lg:text-left rtl:lg:text-right">
                        <picture class="flex justify-center mb-4">
                            <img class="h-20 md:h-36  aspect-square" src="{{ asset('logo-min.png') }}" alt="logo">
                        </picture>
                        <h2 class="text-3xl font-bold sm:text-4xl">Chessmatic</h2>

                        <p class="mt-4 text-gray-600 text-base md:text-lg">
                            ¡Haz que las matemáticas sean tan sabrosas como el queso fundido! En Chessmatic, los
                            alumnos de
                            segundo grado exploran un mundo de diversión y aprendizaje mientras mejoran sus habilidades
                            matemáticas.
                        </p>

                        <a href="{{ route('dashboard') }}"
                            class="mt-8 inline-block rounded-md bg-firefly-600 px-12 py-3 text-xl font-semibold text-white transition hover:bg-firefly-700 focus:outline-none focus:ring focus:ring-pearl-bush-400">
                            {{ __('Get started') }}
                        </a>
                    </div>
                    {{-- 
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                        <a class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
                            href="#">
                            <span class="inline-block rounded-lg bg-gray-50 p-3">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                                    </path>
                                </svg>
                            </span>

                            <h2 class="mt-2 font-bold">Accountant</h2>

                            <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                                Lorem ipsum dolor sit amet consectetur.
                            </p>
                        </a>

                        <a class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
                            href="#">
                            <span class="inline-block rounded-lg bg-gray-50 p-3">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                                    </path>
                                </svg>
                            </span>

                            <h2 class="mt-2 font-bold">Accountant</h2>

                            <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                                Lorem ipsum dolor sit amet consectetur.
                            </p>
                        </a>

                        <a class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
                            href="#">
                            <span class="inline-block rounded-lg bg-gray-50 p-3">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                                    </path>
                                </svg>
                            </span>

                            <h2 class="mt-2 font-bold">Accountant</h2>

                            <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                                Lorem ipsum dolor sit amet consectetur.
                            </p>
                        </a>

                        <a class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
                            href="#">
                            <span class="inline-block rounded-lg bg-gray-50 p-3">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                                    </path>
                                </svg>
                            </span>

                            <h2 class="mt-2 font-bold">Accountant</h2>

                            <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                                Lorem ipsum dolor sit amet consectetur.
                            </p>
                        </a>

                        <a class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
                            href="#">
                            <span class="inline-block rounded-lg bg-gray-50 p-3">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                                    </path>
                                </svg>
                            </span>

                            <h2 class="mt-2 font-bold">Accountant</h2>

                            <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                                Lorem ipsum dolor sit amet consectetur.
                            </p>
                        </a>

                        <a class="block rounded-xl border border-gray-100 p-4 shadow-sm hover:border-gray-200 hover:ring-1 hover:ring-gray-200 focus:outline-none focus:ring"
                            href="#">
                            <span class="inline-block rounded-lg bg-gray-50 p-3">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222">
                                    </path>
                                </svg>
                            </span>

                            <h2 class="mt-2 font-bold">Accountant</h2>

                            <p class="hidden sm:mt-1 sm:block sm:text-sm sm:text-gray-600">
                                Lorem ipsum dolor sit amet consectetur.
                            </p>
                        </a>
                    </div> --}}

                    {{-- Carousel --}}
                    <div>
                        <x-image-carousel :images="[
                            [
                                'url' => asset('images/banner/min/1.jpg'),
                                'alt' => 'Slide 1',
                                'message' =>
                                    'El ajedrez enseña a pensar estratégicamente, fortaleciendo habilidades matemáticas y lógicas',
                            ],
                            [
                                'url' => asset('images/banner/min/2.jpg'),
                                'alt' => 'Slide 2',
                                'message' =>
                                    'Jugar ajedrez fomenta la concentración y la atención en los niños, habilidades fundamentales para el éxito en las matemáticas y otras disciplinas académicas',
                            ],
                            [
                                'url' => asset('images/banner/min/3.jpg'),
                                'alt' => 'Slide 3',
                                'message' =>
                                    'El ajedrez enseña a los niños a reconocer patrones y relaciones entre las piezas, lo que refuerza su comprensión de conceptos matemáticos como la geometría y la aritmética.',
                            ],
                            [
                                'url' => asset('images/banner/min/4.jpg'),
                                'alt' => 'Slide 4',
                                'message' =>
                                    'A través del ajedrez, los niños practican el pensamiento crítico al analizar situaciones complejas y encontrar soluciones eficaces, lo que mejora su habilidad para abordar problemas matemáticos con confianza.',
                            ],
                            [
                                'url' => asset('images/banner/min/4.jpg'),
                                'alt' => 'Slide 5',
                                'message' =>
                                    'A través del ajedrez, los niños practican el pensamiento crítico al analizar situaciones complejas y encontrar soluciones eficaces, lo que mejora su habilidad para abordar problemas matemáticos con confianza.',
                            ],
                            [
                                'url' => asset('images/banner/min/6.jpg'),
                                'alt' => 'Slide 6',
                                'message' =>
                                    'La capacidad de planificar y ejecutar estrategias en el ajedrez desarrolla la capacidad de los niños para aplicar métodos sistemáticos en la resolución de problemas matemáticos.',
                            ],
                        ]" />
                    </div>

                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-50">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex justify-center text-teal-600 sm:justify-start">
                    <picture class="h-10 aspect-square">
                        <source srcset="{{ asset('images/logos/logo-uvd.jpg') }}" type="image/png">
                        <img src="{{ asset('images/logos/logo-uvd.jpg') }}" class="h-12 w-auto" alt="Logo UDV">
                    </picture>
                </div>

                <p class="mt-4 text-center text-sm text-gray-500 lg:mt-0 lg:text-right">
                    Copyright &copy; 2023. Universidad Del Valle.
                </p>
            </div>
        </div>
    </footer>



</body>

</html>
