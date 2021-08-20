<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show ARTICLE ') }} 
        </h2>
    </x-slot>
    <x-slot name="content">
            @if(count($errors))
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container">
                <img src="/{{ $article->poster_path }}">
                <a href="{{ route('articles.index') }}" class="btn btn-dark">BACK</a>
            </div>
            <div class="row justify-content-around" style="margin-top: 5%;">
                <div class="col-sm-6 lesson-body-episodes">
                    <h1 style="text-align: center; font-size: 200%;">{{ $article->title }}</h1>
                    <p>
                        {{ $article->body }}
                    </p>
                    <br><hr>
                    <h1>Sources: </h1>
                    <h1 style="text-align: center; font-size: 200%;">{{ $article->source_email }}</h1>
                    <a href="{{ $article->source_link }}">
                        <h1 style="text-align: center; font-size: 200%;">{{ $article->source_link }}</h1>
                    </a>
                </div>
            </div>
            <div class="container">
                <a href="{{ route('articles.index') }}" class="btn btn-dark">BACK</a>
            </div>
    </x-slot>
</x-app-layout>