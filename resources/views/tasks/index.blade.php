<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tasks for Today
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @auth
                <div class="mb-4">
                    <a href="{{ route('tasks.create') }}"
                       class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                        Add New Task
                    </a>
                </div>
            @endauth

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4 text-lg font-semibold">Task List</h3>

                    @forelse ($tasks as $task)
                        <div class="mb-4 rounded border p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-bold">
                                        {{ $task->title }}
                                    </h4>

                                    <p class="text-gray-600">
                                        {{ $task->description ?? 'No description provided.' }}
                                    </p>

                                    <p class="mt-2 text-sm">
                                        Status:
                                        <span class="font-semibold">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </p>

                                    @if ($task->due_date)
                                        <p class="text-sm text-gray-500">
                                            Due date: {{ $task->due_date->format('F d, Y') }}
                                        </p>
                                    @endif
                                </div>

                                @auth
                                    <div class="flex gap-2">
                                        <a href="{{ route('tasks.edit', $task) }}"
                                           class="rounded bg-yellow-500 px-3 py-2 text-white hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <form action="{{ route('tasks.destroy', $task) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="rounded bg-red-600 px-3 py-2 text-white hover:bg-red-700"
                                                    onclick="return confirm('Archive this task?')">
                                                Archive
                                            </button>
                                        </form>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">
                            No tasks available yet.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>