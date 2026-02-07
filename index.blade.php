<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <style>
        body { font-family: Arial; background: #F5E6F4; }
        .container { width: 700px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; }
        input, select { padding: 6px; color: black; }
        button { background: #BC96CD; border: none; padding: 6px 12px; color: white; cursor: pointer; border-radius: 4px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { border-bottom: 1px solid #ddd; padding: 8px; text-align: left; }
        .edit-form { display: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>Todo List</h2>

    <!-- CREATE TASK -->
    <form method="POST" action="/task">
        @csrf
        <input type="text" name="title" placeholder="Task title" required>
        <select name="status">
            <option value="pending">Pending</option>
            <option value="done">Done</option>
        </select>
        <input type="date" name="due_date">
        <button type="submit">Save Task</button>
    </form>

    <!-- TASK TABLE -->
    <table>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Due Date</th>
            <th>Action</th>
        </tr>

        @foreach ($tasks as $task)
        <tr id="task-row-{{ $task->id }}">
            <!-- Display row -->
            <td class="display-text">{{ $task->title }}</td>
            <td class="display-text">{{ $task->status }}</td>
            <td class="display-text">{{ $task->due_date }}</td>
            <td>
                <button type="button" onclick="editTask({{ $task->id }})">Update</button>
                <a href="/task/{{ $task->id }}/delete">
                    <button type="button">Delete</button>
                </a>
            </td>
        </tr>

        <!-- Edit row (hidden by default) -->
        <tr id="edit-row-{{ $task->id }}" class="edit-form">
            <form method="POST" action="/task/{{ $task->id }}/update">
                @csrf
                @method('PUT')
                <td>
                    <input type="text" name="title" value="{{ $task->title }}" required>
                </td>
                <td>
                    <select name="status">
                        <option value="pending" {{ $task->status=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="done" {{ $task->status=='done' ? 'selected' : '' }}>Done</option>
                    </select>
                </td>
                <td>
                    <input type="date" name="due_date" value="{{ $task->due_date }}">
                </td>
                <td>
                    <button type="submit">Save</button>
                    <button type="button" onclick="cancelEdit({{ $task->id }})">Cancel</button>
                </td>
            </form>
        </tr>

        @endforeach
    </table>
</div>

<script>
function editTask(id) {
    document.getElementById('task-row-' + id).style.display = 'none'; // hide display row
    document.getElementById('edit-row-' + id).style.display = 'table-row'; // show edit row
}

function cancelEdit(id) {
    document.getElementById('edit-row-' + id).style.display = 'none'; // hide edit row
    document.getElementById('task-row-' + id).style.display = 'table-row'; // show display row
}
</script>

</body>
</html>
