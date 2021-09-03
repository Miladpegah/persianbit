<div class="vote">
    <i class="fas fa-chevron-up" wire:click="positiveVote"></i>
    <h1>{{ $answere->vote }}</h1>
    <i class="fas fa-chevron-down" wire:click="negativeVote"></i>
    <br><br>
    @if($answere->question->answered == false || $answere->question->solution != $answere->id)
        <i class="fas fa-check" wire:click="bestAnswere"></i>
    @elseif($answere->question->answered == true && $answere->question->solution == $answere->id)
        <i class="fas fa-check uncheck" wire:click="notBestAnswere"></i>
    @endif
</div>

