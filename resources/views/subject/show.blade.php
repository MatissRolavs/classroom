
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
        <h3>Comments:</h3>
        <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="class_id" value="{{$task->class_id}}">
                <div style="display: flex; justify-content: center; padding: 10px;">
                    <textarea name="comment" id="comment" cols="30" rows="10" style="width: 1000px; border-radius: 10px; border: 1px solid lightgray; padding: 10px;" placeholder="Leave a comment..."></textarea>
                    <button type="submit" style="background-color: #4CAF50; color: white; padding: 14px 20px; margin-left: 10px; border: none; cursor: pointer;">Comment</button>
                </div>
            </form>
            <h2 style="text-align: center;">Comments</h2>
            @foreach ($comments as $comment)
                @if($comment->task_id == $task->id)
            <div style="display: flex; justify-content: center; padding: 10px; border-bottom: 1px solid lightgray;">
                <div style="display: flex; align-items: center;">
                @if (auth()->user()->id == $comment->user_id)
                    <p style="margin-right: 10px;">{{ auth()->user()->name }} : </p>
                @endif
                </div>
                <p style="margin-left: 10px;">{{ $comment->comment }}</p>
            </div>
                @endif
            @endforeach
    @endforeach
</ul>


