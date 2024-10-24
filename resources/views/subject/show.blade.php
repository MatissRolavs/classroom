<x-app-layout>
    <div class="flex justify-center items-center min-h-screen">
        <div class="grid grid-cols-3 gap-8 max-w-6xl w-full">
            <!-- Subject Info Box -->
            @if($subject)
            @foreach($users as $user)
                @if($subject->creator_id == $user->id)
                <h1 class="text-xl font-bold">Created by {{ $user->name }}</h1>
                @endif
            @endforeach
                <a href="{{ route('subject.participants', $subject->id) }}" class="bg-white p-6 rounded-lg shadow-md col-span-1">View all participants</a>
                <div class="bg-white p-6 rounded-lg shadow-md col-span-3">
                    <h1 class="text-3xl font-bold">Name: {{ $subject->name }}</h1>
                    <p class="mt-4 text-lg">Description: {{ $subject->description }}</p>
                    @if(auth()->user()->role == "1" || auth()->user()->role == "2")
                    <p>Invite code: 
                        <button type="button" class="mt-4 px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700" onclick="this.outerHTML = '{{ $subject->code }}'">
                        Show invite code
                        </button>
                    </p>
                    @endif
                @if($subject->creator_id == auth()->user()->id)
                    <button>Delete subject</button>
                @else
                    <form action="{{ route('subject.leave', $subject->id) }}" method="POST" class="mt-8">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 mt-4">
                            Leave Class
                        </button>
                    </form>
                </div>
                @endif
            @else
                <div class="bg-white p-6 rounded-lg shadow-md col-span-3">
                    <p>Subject not found.</p>
                </div>
            @endif
            @if(auth()->user()->role == "1" || auth()->user()->role == "2")
            <!-- Task Creation Box -->
            <div class="col-span-3 flex justify-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-2/3">
                    <h2 class="text-2xl font-bold text-center">Create a Task</h2>
                    <form action="{{ route('task.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="class_id" value="{{ $subject->id }}">
                        <input name="title" id="title" placeholder="Enter task name" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <input name="description" id="description" placeholder="Enter task description" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Select due date:</label> 
                        <input name="due_date" id="due_date" type="date" placeholder="Select due date" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="{{ date('Y-m-d') }}">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 mt-4">
                            Create
                        </button>
                    </form>
                </div>
            </div>
            @endif
            <!-- Task List -->
            <h2 class="text-2xl font-bold text-center col-span-3">Task List</h2>
            <div class="col-span-3">
                @foreach($tasks->sortByDesc('created_at') as $task)
                    @if($task->class_id == $subject->id)
                        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
                            <h3 class="text-xl font-bold">Name: {{ $task->title }}</h3>
                            <p class="mt-2">Description: {{ $task->description }}</p>
                            <p class="mt-2">Due Date: {{ date('j F Y', strtotime($task->due_date)) }}</p>

                            <!-- Task Files Section -->
                            @foreach($taskFiles as $taskFile)
                                @if($taskFile->task_id == $task->id)
                                    <a href="{{ route('taskFiles.show', $taskFile->id) }}" class="text-blue-600 underline mt-2 block">View file</a>
                                @endif
                            @endforeach
                            @if(auth()->user()->role == "1" || auth()->user()->role == "2")
                            <h1 class="text-xl font-bold">Student Files:</h1>

                            <ul>
                                @foreach($users as $user)
                                    @foreach($studentFiles as $studentFile)
                                        @if($studentFile->task_id == $task->id)
                                        @if($user->id == $studentFile->student_id)
                                        <li>
                                            <p>{{$user->name}} :</p><a href="{{ route('studentFile.show', $studentFile->id) }}" class="text-blue-600 underline mt-2 block">View file</a>
                                        </li>
                                        <form action="{{ route('grade.store') }}" method="POST" class="mt-4">
                                            @csrf
                                            <div class="flex items-center bg-white p-6 rounded-lg shadow-md">
                                                <input type="text" name="grade" placeholder="Enter grade for {{$user->name}}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                <input type="hidden" name="student_id" value="{{ $user->id }}">
                                                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 ml-4">
                                                    Upload
                                                </button>
                                            </div>
                                        </form>
                                        @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                            @endif
                            @if(auth()->user()->role == "0")
                            Your files:
                            @foreach($studentFiles as $studentFile)
                                @if($studentFile->student_id == auth()->user()->id && $studentFile->task_id == $task->id)
                                    <a href="{{ route('studentFile.show', $studentFile->id) }}" class="text-blue-600 underline mt-2 block">View file</a>
                                @endif
                            @endforeach
                            @endif
                            @if(auth()->user()->role == "1" || auth()->user()->role == "2")
                            <!-- File Upload Form -->
                            <form action="{{ route('taskFiles.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <div class="flex items-center bg-white p-6 rounded-lg shadow-md">
                                    <input type="file" name="file" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 ml-4">
                                        Upload
                                    </button>
                                </div>
                            </form>
                            @else
                            <form action="{{ route('studentFile.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <div class="flex items-center bg-white p-6 rounded-lg shadow-md">
                                    <input type="file" name="file" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 ml-4">
                                        Upload
                                    </button>
                                </div>
                            </form>
                            @endif
                            <!-- Comments Section -->
                            <div class="bg-white p-6 rounded-lg shadow-md mt-8">
                                <h3 class="text-2xl font-bold">Comments</h3>
                                <!-- Add Comment Form -->
                                <form method="POST" action="{{ route('comments.store') }}" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="class_id" value="{{ $task->class_id }}">
                                    <textarea name="comment" id="comment" cols="30" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Leave a comment..."></textarea>
                                    <button type="submit" class="bg-green-600 text-white px-6 py-2 mt-4 rounded-md cursor-pointer">Comment</button>
                                </form>
                                @foreach($comments->sortByDesc('created_at') as $comment)
                                    @if($comment->task_id == $task->id)
                                        <div class="mt-4 border-b border-gray-300 py-2">
                                            @foreach($users as $user)
                                                @if($user->id == $comment->user_id)
                                                    <p><strong>{{ $user->name }}:</strong> {{ $comment->comment }}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
                
            </div>
        </div>
    </div>
</x-app-layout>
