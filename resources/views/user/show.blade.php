

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="content">
            @if(count($errors))
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @auth()
                <div class="col-md-8">
                    <div class="img-left">
                        <img src="https://www.gravatar.com/avatar/392f4893a64a4929c2ab2b78dba4421a.jpg?s=150&d=mp">
                    </div>
                    <div class="username">
                        <a href="#"><h1>{{ $selecteduser->name }}</h1></a>
                    </div>
                    <div class="tbl-information">
                        <table>
                            <tr>
                                <th><a href="{{ route('showFollowers', $selecteduser) }}">Followers</a></th>
                                <th style="padding-left: 30%;"><a href="{{ route('showFollowing', $selecteduser) }}">Following</a></th>
                                <th style="padding-left: 60%;">Reputation</th>
                            </tr>
                            <tr>
                                <td>25</td>
                                <td style="padding-left: 30%;">25</td>
                                <td style="padding-left: 60%;">{{ $selecteduser->reputation }}</td>
                            </tr>
                        </table>
                    </div>
                    <h1 class="about">Persian Bit user from {{ $selecteduser->created_at }}</h1>
                    <form method="post" action="{{ route('user.follow', $selecteduser) }}">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-info" value="Follow">
                    </form>
                    <br>
                    <hr>
                    @yield('in_article')
                    <br>
                    @yield('out_article')
                </div>
                <div class="col-md-4">
                    @include('layouts.leftUserNavbar')    
                </div>
            @else
                <div class="col-md-12">
                    <div class="img-left">
                        <img src="https://www.gravatar.com/avatar/392f4893a64a4929c2ab2b78dba4421a.jpg?s=150&d=mp">
                    </div>
                    <div class="username">
                        <a href="#"><h1>{{ $selecteduser->name }}</h1></a>
                    </div>
                    <div class="tbl-information">
                        <table>
                            <tr>
                                <th><a href="{{ route('showFollowers', $selecteduser) }}">Followers</a></th>
                                <th style="padding-left: 30%;"><a href="{{ route('showFollowing', $selecteduser) }}">Following</a></th>
                                <th style="padding-left: 60%;">Reputation</th>
                            </tr>
                            <tr>
                                <td>25</td>
                                <td style="padding-left: 30%;">25</td>
                                <td style="padding-left: 60%;">{{ $selecteduser->reputation }}</td>
                            </tr>
                        </table>
                    </div>
                    <h1 class="about">Persian Bit user from {{ $selecteduser->created_at }}</h1>
                    <form method="post" action="{{ route('user.follow', $selecteduser) }}">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-info" value="Follow">
                    </form>
                    <br>
                    <hr>
                    @yield('in_article')
                    <br>
                    @yield('out_article')
                </div>
            @endif

    </x-slot>
</x-app-layout>