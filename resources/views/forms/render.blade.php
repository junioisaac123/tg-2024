<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title ?? __('Answering Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{ route('answers.store') }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="form_id" value="{{ $form->id }}">
            <input type="hidden" name="return_url" value="{{ $returnUrl }}">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-6">

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-3 border-t-8 border-blue-800 dark:border-blue-900">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <h2 class="text-4xl font-extrabold dark:text-white mb-2 text-pretty">
                            {{ $form->title }}
                        </h2>
                        <span
                            class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-3 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                            {{ $form->category->text }}
                        </span>

                        @if (isset($form->description))
                            <p class="my-4 text-lg font-normal text-gray-500 dark:text-gray-400 text-balance">
                                {{ $form->description }}
                            </p>
                        @endif

                    </div>
                </div>

                @foreach ($form->questions as $question)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 text-gray-900 dark:text-gray-100">
                            <div class="text-gray-500 dark:text-gray-400 mb-3 flex items-start gap-1 text-xl">
                                <span>
                                    #{{ $loop->iteration }}
                                </span>

                                <h2 class="text-2xl font-bold dark:text-white ml-2">
                                    {{ $question->title }}
                                </h2>
                            </div>
                            @if ($question->description)
                                <p class="mb-3 font-normal text-lg text-gray-500 dark:text-gray-400 ml-3">
                                    {{ $question->description }}
                                </p>
                            @endif
                            <div class="ml-3 mb-3">
                                @include('forms.components.question-' . $question->type, [
                                    'question' => $question,
                                    'index' => $loop->iteration,
                                ])
                            </div>

                        </div>
                    </div>
                @endforeach

                {{-- save --}}
                <div class="flex justify-end">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
