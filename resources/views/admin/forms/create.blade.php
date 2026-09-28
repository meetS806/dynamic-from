<x-app-layout>

    <div class="max-w-3xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">
            Create Form
        </h1>


        @if($errors->any())

            <div class="bg-red-100 p-4 mb-4">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('admin.forms.store') }}"
        >

            @csrf


            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Form Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="w-full border rounded p-2"
                    placeholder="Employee Registration"
                    required
                >

            </div>


            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Description
                </label>

                <textarea
                    name="description"
                    class="w-full border rounded p-2"
                    rows="5"
                >{{ old('description') }}</textarea>

            </div>


            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded"
            >
                Create Form
            </button>

        </form>

    </div>

</x-app-layout>