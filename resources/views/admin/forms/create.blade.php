<x-app-layout>
    @section('head.scrpits')
        @vite(['resources/js/admin/forms/create.js'])
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Questionnaire') }}
        </h2>
    </x-slot>
    <input type="hidden" name="app_name" id="app_name" value="{{ env('APP_NAME') }}">
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" text-gray-900 dark:text-gray-100">

                    {{--  --}}

                    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Crear Cuestionario</h1>

                        <!-- Formulario para el Cuestionario -->
                        <form method="POST" action="{{ route('admin.forms.store') }}" enctype="multipart/form-data"
                            x-data="questionnaireForm()" @submit.prevent="submitForm">
                            @csrf

                            <!-- Título del cuestionario -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2"
                                    for="title">Título del Cuestionario</label>
                                <input type="text" id="title" name="title"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Título del cuestionario" required>
                            </div>

                            <!-- Descripción del cuestionario -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2"
                                    for="description">Descripción</label>
                                <textarea id="description" name="description"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Descripción del cuestionario"></textarea>
                            </div>

                            <!-- Seleccionar Categoría del Cuestionario -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2"
                                    for="category">Categoría</label>
                                <select id="category" name="category_id"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->text }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <hr class="pb-3 border-gray-200 dark:border-gray-400">

                            <!-- Lista de preguntas -->
                            <div class="mb-6">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Preguntas</h2>

                                <template x-for="(question, qIndex) in questions" :key="qIndex">
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-4">
                                        <!-- Título de la pregunta -->
                                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2"
                                            :for="'question-title-' + qIndex">Título de la Pregunta</label>
                                        <input type="text" :id="'question-title-' + qIndex" x-model="question.title"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="Título de la pregunta" required>

                                        <!-- Tipo de pregunta -->
                                        <label
                                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mt-4 mb-2"
                                            :for="'question-type-' + qIndex">Tipo</label>
                                        <select :id="'question-type-' + qIndex" x-model="question.type"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="input">Texto</option>
                                            <option value="textarea">Área de Texto</option>
                                            <option value="radio">Opción Múltiple (Radio)</option>
                                            <option value="checkbox">Casilla de Verificación</option>
                                            <option value="select">Selección</option>
                                        </select>

                                        <!-- ¿Pregunta Requerida? -->
                                        <label
                                            class=" text-gray-700 dark:text-gray-300 text-sm font-bold mt-4 mb-2 flex items-center">
                                            <input type="checkbox" x-model="question.is_required"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                checked>
                                            <span class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                ¿Es Obligatoria?
                                            </span>



                                        </label>


                                        <!-- Imagen para la pregunta y previsualización -->
                                        <label
                                            class="block text-gray-700 dark:text-gray-300 text-sm font-bold mt-4 mb-2"
                                            :for="'question-image-' + qIndex">Imagen (opcional)</label>
                                        <input type="file" :id="'question-image-' + qIndex"
                                            @change="handleImageUpload($event, qIndex)"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <div x-show="question.previewImage" class="mt-4">
                                            <img :src="question.previewImage" alt="Previsualización de imagen"
                                                class="w-32 h-32 object-cover rounded">
                                        </div>


                                        <!-- Opciones de respuesta -->
                                        <div x-show="['radio', 'checkbox', 'select'].includes(question.type)"
                                            class="mt-4">
                                            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Opciones</h3>

                                            <!-- Activar calificación -->
                                            <label
                                                class="flex items-center text-gray-700 dark:text-gray-300 text-sm font-bold mt-4 mb-2">
                                                <input type="checkbox" x-model="question.hasScore"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <span class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    ¿Activar Calificación?
                                                </span>
                                            </label>

                                            {{-- Opciones --}}
                                            <template x-for="(option, oIndex) in question.options"
                                                :key="oIndex">
                                                <div class="flex items-center mb-2">
                                                    <input type="text" x-model="option.text"
                                                        class="shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-200 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                                                        placeholder="Texto de la opción" required>

                                                    <!-- Campo de Calificación (Score) para la opción -->
                                                    <input x-show="question.hasScore" type="number"
                                                        x-model="option.score" min="0"
                                                        class="shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-200 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline ml-2 w-20"
                                                        placeholder="Puntuación" required>
                                                    <button type="button" @click="removeOption(qIndex, oIndex)"
                                                        class="ml-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-500">
                                                        Eliminar
                                                    </button>
                                                </div>
                                            </template>
                                            <button type="button" @click="addOption(qIndex)"
                                                class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500 mt-2">
                                                Añadir Opción
                                            </button>
                                        </div>

                                        <div>
                                            <!-- Eliminar pregunta -->
                                            <button type="button" @click="removeQuestion(qIndex)"
                                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-500 mt-4">
                                                Eliminar Pregunta
                                            </button>
                                        </div>

                                    </div>
                                </template>

                                <!-- Añadir pregunta -->
                                <button type="button" @click="addQuestion"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Añadir Pregunta
                                </button>
                            </div>

                            <!-- Botón de enviar -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Guardar Cuestionario
                                </button>
                            </div>
                        </form>
                    </div>

                    {{--  --}}

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
