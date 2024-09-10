<x-guest-layout>
    <div class="m-60  ">

        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required>

            <button type="submit" class="bg-green-300 border-2 hover:bg-green-900 rounded-lg border-black">Import
                Users</button>
            @if (session('success'))
                {{ session('success') }}
            @endif
        </form>

    </div>
</x-guest-layout>
