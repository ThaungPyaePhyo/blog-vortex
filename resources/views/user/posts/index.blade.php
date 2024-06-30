<x-user-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        @auth()
            <div class="mb-4">
                <a href="{{ route('posts.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center">
                    Add New Post
                </a>
            </div>
        @endauth
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white shadow-lg border border-gray-200 rounded-lg overflow-hidden">
                    <a href="{{ route('posts.show', $post->id) }}" class="block">
                        <img class="w-full h-72 object-cover" src="{{ asset('storage/' . $post->image) }}" alt="Sample Image">
                    </a>
                    <div class="p-6">
                        <a href="{{ route('posts.show', $post->id) }}">
                            <h5 class="text-gray-900 font-bold text-xl md:text-2xl tracking-tight mb-2">{{ $post->title ?? '' }}</h5>
                        </a>
                        <p class="font-normal text-gray-700 mb-4">{{ $post->body ?? '' }}</p>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <span class="text-gray-600 text-sm mr-2">Likes: {{ $post->likes->count() ?? 0 }}</span>
                                <a href="{{ route('posts.show', $post->id) }}" class="text-gray-600 text-sm hover:underline">Comments: {{ $post->comments->count() ?? 0 }}</a>
                            </div>
                            <div>
                                @auth
                                    @if ($post->likes->where('user_id', auth()->id())->count())
                                        <form action="{{ route('posts.unlike', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700">Unlike</button>
                                        </form>
                                    @else
                                        <form action="{{ route('posts.like', $post) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-700">Like</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            @auth
                                <button onclick="toggleCommentForm({{ $post->id }})" class="text-blue-600 hover:text-blue-700 mb-2">Add Comment</button>
                                <form id="comment-form-{{ $post->id }}" action="{{ route('posts.comments.store', $post) }}" method="POST" style="display: none;">
                                    @csrf
                                    <div class="mb-4">
                                        <textarea name="comment" rows="3" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Add a comment..."></textarea>
                                        @error('comment')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Submit</button>
                                    </div>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
    <script>
        function toggleCommentForm(postId) {
            var form = document.getElementById('comment-form-' + postId);
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</x-user-layout>
