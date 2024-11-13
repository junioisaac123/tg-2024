@if (isset($question))
    <div class="">
        <select
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            name="questions[{{ $question->id }}]" {{ $question->is_required ? 'required' : '' }}>


            <option selected>{{ __('Select an option') }}</option>
            @foreach ($question->options as $option)
                <option value="{{ getLetterFromNumber($loop->iteration - 1) }}"
                    {{ old('question.' . $question->id) === getLetterFromNumber($loop->iteration - 1) ? 'selected' : '' }}>
                    {{ $option->text }}
                </option>
            @endforeach
        </select>
    </div>
@endif
