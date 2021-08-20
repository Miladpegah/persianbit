<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="content">
        <div class="col-md-8">
            <article class="profContent">
            @if(count($errors))
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="img-left">
                <img src="{{ $user->photo_path }}">
            </div>
            <div class="username">
                <a href="#"><h1>{{ $user->name }}</h1></a>
            </div>
            <div class="tbl-information">
                <h4><a href="{{ route('showFollowers', $user) }}">25 Followers</a></h4>&nbsp;&nbsp;
                <h4><a href="{{ route('showFollowing', $user) }}">25 Following</a></h4>&nbsp;&nbsp;
                <h4>{{ $user->reputation }} Reputation</h4>
            </div>
                <h1 class="about">Persian Bit user from {{ $user->created_at }}</h1>
                <hr>

                @yield('in_article')

                </article>

                @yield('out_article')
        </div>
        <div class="col-md-4">
            @include('layouts.leftUserNavbar')
            
        </div>
        

    </x-slot>
</x-app-layout>