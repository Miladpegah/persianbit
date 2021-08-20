<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="content">
        <div class="col-md-8">
            <article class="profContent" style=" height: 100%;">
            @if(count($errors))
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('in_article')

        </article>

            @yield('out_article')
        </div>
        <div class="col-md-4">
            @include('layouts.leftQuestionNavbar')
        </div>

    </x-slot>
</x-app-layout>
