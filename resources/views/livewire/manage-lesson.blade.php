<div class="row">
    <div class="col-md-12" style="padding-bottom: 2.5%;">
        <button type="button" class="btn btn-secondary" wire:click="showAll" style="padding: 2%;">All</button>
        <button type="button" class="btn btn-secondary" wire:click="showAccepted" style="padding: 2%;">Approved</button>
        <button type="button" class="btn btn-secondary" wire:click="showUnaccepted" style="padding: 2%;">Unapproved</button>
    </div>
    <div class="col-md-12" style="padding-top: 2.5%;">
        <div class="card" style="padding-left: 0;margin-left: 0;min-width: 360px;">  
              <div class="card-header">
                <h3 class="card-title">{{ strtoupper($showtype) }}</h3>
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
                  @if($showtype == 'all')
                    @foreach($lessons as $lesson)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $lesson->title }}</td>
                              <td >{{ count($lesson->comments) }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            @if($lesson->accept == 0)
                                                <button class="nav-link" wire:click="lessonAccept({{ $lesson->id }})">
                                                Accept
                                                </button>
                                            @elseif($lesson->accept == 1)
                                                <button lessonclass="nav-link" wire:click="lessonUnaccept({{ $lesson->id }})">
                                                Unaccept
                                                </button>
                                            @endif
                                            <button class="nav-link" wire:click="lessonRemove({{ $lesson->id }})">
                                                Remove
                                            </button>
                                      </div>
                                    </div>
                              </td>
                              
                            </tr>

                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'approved')
                    @foreach($approved as $lesson)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $lesson->title }}</td>
                              <td >{{ count($lesson->comments) }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            <button class="nav-link" wire:click="lessonUnaccept({{ $lesson->id }})">
                                                Unaccept
                                            </button>
                                            <button class="nav-link" wire:click="lessonRemove({{ $lesson->id }})">
                                                Remove
                                            </button>
                                      </div>
                                    </div>
                              </td>
                            </tr>
                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'unapproved')
                    @foreach($unapproved as $lesson)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $lesson->title }}</td>
                              <td >{{ count($lesson->comments) }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            <button class="nav-link" wire:click="lessonAccept({{ $lesson->id }})">
                                                Accept
                                            </button>
                                            <button class="nav-link" wire:click="lessonRemove({{ $lesson->id }})">
                                                Remove
                                            </button>
                                      </div>
                                    </div>
                              </td>
                            </tr>
                        </tbody>
                    @endforeach
                  @endif
            <!-- /.card -->
            </table>
        </div>
    </div>
</div>