<x-app-layout>
<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md max-w-6xl w-full">
        <h1 class="text-3xl font-bold">Participants</h1>
        <p class="mt-4">Teacher: {{ $users->where('id', $subjects->where('id', request()->route('subject'))->first()->creator_id)->first()->name }}</p>
        
        <p class="mt-4">Total Participants: {{ $user_subjects->where('subject_id', request()->route('subject'))->count() }}</p>
        <ol class="mt-4 list-decimal">
            @foreach($user_subjects as $key => $user_subject)
                @foreach($users as $user)
                    @if($user->id == $user_subject->user_id && $user_subject->subject_id == request()->route('subject'))
                        <li class="mt-2">{{ $user->name }}</li>
                    @endif
                @endforeach
            @endforeach
        </ol>
    </div>
</div>
</x-app-layout>
