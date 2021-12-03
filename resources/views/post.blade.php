<x-layout>
    <article>
        <h1>{{ $post->title }}</h1>

        <p>
            <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </p>

        <div>
            {!! $post->body; !!}
        </div>
    </article>
    <a href="/">Go Back</a>
    <section class="mt-10">
        <x-card>
            @auth
            <form method="POST" action="/posts/{{ $post->slug }}/comments">
                @csrf

                <header>
                    <h2>Want to participate?</h2>
                </header>

                <input class="border border-gray-400 p-2 w-full"
                    type="hidden"
                    name="user_id"
                    id="user_id"
                    value="{{ $post->use }}"
                    required
                >
                <div class="mt-6">
                    <textarea 
                        name="body" 
                        class="w-full text-sm focus:outline-none focus:ring" 
                        rows="5" 
                        placeholder="Quick, think of something to say!">
                    </textarea>
                </div>

                <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                    <button type="submit" class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Post</button>
                </div>
            </form>
            @endauth
        </x-card>
        
            @foreach ($post->comments as $comment)
                <x-post-comment :comment="$comment" />  
            @endforeach 
       

    </section>
</x-layout>
