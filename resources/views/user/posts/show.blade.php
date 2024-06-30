<x-user-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="bg-white shadow-lg border border-gray-200 rounded-lg overflow-hidden">
            <div class="aspect-w-16 aspect-h-9">
                <img class="object-cover w-full h-full rounded-t-lg" src="{{ asset('storage/' . $post->image) }}" alt="Sample Image">
            </div>
            <div class="p-6">
                <h5 class="text-gray-900 font-bold text-xl md:text-2xl tracking-tight mb-2">{{ $post->title }}</h5>
                <p class="font-normal text-gray-700 mb-4">{{ $post->body }}</p>
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <span class="text-gray-600 text-sm mr-2">Likes: {{ $post->likes()->count() ?? 0 }}</span>
                        <span class="text-gray-600 text-sm">Comments: {{ $post->comments()->count() ?? 0 }}</span>
                    </div>
                    @if ($post->user_id === auth()->id())
                        <div>
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-600 hover:text-blue-700 mr-4">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-semibold mb-4">Comments:</h3>
                    <ul class="space-y-4">
                        @foreach($post->comments as $comment)
                            <li class="bg-gray-100 p-4 rounded-lg">
                                <div class="flex items-center mb-2">
                                    <img class="w-8 h-8 rounded-full object-cover mr-2" src="{{ asset('build/assets/avatar.png') }}" alt="{{ $comment->user->name }}">
                                    <div>
                                        <div class="text-sm text-gray-600">{{ $comment->user->name }}</div>
                                        <div class="text-sm text-gray-400">{{ $comment->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="text-gray-800">{{ $comment->comment }}</div>
                            </li>
                        @endforeach
                    </ul>
                    @auth
                        <button onclick="toggleCommentForm()" class="text-blue-600 hover:text-blue-700 mt-4">Add Comment</button>
                        <form id="comment-form" action="{{ route('posts.comments.store', $post) }}" method="POST" class="mt-4" style="display: none;">
                            @csrf
                            <div class="mb-4">
                                <textarea name="comment" rows="3" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Add a comment..."></textarea>
                                @error('content')
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
    </div>
    <script>
        function toggleCommentForm() {
            var form = document.getElementById('comment-form');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</x-user-layout>
