
<!--Show posts-->
    @foreach($posts as $post)
        @component('components.post-component', ['post' => $post])@endcomponent
    @endforeach