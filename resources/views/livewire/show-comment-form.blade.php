<div style="width: 100%;">
   @if($show == false)
    <button class="nav-link" wire:click="show">Add comment</button>
   @elseif($show == true)
    <div class="add-comment">
        <form method="POST" action="{{ route('add.question.comment', $question) }}">
            @csrf
            <div class="comment-input">
                <x-label for="name" :value="__('Add comment')" />

                <x-input id="text" class="block mt-1 w-full " type="text" name="text" :value="old('text')" required autofocus />
            </div>

                <x-button class="ml-4 comment-button">
                                    {{ __('Add comment') }}
                </x-button>
        </form>
    </div>
   @endif
</div>
