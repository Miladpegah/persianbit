<div class="vote">
    <i class="fas fa-chevron-up " wire:click="positiveVote"></i>
    <h1>{{ $question->vote }}</h1>
    <i class="fas fa-chevron-down" wire:click="negativeVote"></i>
</div>

