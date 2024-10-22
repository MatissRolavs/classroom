<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-3xl font-bold">Participants</h1>
            <ul class="mt-4">
                @foreach($user_subjects as $user_subject)
                    @foreach($users as $user)
                        @if($user->id == $user_subject->user_id && $user_subject->subject_id == request()->route('subject'))
                            <li class="mt-2">{{ $user->name }}</li>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</div>
