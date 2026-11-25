<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompleted;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->where('is_archived', false)
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,done'],
        ]);

        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required', 'in:pending,done'],
        ]);

        $oldStatus = $task->status;

        $task->update($validated);

        if ($oldStatus === 'pending' && $task->status === 'done') {
            Mail::to(config('mail.task_recipient'))
                ->send(new TaskCompleted($task));
        }

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->update([
            'is_archived' => true,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task archived successfully.');
    }

    private function authorizeTask(Task $task): void
    {
        abort_unless(
            $task->user_id === auth()->id(),
            403
        );
    }
}