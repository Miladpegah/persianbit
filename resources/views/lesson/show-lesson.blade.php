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
            <video width="320" height="240" controls src="/{{ $lesson->episodes->first()->path }}">
            </video>
            <div class="row" style="margin-top: 5%;">
                <div class="col-md-4">
                    <h1>{{ $lesson->title }}</h1><br><br>
                    <h2>Episode lenghts : {{ $lesson->episodes->count() }}</h2>
                    <br>
                    <h2>Status : {{ $lesson->status }}</h2>
                    <br>
                    <h1>Price : FREE FOR MEMBERS</h1>
                    @auth()
                        @if(auth()->user()->id == $lesson->user_id)
                            @can('owner', $lesson)
                                <div class="lesson-title-action">
                                        <h1>Determine the status</h1><br>
                                        <form action="{{ route('lesson.updateStatus', $lesson) }}" method="post">
                                            @csrf
                                           <div class="form-check form-check-inline">
                                              <label class="form-check-label" for="inlineRadio1">Teaching</label>
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="teaching"
                                              @if ($lesson->status == 'teaching')
                                                checked
                                              @endif
                                              >
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <label class="form-check-label" for="inlineRadio2">Finished</label>
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="finished"
                                              @if ($lesson->status == 'finished')
                                                checked
                                              @endif
                                              >
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <button type="submit" name="submit" class="btn btn-dark">Save</button>
                                            </div>
                                        </form>
                                </div>
                            @endcan
                        @endif
                    @endif
                </div> 
                <div class="col-md-8">
                    <p>
                        {{ $lesson->body }}
                    </p>
                    @auth()
                        @can('owner', $lesson)
                            @if(auth()->user()->id == $lesson->user_id)
                                <a href="{{ route('add.episode', $lesson)  }}" class="btn btn-warning">ADD NEW EPISODE</a>
                            @endif
                        @endcan
                    @endif
                    <br><hr>
                    <h1>Episodes</h1>
                    @foreach($lesson->episodes as $episod)
                        <div class="episodes">
                                <a href="{{ route('episode.show', $episod) }}">{{ $episod->title }}</a>
                                <h1>{{ $episod->created_at }}</h1>
                            @auth()
                                @if(auth()->user()->id == $lesson->user_id)
                                   <div class="action">
                                    <form action="{{ route('destroy.episode', $episod) }}" method="post">
                                        @csrf
                                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                   </div>
                                @endif
                            @endif
                        </div>
                            <br><br><br><hr>
                    @endforeach
                </div>
            </div>
    </x-slot>
</x-app-layout>