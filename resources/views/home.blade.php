@extends('layouts.app')

@section('content')
    @if(Auth::user())
        @include('welcome')
    @else
        @include('login')
    @endif
@endsection
