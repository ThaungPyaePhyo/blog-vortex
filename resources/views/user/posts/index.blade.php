<x-user-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header for Add New Post -->
        @auth
            <div class="mb-6 flex justify-end">
                <a href="{{ route('posts.create') }}"
                   class="inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 rounded-md shadow hover:from-purple-600 hover:to-blue-500 focus:ring-4 focus:ring-purple-300">
                    + Add New Post
                </a>
            </div>
        @endauth

        <!-- Blog Posts Grid (4 Cards in a Row) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($posts as $post)
                <div class="bg-gradient-to-br from-white to-gray-50 border border-gray-200 rounded-lg shadow-md overflow-hidden transition-transform duration-200 hover:scale-105">
                    <!-- Post Image -->
                    <a href="{{ route('posts.show', $post->id) }}">
                        <img class="w-full h-48 object-cover transition-opacity duration-200 hover:opacity-90"
                             src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                    </a>

                    <!-- Post Content -->
                    <div class="p-4">
                        <!-- Title -->
                        <a href="{{ route('posts.show', $post->id) }}" class="block">
                            <h2 class="text-lg font-semibold text-gray-800 hover:text-purple-600 transition-colors truncate">
                                {{ $post->title ?? '' }}
                            </h2>
                        </a>

                        <!-- Body -->
                        <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                            {{ $post->body ?? '' }}
                        </p>

                        <!-- Meta Information -->
                        <div class="mt-3 flex items-center justify-between text-sm text-gray-500">
                            <div>
                                <span class="text-gray-700">❤️ {{ $post->likes->count() ?? 0 }}</span>
                                <span class="ml-3 text-gray-700">💬 {{ $post->comments->count() ?? 0 }}</span>
                            </div>
                            <div>
                                @auth
                                    @if ($post->likes->where('user_id', auth()->id())->count())
                                        <form action="{{ route('posts.unlike', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600">Unlike</button>
                                        </form>
                                    @else
                                        <form action="{{ route('posts.like', $post) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-purple-500 hover:text-purple-600">Like</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        <!-- Add Comment -->
                        <div class="mt-3">
                            @auth
                                <a href="{{ route('posts.show', $post->id) }}"
                                   class="text-purple-500 hover:text-purple-600 text-sm">
                                    Add Comment
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </div>
</x-user-layout>
