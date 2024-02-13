@extends('layout.app')

    @section('title') Create @endsection

    @section('content')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('posts.store')}}" method="post" autocomplete="off">
        @csrf
            <div class="mx-5">
                <div class="mb-3">
                    <label for="title" class="form-label" >Title</label>
                    <input type="text" name="title" class="form-control" id="title" autofocus  placeholder="Add the post's title" value="{{old('title')}}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label" >Description</label>
                    <textarea name="description" class="form-control" id="description" rows="3" value="{{old('description')}}"></textarea>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Post Creator</label>
                    <select name="post_creator" class="form-control">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>
        <form>
    @endsection  