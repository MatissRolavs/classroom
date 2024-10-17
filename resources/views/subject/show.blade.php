
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

