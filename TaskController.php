<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Show all tasks
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    // Store new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'due_date' => 'nullable|date',
        ]);

        Task::create($request->all());
        return redirect('/');
    }

    // Delete task
    public function destroy($id)
    {
        Task::destroy($id);
        return redirect('/');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'status' => 'required',
        'due_date' => 'nullable|date',
    ]);

    $task = Task::findOrFail($id);

    // ONLY update fields that are fillable
    $task->update($request->only('title', 'status', 'due_date'));

    return redirect('/');
}



}
