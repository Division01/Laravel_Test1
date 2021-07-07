@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            {{-- Si il existe des posts, on les affiche tous 1 a 1 --}}
            @if ($posts->count())
                @foreach($posts as $post)
                    <x-post :post="$post"/>
                @endforeach

                {{-- Pour la pagination, differentes pages--}}
                {{ $posts->links() }}   

            @else
                <p> User have no posts </p>
            @endif
        </div>
    </div>
@endsection