@extends('website.layouts.website')

@section('title', 'Người dùng')
@section('styles')
    <style type="text/css">

    </style>
@endsection
@section('content')
    <div class="container">
        <h1>User online</h1>
        @if ($users)
            <ul>
                @foreach ($users as $user)
                    @if ($user->isOnline())
                        <li><h4>{{$user->name}}</h4></li>
                    @else
                        <li></li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
@endsection
