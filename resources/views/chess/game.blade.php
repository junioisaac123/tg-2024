<x-app-layout>
    @section('head.scrpits')
        {{-- Chess board --}}
        @vite([
            //
            'resources/js/libs/jquery-3.5.1.min.js',
            'resources/js/libs/chessboardjs/chessboard-1.0.0.min.js',
            'resources/js/libs/chessboardjs/chessboard-1.0.0.min.css',
        ])
        @vite([
            //
            'resources/css/modules/game.css',
            'resources/js/chess/game.js',
        ])
    @endsection
    <section data-game="chess" data-user-elo="{{ $user->elo }}"
        data-user-name="{{ $user->first_name . ' ' . $user->last_name }}">
        <div class="chess_caculated_layout">
            <div class="flex justify-between items-center">
                <!-- Name Player 1 -->
                <section class="flex px-2 items-start h-14">
                    <img class="w-14 max-h-full aspect-square rounded-sm object-fill"
                        src="{{ Vite::asset('resources/images/profiles/ai1.webp') }}" alt="">

                    <div class="ml-2">
                        <h1 class="text-xl font-bold text-slate-100">Bot Player</h1>
                        <p class="text-slate-300">Computer</p>
                    </div>

                </section>
                <!-- Spinner -->
                <span id="wait-spin"
                    class="hidden px-6 py-3 text-md font-medium leading-none text-center text-sky-800 bg-gray-200 rounded-full animate-pulse ">
                    Jugando ...
                </span>
                <!-- btn pause -->
                <button type="button" id="btn-pause"
                    class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mx-2 disabled:bg-slate-600/70 disabled:text-slate-200 disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="currentColor" class="w-5 h-5">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 4h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h2a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2z" />
                        <path d="M17 4h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h2a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2z" />
                    </svg>
                    <span class="sr-only">Icon description</span>
                </button>
            </div>


            <!-- Game -->
            <section class="chess_board_space">
                <div id="board-js" class="aspect-square"
                    data-piece-theme="{{ Vite::asset('resources/js/libs/chessboardjs/img/chesscom/{piece}.png') }}">
                </div>
            </section>

            <!-- Name Player 2 -->
            <section class="flex px-2 items-start h-14">
                <img class="w-14 max-h-full aspect-square rounded-sm object-fill"
                    src="{{ Vite::asset('resources/images/profiles/generic.webp') }}" alt="">
                <div class="ml-2">
                    <h1 class="text-xl font-bold text-slate-100">Player 2</h1>
                    <p class="text-slate-300">Student</p>
                </div>
            </section>
        </div>

    </section>

    <!-- MODAL -->
    <section
        class="hidden flex overflow-y-auto overflow-x-hidden absolute inset-0 z-50 justify-center items-center w-full h-screen max-h-full bg-gray-900/50 dark:bg-gray-900/80 backdrop-blur-sm"
        id="modal-game">
        <div class="relative p-2 md:p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow ">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-2 sm:p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl text-center w-full font-semibold text-gray-900 dark:text-white">
                        {{ __('Chess Game Menu') }} ♟
                    </h3>

                    <button type="button"
                        class="flex text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 justify-center items-center "
                        data-bs-dismiss="modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <section class="p-3 sm:p-4 md:p-5">
                    <article class="" data-state="resume-game">
                        <section class="flex flex-col gap-3">
                            <button type="button" data-btn-action="continue-game"
                                class="flex items-center justify-center w-full text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor" class="me-2 -ms-2 w-5 h-5">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M2 5v14c0 .86 1.012 1.318 1.659 .753l8 -7a1 1 0 0 0 0 -1.506l-8 -7c-.647 -.565 -1.659 -.106 -1.659 .753z" />
                                    <path
                                        d="M13 5v14c0 .86 1.012 1.318 1.659 .753l8 -7a1 1 0 0 0 0 -1.506l-8 -7c-.647 -.565 -1.659 -.106 -1.659 .753z" />
                                </svg>
                                <span>
                                    Continuar juego
                                </span>
                            </button>
                            <button type="button" data-btn-action="reset-new-game"
                                class="flex items-center justify-center w-full text-white bg-amber-600 hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="me-2 -ms-2 w-5 h-5">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
                                </svg>
                                <span>
                                    Nuevo Juego
                                </span>
                            </button>
                        </section>
                    </article>

                    <article class="" data-state="new-game" x-data="{ color: null }">
                        <section class="grid gap-4 mb-4 grid-cols-2">
                            <article class="col-span-2">
                                <h3 for="name"
                                    class="text-center block mb-2 text-lg font-medium text-gray-900 dark:text-gray-300">
                                    ¿Como deseas jugar?
                                </h3>
                                <ul class="grid w-full gap-6 grid-cols-3">
                                    <li>
                                        <label
                                            class="flex flex-col items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-blue-600 has-[:checked]:text-blue-600 hover:text-gray-600 hover:bg-gray-100 hover:shadow-md group">
                                            <span>Negras</span>
                                            <span
                                                class="block bg-black w-full h-10 rounded-lg border border-gray-200 group-has-[:checked]:border-blue-600"></span>
                                            <input type="radio" name="color" value="black" class="hidden peer"
                                                x-model="color" required>
                                        </label>
                                    </li>
                                    <li>
                                        <label
                                            class="flex flex-col items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-blue-600 has-[:checked]:text-blue-600 hover:text-gray-600 hover:bg-gray-100 hover:shadow-md group">
                                            <span>Aleatorio</span>
                                            <div class="flex w-full">
                                                <span
                                                    class="block bg-amber-50 w-full h-10 rounded-s-lg border border-e-0 border-gray-200 group-has-[:checked]:border-blue-600"></span>
                                                <span
                                                    class="block bg-black w-full h-10 rounded-e-lg border border-s-0 border-gray-200 group-has-[:checked]:border-blue-600 "></span>
                                            </div>
                                            <input type="radio" name="color" value="random" class="hidden peer"
                                                x-model="color" required>
                                        </label>
                                    </li>
                                    <li>
                                        <label
                                            class="flex flex-col items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-blue-600 has-[:checked]:text-blue-600 hover:text-gray-600 hover:bg-gray-100 hover:shadow-md group">
                                            <span>Blancas</span>
                                            <span
                                                class="block bg-amber-50 w-full h-10 rounded-lg border border-gray-200 group-has-[:checked]:border-blue-600"></span>
                                            <input type="radio" name="color" value="white" class="hidden peer"
                                                x-model="color" required>
                                        </label>
                                    </li>
                                </ul>

                            </article>
                        </section>

                        <section class="flex justify-center">
                            <button type="button" data-btn-action="start-new-game"
                                class="w-full justify-center text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:bg-slate-600/70 disabled:text-slate-200 disabled:cursor-not-allowed"
                                :disabled="!color">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor" class="me-1 -ms-1 w-5 h-5">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M6 4v16a1 1 0 0 0 1.524 .852l13 -8a1 1 0 0 0 0 -1.704l-13 -8a1 1 0 0 0 -1.524 .852z" />
                                </svg>
                                <span>
                                    Empezar juego
                                </span>
                            </button>
                        </section>
                    </article>

                </section>
            </div>
        </div>
    </section>

    <!-- Modal de Promoción -->
    <section
        class="hidden flex overflow-y-auto overflow-x-hidden absolute inset-0 z-40 justify-center items-center w-full h-screen max-h-full bg-gray-900/50 dark:bg-gray-900/80 backdrop-blur-sm"
        id="modal-promotion">
        <div class="relative p-2 md:p-4 w-full max-w-md max-h-full">
            <!-- Contenido del modal -->
            <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow ">
                <!-- Encabezado del modal -->
                <div
                    class="flex items-center justify-between p-2 sm:p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl text-center w-full font-semibold text-gray-900 dark:text-white">
                        Promoción de Peón
                    </h3>
                </div>
                <!-- Cuerpo del modal -->
                <section class="p-3 sm:p-4 md:p-5">
                    <p class="mb-4 text-gray-600 text-center dark:text-gray-300">Seleccione la pieza a la que desea
                        promocionar el peón:
                    </p>
                    <div class="flex justify-stretch">
                        <img src="{{ Vite::asset('resources/js/libs/chessboardjs/img/chesscom/wQ.png') }}"
                            data-piece="q" alt="Dama"
                            class="cursor-pointer flex-1 object-contain h-12 p-1 hover:bg-slate-300/70 rounded-md hover:shadow-md" />
                        <img src="{{ Vite::asset('resources/js/libs/chessboardjs/img/chesscom/wR.png') }}"
                            data-piece="r" alt="Torre"
                            class="cursor-pointer flex-1 object-contain h-12 p-1 hover:bg-slate-300/70 rounded-md hover:shadow-md" />
                        <img src="{{ Vite::asset('resources/js/libs/chessboardjs/img/chesscom/wB.png') }}"
                            data-piece="b" alt="Alfil"
                            class="cursor-pointer flex-1 object-contain h-12 p-1 hover:bg-slate-300/70 rounded-md hover:shadow-md" />
                        <img src="{{ Vite::asset('resources/js/libs/chessboardjs/img/chesscom/wN.png') }}"
                            data-piece="n" alt="Caballo"
                            class="cursor-pointer flex-1 object-contain h-12 p-1 hover:bg-slate-300/70 rounded-md hover:shadow-md" />
                    </div>
                </section>
            </div>
        </div>
    </section>

    <!-- Banner de Fin de Juego -->
    <section class="hidden absolute inset-0 z-[51] flex items-center justify-center bg-gray-900/70 backdrop-blur-sm"
        id="game-over-banner">
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6 text-center">
            <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white " id="game-over-message">¡Juego
                Terminado!</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6" id="game-over-submessage">
            <p>

                <button type="button" data-btn-action="restart-game"
                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Iniciar Nuevo Juego
                </button>
        </div>
    </section>



</x-app-layout>
