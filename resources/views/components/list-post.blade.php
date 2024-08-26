<div>
    @if ($posts->count())
        <div class="grid grid-cols-2-custom sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 md:gap-5 m-7 ">
            @foreach ($posts as $post)
                <div>
                    <a href="{{route('posts.show', ['post' => $post, 'user' => $post->user,])}}">
                        <img class="rounded-lg" src="{{ asset('uploads') . '/' . $post->image}}" alt="Post Image {{$post->title}}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-4">
            {{$posts->links()}}
        </div>
    @else
        <p class="text-center">No hay Posts, sigue a alguien para ver posts</p>
    @endif
</div>