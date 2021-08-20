@extends('layouts.dashboardBasic')
@section('in_article')
            <div class="spacialties">
                <h1>Spacialties</h1>
                <br>
                @if($user->spacialties->isEmpty())
                    <h5>No spacialty</h5>
                @else
                    @foreach ($user->spacialties as $spacialty)
                        <span class="badge badge-pill badge-dark">{{ $spacialty->name }}</span>&nbsp;
                    @endforeach
                @endif
            </div>
            <div class="roles">
                <h1>Roles</h1>
                <br>
                @if($user->roles->isEmpty())
                    <span class="badge badge-pill badge-dark">Student</span>&nbsp;
                @else
                    @foreach($user->roles as $role)
                        <span class="badge badge-pill badge-dark">{{ $role->name }}</span>&nbsp;
                    @endforeach
                @endif
                
            </div>

@stop



        