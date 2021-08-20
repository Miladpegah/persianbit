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
                    @foreach($articles as $article)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $article->title }}</td>
                              <td >{{ count($article->comments) }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            @if($article->accept == 0)
                                                <button class="nav-link" wire:click="articleAccept({{ $article->id }})">
                                                Accept
                                                </button>
                                            @elseif($article->accept == 1)
                                                <button class="nav-link" wire:click="articleUnaccept({{ $article->id }})">
                                                Unaccept
                                                </button>
                                            @endif
                                            <button class="nav-link" wire:click="articleRemove({{ $article->id }})">
                                                Remove
                                            </button>
                                            @if($show != $article->id)
                                                <button class="nav-link" wire:click="articleShow({{ $article->id }})">
                                                    Show
                                                </button>
                                            @elseif($show == $article->id)
                                                <button class="nav-link" wire:click="articleHidden({{ $article->id }})">
                                                    Hidden
                                                </button>
                                            @endif
                                      </div>
                                    </div>
                              </td>
                              
                            </tr>
                            @if($show == $article->id)
                                <tr style="padding-top: 2%;">
                                    <td style="width: 50%;">
                                      <img src="/{{ $article->poster_path }}" style="width: 100%;">
                                    </td>
                                    <td style="text-align:center;width: 50%;">
                                        <h5>{{ $article->title }}</h5>
                                        <p>{{ $article->body }}</p>
                                        <p>Source link : <a href="{{ $article->source_link }}">{{ $article->source_link }}</a></p>
                                        <p>Source email : {{ $article->source_email }}</p>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'approved')
                    @foreach($approved as $article)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $article->title }}</td>
                              <td >{{ count($article->comments) }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            <button class="nav-link" wire:click="articleUnaccept({{ $article->id }})">
                                                Unaccept
                                            </button>
                                            <button class="nav-link" wire:click="articleRemove({{ $article->id }})">
                                                Remove
                                            </button>
                                            @if($show != $article->id)
                                                <button class="nav-link" wire:click="articleShow({{ $article->id }})">
                                                    Show
                                                </button>
                                            @elseif($show == $article->id)
                                                <button class="nav-link" wire:click="articleHidden({{ $article->id }})">
                                                    Hidden
                                                </button>
                                            @endif
                                      </div>
                                    </div>
                              </td>
                            </tr>
                            @if($show == $article->id)
                                <tr style="padding-top: 2%;">
                                    <td style="width: 50%;">
                                      <img src="/{{ $article->poster_path }}" style="width: 100%;">
                                    </td>
                                    <td style="text-align:center;width: 50%;">
                                        <h5>{{ $article->title }}</h5>
                                        <p>{{ $article->body }}</p>
                                        <p>Source link : <a href="{{ $article->source_link }}">{{ $article->source_link }}</a></p>
                                        <p>Source email : {{ $article->source_email }}</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'unapproved')
                    @foreach($unapproved as $article)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">{{ $article->title }}</td>
                              <td >{{ count($article->comments) }}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Events
                                      </button>
                                      <div class="dropdown-menu">
                                            <button class="nav-link" wire:click="articleAccept({{ $article->id }})">
                                                Accept
                                            </button>
                                            <button class="nav-link" wire:click="articleRemove({{ $article->id }})">
                                                Remove
                                            </button>
                                            @if($show != $article->id)
                                                <button class="nav-link" wire:click="articleShow({{ $article->id }})">
                                                    Show
                                                </button>
                                            @elseif($show == $article->id)
                                                <button class="nav-link" wire:click="articleHidden({{ $article->id }})">
                                                    Hidden
                                                </button>
                                            @endif
                                      </div>
                                    </div>
                              </td>
                            </tr>
                            @if($show == $article->id)
                                <tr style="padding-top: 2%;">
                                    <td style="width: 50%;">
                                      <img src="/{{ $article->poster_path }}" style="width: 100%;">
                                    </td>
                                    <td style="text-align:center;width: 50%;">
                                        <h5>{{ $article->title }}</h5>
                                        <p>{{ $article->body }}</p>
                                        <p>Source link : <a href="{{ $article->source_link }}">{{ $article->source_link }}</a></p>
                                        <p>Source email : {{ $article->source_email }}</p>
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