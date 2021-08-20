<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Lesson') }}
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
            <video width="320" height="240" controls src="/{{ $episode->path }}">
                Your browser does not support the video tag.
            </video>
            <br>
            <a href="{{ route('lessons.show', $episode->lesson) }}">
                <button class="btn btn-dark">BACK</button>
            </a>
            <h1>{{ $episode->title }}</h1>
            <p>{{ $episode->body }}</p>
    </x-slot>
</x-app-layout>