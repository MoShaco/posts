@extends('layout.app')

    @section('title') index @endsection

    @section('content')
        <div class="card">
            <div class="card-header">
                Post Info
            </div>
            <div class="card-body">
                <h5 class="card-title">Title: {{$post->title}}</h5>
                <p class="card-text">{{$post->description}}</p>
            </div>
        </div>   
        <div class="card mt-4">
            <div class="card-header">
                Post Created Info
            </div>
            <div class="card-body">
                <h5 class="card-title">Name: {{$post->user ? $post->user->name : 'Not found'}}</h5>
                <p class="card-text">Email: {{$post->user ? $post->user->email : 'Not found'}}</p>
                <p class="card-text">Created at: {{$post->user ? $post->user->created_at : 'Not found'}}</p>
            </div>
        </div>
    @endsection  
