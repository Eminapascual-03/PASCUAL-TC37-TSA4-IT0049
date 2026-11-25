<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            About
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h1 class="mb-4 text-2xl font-bold">
                    Tasks for Today Management System
                </h1>

                <p class="mb-4 text-gray-700">
                    This Laravel web application helps users create, manage,
                    update, complete, and archive their tasks.
                </p>

                <p class="text-gray-700">
                    The system includes full CRUD operations, authentication,
                    validation, soft deletion, and email notifications when a
                    pending task is marked as done.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>