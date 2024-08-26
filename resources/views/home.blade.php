@extends('layouts.app')

@section('title')
    Principal Page
@endsection

@section('content')

    <x-list-post :posts="$posts" />


@endsection