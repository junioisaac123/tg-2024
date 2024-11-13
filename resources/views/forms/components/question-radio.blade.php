@if (isset($question))
    <div class="">
        @foreach ($question->options as $option)
            <label class="flex items-center mb-2">
                <input type="radio"
                    value="{{ old('question.' . $question->id, getLetterFromNumber($loop->iteration - 1)) }}"
                    name="questions[{{ $question->id }}]" {{ $question->is_required ? 'required' : '' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <span for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ $option->text }}
                </span>
            </label>
        @endforeach
    </div>
@endif
