
    <div>
        <h1>{{ $subject->name }}</h1>
        <p>{{ $subject->description }}</p>
        <button
            type="button"
            onclick="this.outerHTML = '{{ $subject->code }}'"
        >
            Show invite code
        </button>
    </div>
<form action="{{ route('subject.leave', $subject->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Leave Class</button>
</form>
<form action="{{ route('task.store') }}" method="POST">
    @csrf
    <input type="hidden" name="class_id" value="{{ $subject->id }}">
    <input name="title" placeholder="Enter task name" required>
    <input name="description" placeholder="Enter task description" required>	
    <button type="submit">Create</button>
</form>
<ul>
    @if($subject->creator_id == auth()->user()->id)
        <p>Created by: {{auth()->user()->name}}</p>
    @endif
    @foreach($tasks as $task)
        @if($task->class_id == $subject->id)
            {{ $task->title }}
            <br>
            {{ $task->description }}
            @foreach($taskFiles as $taskFile)
                <a href="{{ route('taskFiles.show', $taskFile->id) }}">View file</a>
                <br>
            @endforeach
            <form action="{{ route('taskFiles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <button type="submit">Upload</button>
            </form>
        @endif
    @endforeach
</ul>

