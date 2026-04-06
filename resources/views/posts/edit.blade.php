<x-app-layout>
    <div class="max-w-2xl mx-auto p-8 bg-white mt-10 shadow rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Post</h2>
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ $post->title }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $post->content }}</textarea>
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded font-bold hover:bg-yellow-600">Update Post</button>
        </form>
    </div>
</x-app-layout>