
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Subjects</div>

                    <div class="card-body">
                        
                                @foreach($subjects as $subject)
                                <a href="{{ route('subject.show', $subject->id) }}">
                                    
                                        {{ $subject->name }}
                                        {{ $subject->group }}
                                        {{ $subject->description }}
   
                                </a>
                                <br>
                                @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

