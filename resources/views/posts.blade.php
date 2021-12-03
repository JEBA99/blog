<x-layout>
    <nav class="md:flex md:justify-end md:items-center">
        <div class="mt-8 md:mt-0 flex items-center">
            @auth
                <span class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->name }}</span>


                <form method="POST" action="/logout" class="text-xs font-semibold text-blue-500 ml-6">
                    @csrf

                        <button type="submit">Log Out</button>
                        <a href="/admin/posts/create" class="ml-6 text-xs font-bold uppercase">Create Post</a>
                </form>
                @if (auth()->user()->can('admin'))
                    <a href="/dashboard" class="ml-6 text-xs font-bold uppercase">Dashboard</a>
                @endif
                  
            @else
                <a href="/register" class="text-xs font-bold uppercase">Register</a>
                <a href="/login" class="ml-6 text-xs font-bold uppercase">Log In</a>
            
            @endauth 
            
            
        </div>
    </nav>
    @foreach ($posts as $post)
        <article class="{{ $loop->even ? 'mb-6' : ''}}">
            <div class="flex">
                <div class="flex-1">
                    <h1>    
                        <a href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </a>
                    </h1>

                    <p>
                        <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
                    </p>
            
                    <div class="text-red-500">
                        {{ $post->excerpt }}
                    </div>
                </div>
                {{-- <div class="flex-1">
                    <p>
                        Published {{ diffForHumans(Carbon::parse('2021-05-01 00:22:35')); }} ago
                    </p>
                </div> --}}
                <div class="flex-1">
                    <button>
                        <a href="/admin/posts/show/{{ $post->slug }}">
                            Edit Post
                        </a>
                    </button>
                </div>
                <div class="flex-1">
                    <form method="POST" action="/admin/posts/{{ $post->slug }}">
                        @csrf
                        @method('DELETE')
                        <button>
                            Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </article>
    @endforeach
</x-layout>