<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $lesson->title }}{{ __(' New Episode') }}
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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('store.episode', $lesson) }}">
                        @csrf
                        <div class="form-group">
                            <label>TITLE</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>ABOUT</label>
                            <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" cols="80%"></textarea>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                          <x-button class="ml-4 comment-button">
                                {{ __('Add Episode') }}
                           </x-button>
                    </form>
                </div>
    </x-slot>
</x-app-layout>