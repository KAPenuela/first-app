<x-app-layout>

<script src="//unpkg.com/alpinejs" defer></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Posts') }}
</h2>
</x-slot>

<div class="py-12" x-data="{ openCreate:false }">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">

<!-- Create Post Button -->
<div class="mb-6">

<button
@click="openCreate=true"
class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md shadow transition duration-150">
Create Post
</button>

</div>


<!-- CREATE POST MODAL -->
<div
x-show="openCreate"
class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
x-transition>

<div class="bg-white rounded-lg shadow-lg p-10 w-full max-w-2xl">

<h2 class="text-2xl font-bold mb-6">
Create New Post
</h2>

<form method="POST" action="{{ route('posts.store') }}">
@csrf

<div class="mb-4">
<label class="block text-gray-700 mb-2">
Title
</label>

<input
type="text"
name="title"
class="w-full border rounded-md px-4 py-2 focus:ring focus:ring-indigo-200">
</div>

<div class="mb-6">
<label class="block text-gray-700 mb-2">
Content
</label>

<textarea
name="content"
rows="5"
class="w-full border rounded-md px-4 py-2 focus:ring focus:ring-indigo-200"></textarea>
</div>

<div class="flex justify-between">

<button
type="button"
@click="openCreate=false"
class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-md">
Cancel
</button>

<button
type="submit"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md">
Save Post
</button>

</div>

</form>

</div>

</div>


<!-- Table -->
<div class="border border-gray-100 rounded-lg overflow-hidden">

<table class="min-w-full">

<thead class="bg-gray-50">

<tr>
<th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase">
Title
</th>

<th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase">
Content
</th>

<th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase">
Actions
</th>
</tr>

</thead>

<tbody class="bg-white divide-y divide-gray-100">

@foreach ($posts as $post)

<tr>

<td class="px-6 py-4 text-sm text-gray-900">
{{ $post->title }}
</td>

<td class="px-6 py-4 text-sm text-gray-600">
{{ $post->content }}
</td>

<td class="px-6 py-4 whitespace-nowrap">

<div class="flex space-x-2">

<!-- EDIT MODAL -->
<div x-data="{ openEdit:false }">

<button
@click="openEdit=true"
class="border border-black text-black bg-yellow-500 px-4 py-1 rounded text-xs font-bold">
Edit
</button>

<div
x-show="openEdit"
class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
x-transition>

<div class="bg-white rounded-lg shadow-lg p-10 w-full max-w-2xl">

<h2 class="text-2xl font-bold mb-6">
Edit Post
</h2>

<form method="POST" action="{{ route('posts.update',$post) }}">
@csrf
@method('PUT')

<div class="mb-4">
<label class="block text-gray-700 mb-2">
Title
</label>

<input
type="text"
name="title"
value="{{ $post->title }}"
class="w-full border rounded-md px-4 py-2 focus:ring focus:ring-indigo-200">
</div>

<div class="mb-6">
<label class="block text-gray-700 mb-2">
Content
</label>

<textarea
name="content"
rows="5"
class="w-full border rounded-md px-4 py-2 focus:ring focus:ring-indigo-200">{{ $post->content }}</textarea>
</div>

<div class="flex justify-between">

<button
type="button"
@click="openEdit=false"
class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-md">
Cancel
</button>

<button
type="submit"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-md">
Update Post
</button>

</div>

</form>

</div>

</div>

</div>


<!-- Delete -->
<form id="delete-form-{{ $post->id }}"
method="POST"
action="{{ route('posts.destroy', $post) }}">

@csrf
@method('DELETE')

<button
type="button"
onclick="confirmDelete({{ $post->id }})"
class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-xs font-bold transition">
Delete
</button>

</form>

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="mt-4">
{{ $posts->links() }}
</div>

</div>
</div>
</div>


<!-- Delete Confirmation -->
<script>

function confirmDelete(id) {

Swal.fire({
title: 'Are you sure?',
text: "This post will be permanently deleted.",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#dc2626',
cancelButtonColor: '#4f46e5',
confirmButtonText: 'Yes, delete it!',
cancelButtonText: 'No, keep it'
}).then((result) => {

if (result.isConfirmed) {
document.getElementById('delete-form-' + id).submit();
}

})

}

</script>


<script>

@if(session('success'))

Swal.fire({
icon: 'success',
title: 'Done!',
text: "{{ session('success') }}",
position: 'center',
showConfirmButton: false,
timer: 2000,
timerProgressBar: true
});

@endif

</script>

</x-app-layout>