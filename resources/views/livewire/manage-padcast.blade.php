<div class="row">
    <div class="col-md-12" style="padding-bottom: 2.5%;">
        @if($new == false)
          <button type="button" class="btn btn-secondary" wire:click="newPadcast" style="padding: 2%;">New Padcast</button>
        @elseif($new == true)
          <button type="button" class="btn btn-secondary" wire:click="closeForm" style="padding: 2%;">Close form</button>
        @endif
        @if($new == true)
            <br><br>
            <div class="card card-primary" style="padding: 0%;margin: 0%;">
              <div class="card-header">
                <h3 class="card-title">New Padcast</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data" action="{{ route('padcasts.store') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" id="title" class="form-control" id="exampleInputEmail1" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <textarea class="form-control" name="body" rows="3" placeholder="Enter about padcast ..."></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        @endif
    </div>
    <div class="col-md-12" style="padding-top: 2.5%;">
        @if(count($padcasts) > 0)
            <div class="card" style="padding-left: 0;margin-left: 0;min-width: 360px;">  
              <div class="card-header">
                <h3 class="card-title">{{ count($padcasts) }}Padcasts</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th >Title</th>
                      <th >Comment count</th>
                      <th>Events</th>
                    </tr>
                  </thead>
                    @foreach($padcasts as $padcast)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $padcast->title }}</td>
                              <td >{{ count($padcast->comments) }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            <button class="nav-link" wire:click="padcastRemove({{ $padcast->id }})">
                                                Remove
                                            </button>
                                            @if($listen != $padcast->id)
                                                <button class="nav-link" wire:click="padcastShow({{ $padcast->id }})">
                                                    Listen
                                                </button>
                                            @elseif($listen == $padcast->id)
                                                <button class="nav-link" wire:click="padcastHidden({{ $padcast->id }})">
                                                    Hidden
                                                </button>
                                            @endif
                                      </div>
                                    </div>
                              </td>
                              
                            </tr>
                            @if($listen == $padcast->id)
                                <tr style="padding-top: 2%;">
                                    <td style="width: 100%;">
                                        <p style="text-align:center;display:block;">{{ $padcast->body }}</p>
                                        <audio controls src="/{{ $padcast->path }}" style="width: 100%;"></audio>
                                    </td>
                                    
                                </tr>
                            @endif

                        </tbody>
                    @endforeach
            <!-- /.card -->
            </table>
          </div>
        @endif
    </div>
</div>