@extends('layouts.master')
@section('content')
<div class="main-wrapper">
    <router-view :items="{{json_encode($posts)}}" :category_items="{{json_encode($categories)}}" :auth_user='@json($auth_user)'></router-view>
    {{-- <post-container :items="{{json_encode($posts)}}"></post-container> --}}
    
{{-- <div> --}}
@endsection
