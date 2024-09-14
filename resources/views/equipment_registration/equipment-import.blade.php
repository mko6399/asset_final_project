<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen">
        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-8 rounded-lg shadow-md">
            @csrf
            <input type="file" name="file" required class="mb-4">

            <button type="submit"
                class="bg-green-300 border-2 hover:bg-green-900 rounded-lg border-black px-4 py-2">Import Users</button>

            @if (session('success'))
                <div class="mt-4 text-green-500">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>

</x-guest-layout>
