@props(['comment'])

<article class="bg-gray-100 border border-gray-200 p-6 rounded-xl">
          <header>
            {{-- <h3 class="font-bold">John Doe</h3> --}}
            <p class="text-xs">
                Posted 
                <time>{{ $comment->created_at->diffForHumans() }} </time>
            </p>
        </header>
        
        <p>
            {{ $comment->body }}
        </p>
</article>

