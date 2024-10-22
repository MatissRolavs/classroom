<x-app-layout>
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4 rounded-md shadow-md">
        <form method="POST" action="{{ route('subject.store') }}">
            @csrf

            <div class="mt-4">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="block w-full mt-1" value="{{ old('name') }}" required autofocus />
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="group">Group</label>
                <input type="text" id="group" name="group" class="block w-full mt-1" value="{{ old('group') }}" required />
                @error('group')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="block w-full mt-1" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <input type="hidden" id="code" name="code" class="block w-full mt-1" value="{{ Str::random(8) }}" required readonly />
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

            <div class="mt-4 flex items-center justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Create
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

