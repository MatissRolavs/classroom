<x-app-layout>
    <h1>Subjects</h1>
                        
    @foreach($subjects as $subject)
        @foreach($user_subjects as $user_subject)
            @if($subject->id == $user_subject->subject_id && $user_subject->user_id == auth()->user()->id )
                <a href="{{ route('subject.show', $subject->id) }}">
                    
                    {{ $subject->name }}
                    {{ $subject->group }}
                    {{ $subject->description }}
   
                </a>
                <br>
            @endif
        @endforeach
    @endforeach
    <form action="{{ route('user_subjects.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="subject_id" value="">
        <input type="text" name="code" placeholder="Enter subject code" required>
        @error('code')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <button type="submit">Join new class</button>
    </form>


</x-app-layout>
       

