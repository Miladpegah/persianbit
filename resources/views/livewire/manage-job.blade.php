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
                      <th>Events</th>
                    </tr>
                  </thead>
                  @if($showtype == 'all')
                    @foreach($jobs as $job)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $job->title }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            @if($job->accept == 0)
                                                <button class="nav-link" wire:click="jobAccept({{ $job->id }})">
                                                Accept
                                                </button>
                                            @elseif($job->accept == 1)
                                                <button class="nav-link" wire:click="jobUnaccept({{ $job->id }})">
                                                Unaccept
                                                </button>
                                            @endif
                                            <button class="nav-link" wire:click="jobRemove({{ $job->id }})">
                                                Remove
                                            </button>
                                            @if($show != $job->id)
                                                <button class="nav-link" wire:click="jobShow({{ $job->id }})">
                                                    Show
                                                </button>
                                            @elseif($show == $job->id)
                                                <button class="nav-link" wire:click="jobHidden({{ $job->id }})">
                                                    Hidden
                                                </button>
                                            @endif
                                      </div>
                                    </div>
                              </td>
                              
                            </tr>
                            @if($show == $job->id)
                                <tr style="padding-top: 2%;">
                                    <td style="text-align:center;width: 50%;">
                                        <p>{{ $job->body }}</p>
                                        <p>email : {{ $job->email }}</p>
                                        <p>phone : {{ $job->phone }}</p>
                                        <p>address : {{ $job->address }}</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'approved')
                    @foreach($approved as $job)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $job->title }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            <button class="nav-link" wire:click="jobUnaccept({{ $job->id }})">
                                                Unaccept
                                            </button>
                                            <button class="nav-link" wire:click="jobRemove({{ $job->id }})">
                                                Remove
                                            </button>
                                            @if($show != $job->id)
                                                <button class="nav-link" wire:click="jobShow({{ $job->id }})">
                                                    Show
                                                </button>
                                            @elseif($show == $job->id)
                                                <button class="nav-link" wire:click="jobHidden({{ $job->id }})">
                                                    Hidden
                                                </button>
                                            @endif
                                      </div>
                                    </div>
                              </td>
                            </tr>
                            @if($show == $job->id)
                                <tr style="padding-top: 2%;">
                                    <td style="text-align:center;width: 50%;">
                                        <p>{{ $job->body }}</p>
                                        <p>email : {{ $job->email }}</p>
                                        <p>phone : {{ $job->phone }}</p>
                                        <p>address : {{ $job->address }}</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'unapproved')
                    @foreach($unapproved as $job)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $job->title }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            <button class="nav-link" wire:click="jobAccept({{ $job->id }})">
                                                Accept
                                            </button>
                                            <button class="nav-link" wire:click="jobRemove({{ $job->id }})">
                                                Remove
                                            </button>
                                            @if($show != $job->id)
                                                <button class="nav-link" wire:click="jobShow({{ $job->id }})">
                                                    Show
                                                </button>
                                            @elseif($show == $job->id)
                                                <button class="nav-link" wire:click="jobHidden({{ $job->id }})">
                                                    Hidden
                                                </button>
                                            @endif
                                      </div>
                                    </div>
                              </td>
                            </tr>
                            @if($show == $job->id)
                                <tr style="padding-top: 2%;">
                                    <td style="text-align:center;width: 50%;">
                                        <p>{{ $job->body }}</p>
                                        <p>email : {{ $job->email }}</p>
                                        <p>phone : {{ $job->phone }}</p>
                                        <p>address : {{ $job->address }}</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endforeach
                  @endif
            <!-- /.card -->
            </table>
        </div>
    </div>
</div>