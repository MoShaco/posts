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

    <script>
      async function search(event) {
          event.preventDefault();

          let keyword = document.querySelector('#keyword').value;

          let response = await fetch('{{ route('posts.search') }}?' + new URLSearchParams({keyword}));

          if (response.ok) {
              let data = await response.text();

              // Assuming your response contains only the HTML for the posts
              let postsHtml = document.createRange().createContextualFragment(data);
              
              // Clear the existing content in the <tbody>
              document.querySelector('tbody').innerHTML = '';

              // Append the new posts HTML to the <tbody>
              document.querySelector('tbody').appendChild(postsHtml);
          } else {
              console.error('Error in AJAX request');
          }
      }
  </script>

  @endsection
