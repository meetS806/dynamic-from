<x-app-layout>

    <div class="max-w-5xl mx-auto py-10">

        <h1 class="text-2xl font-bold">
            {{ $form->title }}
        </h1>

        <p class="text-gray-600 mb-8">
            {{ $form->description }}
        </p>


        @if(session('success'))

            <div class="bg-green-100 p-4 mb-5">
                {{ session('success') }}
            </div>

        @endif


        {{-- ADD FIELD --}}

        <div class="border rounded p-6 mb-8">

            <h2 class="text-xl font-bold mb-5">
                Add Field
            </h2>


            <form
                method="POST"
                action="{{ route('admin.forms.fields.store', $form) }}"
            >

                @csrf


                <div class="mb-4">

                    <label class="block font-semibold mb-2">
                        Field Label
                    </label>

                    <input
                        type="text"
                        name="label"
                        class="w-full border rounded p-2"
                        placeholder="First Name"
                        required
                    >

                </div>


                <div class="mb-4">

                    <label class="block font-semibold mb-2">
                        Field Type
                    </label>

                    <select
                        name="type"
                        id="fieldType"
                        class="w-full border rounded p-2"
                    >

                        <option value="text">
                            Text
                        </option>

                        <option value="number">
                            Number
                        </option>

                        <option value="textarea">
                            Textarea
                        </option>

                        <option value="radio">
                            Radio
                        </option>

                        <option value="checkbox">
                            Checkbox
                        </option>

                        <option value="select">
                            Dropdown
                        </option>

                    </select>

                </div>


                <div class="mb-4">

                    <label>

                        <input
                            type="checkbox"
                            name="is_required"
                            value="1"
                        >

                        Required

                    </label>

                </div>


                {{-- OPTIONS --}}

                <div
                    id="optionsSection"
                    class="mb-5"
                    style="display:none;"
                >

                    <label class="block font-semibold mb-2">
                        Options
                    </label>


                    <div id="optionsContainer">

                        <input
                            type="text"
                            name="options[]"
                            class="w-full border rounded p-2 mb-2"
                            placeholder="Male"
                        >

                        <input
                            type="text"
                            name="options[]"
                            class="w-full border rounded p-2 mb-2"
                            placeholder="Female"
                        >

                    </div>


                    <button
                        type="button"
                        id="addOption"
                        class="bg-gray-500 text-white px-3 py-2 rounded"
                    >
                        + Add Option
                    </button>

                </div>


                <button
                    type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded"
                >
                    Add Field
                </button>

            </form>

        </div>


        {{-- EXISTING FIELDS --}}

        <div>

            <h2 class="text-xl font-bold mb-5">
                Form Fields
            </h2>


            @forelse($form->fields as $field)

                <div class="border rounded p-5 mb-4">

                    <h3 class="font-bold text-lg">
                        {{ $field->sort_order }}.
                        {{ $field->label }}
                    </h3>

                    <p>
                        Type:
                        {{ $field->type }}
                    </p>

                    <p>
                        Required:
                        {{ $field->is_required ? 'Yes' : 'No' }}
                    </p>


                    @if(in_array($field->type, [
                        'radio',
                        'checkbox',
                        'select'
                    ]))

                        <div class="mt-3">

                            <strong>Options:</strong>

                            <ul class="list-disc ml-5">

                                @foreach($field->allOptions as $option)

                                    <li>
                                        {{ $option->label }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                </div>

            @empty

                <p class="text-gray-500">
                    No fields added yet.
                </p>

            @endforelse

        </div>

    </div>


    <script>

        const fieldType =
            document.getElementById('fieldType');

        const optionsSection =
            document.getElementById('optionsSection');

        const optionsContainer =
            document.getElementById('optionsContainer');

        const addOption =
            document.getElementById('addOption');


        function toggleOptions()
        {
            const optionTypes = [
                'radio',
                'checkbox',
                'select'
            ];

            if (optionTypes.includes(fieldType.value)) {

                optionsSection.style.display = 'block';

            } else {

                optionsSection.style.display = 'none';

            }
        }


        fieldType.addEventListener(
            'change',
            toggleOptions
        );


        addOption.addEventListener(
            'click',
            function ()
            {

                const input =
                    document.createElement('input');

                input.type = 'text';

                input.name = 'options[]';

                input.placeholder = 'Enter option';

                input.className =
                    'w-full border rounded p-2 mb-2';

                optionsContainer.appendChild(input);

            }
        );


        toggleOptions();

    </script>

</x-app-layout>