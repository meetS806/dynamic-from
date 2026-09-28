<x-app-layout>

    <div class="max-w-3xl mx-auto py-10">

        <div class="bg-white shadow rounded-lg p-6">

            <h1 class="text-2xl font-bold">
                {{ $form->title }}
            </h1>

            <p class="text-gray-600 mt-2 mb-6">
                {{ $form->description }}
            </p>

            @if($errors->any())

                <div class="bg-red-100 text-red-800 p-4 rounded mb-5">

                    <ul class="list-disc ml-5">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('user.forms.submit', $form) }}"
            >

                @csrf


                @foreach($form->fields as $field)

                    <div class="mb-6">

                        <label class="block font-semibold mb-2">

                            {{ $field->label }}

                            @if($field->is_required)
                                <span class="text-red-500">*</span>
                            @endif

                        </label>


                        {{-- TEXT --}}

                        @if($field->type === 'text')

                            <input
                                type="text"
                                name="fields[{{ $field->id }}]"
                                value="{{ old('fields.'.$field->id) }}"
                                class="w-full border rounded p-2"
                            >


                        {{-- NUMBER --}}

                        @elseif($field->type === 'number')

                            <input
                                type="number"
                                name="fields[{{ $field->id }}]"
                                value="{{ old('fields.'.$field->id) }}"
                                class="w-full border rounded p-2"
                            >


                        {{-- TEXTAREA --}}

                        @elseif($field->type === 'textarea')

                            <textarea
                                name="fields[{{ $field->id }}]"
                                class="w-full border rounded p-2"
                                rows="4"
                            >{{ old('fields.'.$field->id) }}</textarea>


                        {{-- RADIO --}}

                        @elseif($field->type === 'radio')

                            @foreach($field->allOptions as $option)

                                <label class="block mb-2">

                                    <input
                                        type="radio"
                                        name="fields[{{ $field->id }}]"
                                        value="{{ $option->value }}"
                                        @checked(
                                            old('fields.'.$field->id)
                                            === $option->value
                                        )
                                    >

                                    {{ $option->label }}

                                </label>

                            @endforeach


                        {{-- CHECKBOX --}}

                        @elseif($field->type === 'checkbox')

                            @foreach($field->allOptions as $option)

                                <label class="block mb-2">

                                    <input
                                        type="checkbox"
                                        name="fields[{{ $field->id }}][]"
                                        value="{{ $option->value }}"
                                        @checked(
                                            in_array(
                                                $option->value,
                                                old('fields.'.$field->id, [])
                                            )
                                        )
                                    >

                                    {{ $option->label }}

                                </label>

                            @endforeach


                        {{-- SELECT / DROPDOWN --}}

                        @elseif($field->type === 'select')

                            <select
                                name="fields[{{ $field->id }}]"
                                class="w-full border rounded p-2"
                            >

                                <option value="">
                                    -- Select --
                                </option>

                                @foreach($field->allOptions as $option)

                                    <option
                                        value="{{ $option->value }}"
                                        @selected(
                                            old('fields.'.$field->id)
                                            === $option->value
                                        )
                                    >
                                        {{ $option->label }}
                                    </option>

                                @endforeach

                            </select>

                        @endif

                    </div>

                @endforeach


                <button
                    type="submit"
                    class="bg-indigo-600 text-white px-5 py-2 rounded"
                >
                    Submit Form
                </button>

            </form>

        </div>

    </div>

</x-app-layout>