<x-app-layout>

    <div class="max-w-5xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">
            Available Forms
        </h1>

        @if(session('success'))

            <div class="bg-green-100 text-green-800 p-4 rounded mb-5">
                {{ session('success') }}
            </div>

        @endif

        @forelse($forms as $form)

            <div class="bg-white shadow rounded p-6 mb-4">

                <h2 class="text-xl font-bold">
                    {{ $form->title }}
                </h2>

                <p class="text-gray-600 mt-2">
                    {{ $form->description }}
                </p>

                <a
                    href="{{ route('user.forms.show', $form) }}"
                    class="inline-block mt-4 bg-indigo-600 text-white px-4 py-2 rounded"
                >
                    Fill Form
                </a>

            </div>

        @empty

            <div class="bg-white shadow rounded p-6">
                No forms are currently available.
            </div>

        @endforelse

    </div>

</x-app-layout>