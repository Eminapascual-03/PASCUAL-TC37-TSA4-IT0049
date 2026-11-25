<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Task
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    <div class="mb-4 rounded bg-red-100 p-4 text-red-800">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block font-medium">
                            Task Title
                        </label>

                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               class="mt-1 block w-full rounded border-gray-300"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium">
                            Description
                        </label>

                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  class="mt-1 block w-full rounded border-gray-300">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="due_date" class="block font-medium">
                            Due Date
                        </label>

                        <input type="date"
                               id="due_date"
                               name="due_date"
                               value="{{ old('due_date') }}"
                               class="mt-1 block w-full rounded border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block font-medium">
                            Status
                        </label>

                        <select id="status"
                                name="status"
                                class="mt-1 block w-full rounded border-gray-300">
                            <option value="pending">Pending</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <button type="submit"
                            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                        Save Task
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>