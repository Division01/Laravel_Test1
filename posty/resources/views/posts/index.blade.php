@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            {{-- Créer un nouveau post --}}
            <form actions=" {{ route('posts') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" row="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                    placeholder="Post something !"> </textarea>

                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium"> Post </button>
                </div>
            </form>

            {{-- Si il existe des posts, on les affiche tous 1 a 1 --}}
            @if ($posts->count())
                @foreach($posts as $post)
                <div class="mb-4 bg-gray-100 rounded-lg ">
                    <a href="" class="font-bold"> {{ $post->user->name }} </a>
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
                @endforeach

                {{-- Pour la pagination, differentes pages--}}
                {{ $posts->links() }}   

            
            @else
                <p> There are no posts </p>
            @endif

        </div>
    </div>
@endsection