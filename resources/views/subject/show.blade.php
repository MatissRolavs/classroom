
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
