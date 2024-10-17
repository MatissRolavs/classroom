    <form method="POST" action="{{ route('subject.store') }}">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus />
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="group">Group</label>
            <input type="text" id="group" name="group" class="mt-1 block w-full" value="{{ old('group') }}" required />
            @error('group')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="mt-1 block w-full" required>{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4 hidden">
            <label for="code">Code</label>
            <input type="text" id="code" name="code" class="mt-1 block w-full" value="{{ Str::random(8) }}" required readonly />
            @error('code')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        @php
            $code = Str::random(8);
            while (App\Models\Subject::where('code', $code)->exists()) {
                $code = Str::random(8);
            }
        @endphp
        <input type="hidden" name="code" value="{{ $code }}" />

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Create
            </button>
        </div>
    </form>

