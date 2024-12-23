<x-user-layout>
    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="p-8 border-b border-gray-200">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-8">Create New Post</h2>

                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 text-sm @error('title') border-red-500 @enderror"
                            placeholder="Enter the post title...">
                        @error('title')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Body -->
                    <div class="mb-6">
                        <label for="body" class="block text-sm font-semibold text-gray-700 mb-2">Body</label>
                        <textarea id="body" name="body" rows="6"
                            class="block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 text-sm @error('body') border-red-500 @enderror"
                            placeholder="Write your post content here...">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 text-sm @error('image') border-red-500 @enderror">
                        @error('image')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('posts.index') }}"
                            class="px-5 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>
