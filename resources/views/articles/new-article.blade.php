<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ARTICLE') }}
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
                    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>TITLE</label>
                            <input class="form-control" type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label>BODY</label>
                            <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" cols="80%"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Sourece Email</label>
                            <input class="form-control" type="text" name="source_email">
                        </div>
                        <div class="form-group">
                            <label>Source Link</label>
                            <input class="form-control" type="text" name="source_link">
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="file">
                            <label class="custom-file-label" for="inputGroupFile01">Poster</label>
                        </div>
                          <x-button class="ml-4 comment-button">
                                {{ __('Add Lesson') }}
                           </x-button>
                    </form>
                </div>
    </x-slot>
</x-app-layout>