@extends('layout.app')

  @section('title') index @endsection

  @section('content')
    <div class="text-center">
        <a href="{{route('posts.create')}}" class="btn btn-success">Create a post</a>
    </div>

    <!--Search bar-->
    <nav class="navbar bg-light">
      <div class="container-fluid">
        <form class="d-flex" id="searchForm" method="GET" onsubmit="search(event)">
          <input class="form-control me-2" type="text" name="keyword" id="keyword" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <!--check for erros in seach bar keyword
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
  -->
    <!--Show posts-->
    <div>
      <table class="table text-center mt-3 mx-3">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posts By</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
              @component('components.post-component', ['post' => $post])@endcomponent
          @endforeach
        </tbody>
      </table>
    </div>

  @endsection
