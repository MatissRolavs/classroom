
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Subjects</div>

                    <div class="card-body">
                        
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
                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                            <input type="text" name="code" placeholder="Enter subject code" required>
                            <button type="submit">Join new class</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

