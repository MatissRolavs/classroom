<x-app-layout>
    <div class="flex justify-center items-center min-h-screen">
        <div class="grid grid-cols-3 gap-8 max-w-6xl w-full">
            <!-- Subject Info Box -->
            @if($subject)
                <div class="bg-white p-6 rounded-lg shadow-md col-span-3">
                    <h1 class="text-3xl font-bold">{{ $subject->name }}</h1>
                    <p class="mt-4 text-lg">{{ $subject->description }}</p>
                    <button type="button" class="mt-4 px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700" onclick="this.outerHTML = '{{ $subject->code }}'">
                        Show invite code
                    </button>

                    <form action="{{ route('subject.leave', $subject->id) }}" method="POST" class="mt-8">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 mt-4">
                            Leave Class
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-white p-6 rounded-lg shadow-md col-span-3">
                    <p>Subject not found.</p>
                </div>
            @endif

            <!-- Tasks Box -->
            <div class="bg-white p-6 rounded-lg shadow-md col-span-2">
                <h2 class="text-2xl font-bold">Tasks</h2>
                <form action="{{ route('task.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="class_id" value="{{ $subject->id }}">
                    <input name="title" id="title" placeholder="Enter task name" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <input name="description" id="description" placeholder="Enter task description" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 mt-4">
                        Create
                    </button>
                </form>

                <ul class="mt-8">
                    @foreach($tasks as $task)
                        @if($task->class_id == $subject->id)
                            <div class="bg-white p-6 rounded-lg shadow-md mt-4">
                                <h3 class="text-xl font-bold">{{ $task->title }}</h3>
                                <p class="mt-2">{{ $task->description }}</p>
                                @foreach($taskFiles as $taskFile)
                                    <a href="{{ route('taskFiles.show', $taskFile->id) }}" class="text-blue-600 underline mt-2 block">View file</a>
                                @endforeach

                                <form action="{{ route('taskFiles.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                    @csrf
                                    <input type="file" name="file" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 mt-4">
                                        Upload
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- Comments Box -->
            <div class="bg-white p-6 rounded-lg shadow-md col-span-1">
                <h3 class="text-2xl font-bold">Comments</h3>
                @foreach($tasks as $task)
                    @if($task->class_id == $subject->id)
                        <form method="POST" action="{{ route('comments.store') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="class_id" value="{{ $task->class_id }}">
                            <textarea name="comment" id="comment" cols="30" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Leave a comment..." style="padding: 10px;"></textarea>
                            <button type="submit" class="bg-green-600 text-white px-6 py-2 mt-4 rounded-md cursor-pointer">Comment</button>
                        </form>

                        <div class="mt-4">
                            @foreach ($comments as $comment)
                                @if($comment->task_id == $task->id)
                                    <div class="mt-4 border-b border-gray-300 py-2">
                                        @if(auth()->user()->id == $comment->user_id)
                                            <p><strong>{{ auth()->user()->name }}:</strong> {{ $comment->comment }}</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
