<x-app-layout>
    <div class="max-w-2xl mx-auto p-8 bg-white mt-10 shadow rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Create New Post</h2>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded font-bold hover:bg-indigo-700">Save Post</button>
        </form>
    </div>
</x-app-layout>