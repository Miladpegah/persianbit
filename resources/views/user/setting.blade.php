@extends('layouts.dashboardBasic')
@section('in_article')

            <div class="row">
                <div class="information-form col-12 col-md-8 offset-md-3">
                    <label>Edit Information</label>
                    <form method="POST" action="{{ route('user.update', $user) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div>
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Name" value="{{ $user->name }}"  autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Email" value="{{ $user->email }}"/>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            placeholder="Password"
                                            autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" placeholder="Confirm Password"/>
                        </div>

                        <div class="flex items-center justify-end mt-4" style="margin-left: 20%;">
                            <x-button class="ml-4">
                                {{ __('Send') }}
                            </x-button>
                        </div>
                    </form>
                </div>
                <div class="Spic">
                    <div class="spacialty-form" style="display: inline-block;">
                            <label>Edit Spacialties</label>
                            <form method="POST" action="{{ route('syncspacialties', $user) }}">
                                @csrf

                                <!-- Name -->
                                <select name="spatialties[]" class="form-control js-example-tokenizer" multiple="multiple">
                                    @foreach($spacialties as $spacialty)
                                        <option value="{{ $spacialty->id }}" 
                                            @foreach($user->spacialties as $skill)
                                                @if($spacialty->id == $skill->id)
                                                    selected
                                                @endif
                                            @endforeach
                                        >
                                            {{ $spacialty->name }}
                                        </option>
                                    @endforeach
                                </select>


                                <div class="flex items-center justify-end mt-4" style="margin-left: 30%;">
                                    <x-button class="ml-4">
                                        {{ __('Send') }}
                                    </x-button>
                                </div>
                            </form>
                    </div>
                    <div class="pic-form">
                        <label>Change Photo</label>
                        <form action="{{ route('userAdd.photo', $user) }}"
                          class="dropzone"
                          id="my-awesome-dropzone" method="POST">
                          @csrf
                        </form>
                    </div>
                </div>
            </div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
</script>
@stop

