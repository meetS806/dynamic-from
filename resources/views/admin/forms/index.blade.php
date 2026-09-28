<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold text-gray-900">
                Forms
            </h1>

            <a href="{{ route('admin.forms.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600
                      border border-transparent rounded-md font-semibold
                      text-xs text-white uppercase tracking-widest
                      hover:bg-indigo-500">
                + Create Form
            </a>

        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @forelse($forms as $form)

            <div class="bg-white shadow rounded-lg p-6 mb-4">

                <h2 class="text-xl font-semibold text-gray-900">
                    {{ $form->title }}
                </h2>

                <p class="text-gray-600 mt-2">
                    {{ $form->description }}
                </p>

                <div class="mt-3">
                    Status:
                    <span class="font-semibold">
                        {{ ucfirst($form->status) }}
                    </span>
                </div>

                <a href="{{ route('admin.forms.edit', $form) }}"
                   class="inline-block mt-4 px-4 py-2 bg-gray-800
                          text-white rounded hover:bg-gray-700">

                    Edit Form

                </a>

            </div>

        @empty

            <div class="bg-white shadow rounded-lg p-6">

                <p class="text-gray-600">
                    No forms created yet.
                </p>

            </div>

        @endforelse

    </div>

</x-app-layout>