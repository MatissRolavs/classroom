<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subjects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-3xl font-bold">Subjects</h1>
                    
                    @foreach($subjects as $index => $subject)
                        @foreach($user_subjects as $user_subject)
                            @if($subject->id == $user_subject->subject_id && $user_subject->user_id == auth()->user()->id)
                                <div class="mt-4">
                                    <p>Group name: {{ $subject->group }}</p>
                                    <p>Link to group: <a href="{{ route('subject.show', $subject->id) }}" class="text-blue-600 underline">
                                        {{ $subject->name }}
                                    </a>
                                    </p>
                                </div>
                                <hr class="my-4">
                            @endif
                        @endforeach
                    @endforeach
                    @foreach($subjects as $index => $subject)
                            @if($subject->creator_id == auth()->user()->id)
                                <div class="mt-4">
                                    <p>Your created class</p>
                                    <p>Group name: {{ $subject->group }}</p>
                                    <p>Link to group: <a href="{{ route('subject.show', $subject->id) }}" class="text-blue-600 underline">
                                        {{ $subject->name }}
                                    </a>
                                    </p>
                                </div>
                                <hr class="my-4">
                            @endif
                    @endforeach
                    @if(auth()->user()->role == "1" || auth()->user()->role == "2")
                        <div class="mt-4">
                            <a href="{{ route('subject.create') }}" class="bg-green-600 text-white px-6 py-2 mt-4 rounded-md cursor-pointer">
                                Create new subject
                            </a>
                        </div>
                    @endif
                    <form action="{{ route('user_subjects.store') }}" method="POST" class="mt-8">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="subject_id" value="">
                        <label for="code" class="block font-medium text-sm text-gray-700 mt-2">Subject Code</label>
                        <input type="text" name="code" id="code" placeholder="Enter subject code" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('code')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-4">
                            Join new class
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
