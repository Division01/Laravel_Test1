@props(['post' => $post])

<div class="mb-4 bg-gray-100 rounded-lg">
    <a href="{{ route('users.posts', $post->user ) }}" class="font-bold"> {{ $post->user->name }} </a>
    <span class="text-gray-600 text-sm"> {{ $post->created_at->diffForHumans() }} </span>

    <p class="mb-2"> {{ $post->body }} </p>


    {{-- Bouton Delete --}}
    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan 
    
    {{-- Boutons Likes et Unlike --}}
    <div class="flex items-center">
        @auth
            @if (!$post->likedBy(auth()->user()))
            {{-- Deux choses interessantes, la premiere ici c'est qu'on peut envoyer soit l'id soit le post --}}
            <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                @csrf 
                <button type="submit" class="text-blue-500">Like</button>
            </form>

            @else 
            {{-- La deuxieme c'est qu'on peut pas utiliser la methode destroy en HTML apparemment, donc le @method sous le csrf --}}
            <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500">Unlike</button>
            </form>

            @endif
        @endauth 

        {{-- Compteur des likes --}}
        <span>{{ $post->likes->count() }} {{ Str::plural('like', 
        $post->likes->count() ) }}</span>

    </div>