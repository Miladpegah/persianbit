<div>
    <i class="gg-chevron-up" wire:click="positiveVote"></i>
    <h1>{{ $answere->vote }}</h1>
    <i class="gg-chevron-down" wire:click="negativeVote"></i>

    @if($answere->question->answered == false || $answere->question->solution != $answere->id)
        <i class="gg-check-o" wire:click="bestAnswere"></i>
    @elseif($answere->question->answered == true && $answere->question->solution == $answere->id)
        <i class="gg-check-o" style="color: green;" wire:click="notBestAnswere"></i>
    @endif
</div>

