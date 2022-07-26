<div class="bg-secondary p-2 rounded-2xl">
   <h2 class="text-primary-white font-semibold text-sm mb-2">Posts Update For You.</h2>
   @foreach ($posts as $post)
      <a href="{{ route('post.show', ['posts' => $post, 'author' => $post->author]) }}"
         class="bg-secondary-2 p-2 roundec-2xl rounded-2xl mb-1 flex items-center group transition-all hover:bg-primary cursor-pointer">
         <img src="{{ asset('img/profile_user/' . $post->author->avatar) }}" alt="$post->author->name"
            class="w-6 rounded-full">
         <div class="text-secondary-grey text-sm ml-2 transition-all group-hover:text-primary-white">
            {{ strip_tags(\Illuminate\Support\Str::words($post->content, 4, '...')) }}</div>
      </a>
   @endforeach
   <a href="{{ route('home') }}" class="italic font-semibold text-xs text-purpink">Show All</a>
</div>
