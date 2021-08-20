@auth()
  <div>
    <div class="col-md-12">
      <div class="bell">
        @if($show == false)
          @if(count($messages) <= 0)
            <p class="fa fa-bell-o" aria-hidden="true" wire:click="showMessages" style="font-size: 150%;">{{count($messages)}}</p>
          @else
            <p class="fa fa-bell" aria-hidden="true" wire:click="showMessages" style="font-size: 150%;">{{count($messages)}}</p>
          @endif
        @elseif($show == true)
          <p class="fa fa-bell-o" aria-hidden="true" wire:click="hiddenMessages" style="font-size: 150%;">{{count($messages)}}</p>
        @endif
      </div>
    </div>


    @if($show == true)
            <div class="side-bar">
              <div class="side-header">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary btn-lg" wire:click="showInformations">Informations</button>
                <button type="button" class="btn btn-primary btn-lg" wire:click="showAnnouncements">Announcements</button>
              </div>
            </div>
          <div class="side-inner" style="overflow: auto;">
            @if($message_type == false)
              @foreach($informations as $notic)
                <div class="notification">
                  <div class="notic-img">
                    <i class="fa fa-commenting" aria-hidden="true"></i>
                  </div>
                  <div class="notic-content">
                    <div class="notic-header">
                      <span class="badge badge-pill badge-dark">PERSIANBIT</span>
                    </div>
                    <div class="notic-body">
                      <p>{{ $notic->text }}</p>
                      <a class="btn btn-info" 
                        @if(get_class($notic->messagetable) == 'App\Models\Question')
                          href="{{route('questions.show', $notic->messagetable_id)}}"
                        @elseif(get_class($notic->messagetable) == 'App\Models\Answere')
                          href="{{route('questions.show', $notic->messagetable->question)}}"
                        @elseif(get_class($notic->messagetable) == 'App\Models\Document')
                          href="{{route('articles.show', $notic->messagetable_id)}}"
                        @elseif(get_class($notic->messagetable) == 'App\Models\Lesson')
                          href="{{route('lessons.show', $notic->messagetable_id)}}"
                        @endif

                      >Show</a>
                    </div>
                  </div>
                </div>
              @endforeach
            @elseif($message_type == true)
              @foreach($announcements as $notic)
                <?php 
                  $admin = $notic->messagetable;
                ?>
                <div class="notification">
                  <div class="notic-img">
                    <i class="fa fa-bullhorn" aria-hidden="true"></i>

                  </div>
                  <div class="notic-content">
                    <div class="notic-header">
                      <span class="badge badge-pill badge-dark">{{ $user->name }}</span>
                      &nbsp;
                      <span class="badge badge-pill badge-dark">PERSIANBIT</span>
                    </div>
                    <div class="notic-body">
                      <p>{{ $notic->text }}</p>
                    </div>
                  </div>
                </div>
                <hr>
              @endforeach
            @endif
          </div>
          <div class="side-footer">
                <button type="button" class="btn btn-danger btn-lg" wire:click="clearInformations">clear informations</button>
                <button type="button" class="btn btn-light" wire:click="hiddenMessages">close</button>
            </div>
            </div>
    @endif
  </div>
@endif