@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1"> {{ $user->name }} </h1>
                <p> Number of posts : {{ $posts->count() }} </p>
                <p> Number of received likes : {{ $user->receivedLikes->count() }}</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg">
            {{-- Si il existe des posts, on les affiche tous 1 a 1 --}}
            @if ($posts->count())
                @foreach($posts as $post)
                    <x-post :post="$post"/>
                    <div class="bg-white p-6 rounded-lg"></div>
                @endforeach

                {{-- Pour la pagination, differentes pages--}}
                {{ $posts->links() }}   

            @else
                <p> User have no posts </p>
            @endif
            </div>
        </div>
    </div>
@endsection