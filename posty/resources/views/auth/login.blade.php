@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">

            @if (session('status'))
                {{ session('status') }}
            @endif

            <form action="{{ route('login') }}" method="POST">

                @csrf 

                <div class="mb-4">
                    <label for="email" class="sr-only"> Email </label>
                    <input type="text" name="email" id="email" placeholder="Your email" class="bg-gray-100 border-2 w-full px-2 py-4 rounded-lg" value="{{ old('email') }}">
                    
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="password" class="sr-only"> Password </label>
                    <input type="password" name="password" id="password" placeholder="Your password" class="bg-gray-100 border-2 w-full px-2 py-4 rounded-lg" value="{{ old('password') }}">
                    
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full"> Login </button>
                </div>

            </form>
        </div>
    </div>
@endsection