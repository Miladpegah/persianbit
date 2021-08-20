<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New JOB') }}
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
                    <form method="POST" action="{{ route('jobs.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>TITLE</label>
                            <input class="form-control" type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label>ABOUT</label>
                            <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3" cols="80%"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email">
                        </div>
                        <div class="form-group">
                            <label>PHONE</label>
                            <input class="form-control" type="number" name="phone">
                        </div>
                        <div class="form-group">
                            <label>ADDRESS</label>
                            <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3" cols="80%"></textarea>
                        </div>
                        
                          <x-button class="ml-4 comment-button">
                                {{ __('Add Lesson') }}
                           </x-button>
                    </form>
                </div>
    </x-slot>
</x-app-layout>