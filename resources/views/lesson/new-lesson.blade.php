<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Lesson') }}
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
            <div class="add-answere">
                    <form method="POST" action="{{ route('lessons.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>TITLE</label>
                            <input class="form-control" type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label>ABOUT</label>
                            <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" cols="80%"></textarea>
                        </div>
                          <x-button class="ml-4 comment-button">
                                {{ __('Add Lesson') }}
                           </x-button>
                    </form>
                </div>
    </x-slot>
</x-app-layout>