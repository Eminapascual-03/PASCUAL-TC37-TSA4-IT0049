<x-mail::message>
# Task Completed

A task has been marked as completed.

**Task:** {{ $task->title }}

@if ($task->description)
**Description:** {{ $task->description }}
@endif

@if ($task->due_date)
**Due date:** {{ $task->due_date->format('F d, Y') }}
@endif

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>