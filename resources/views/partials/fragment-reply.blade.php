<div class="bg-secondary-2 rounded-2xl my-2 pb-2">
   <div class="abosolute flex items-center p-4 z-10">
      <img src="{{ asset('img/profile_user/' . $reply->author->avatar) }}" alt="{{ $reply->author->username }}"
         class="w-10 block rounded-full mr-4 shadow-sm">
      <div>
         <p class="flex flex-col">
            <span class="mr-2">
               {{ $is_menfess ? $reply->author->disguise($reply->author->username) : $reply->author->name }}
            </span>
            <a href="/{{ $reply->author->username }}/status"
               class="text-secondary-grey text-xs {{ $is_menfess ? 'hidden' : null }}">
               <span>@</span>{{ $reply->author->username }}
            </a>
         </p>
         <p class="text-xs text-secondary-grey">{{ $reply->created_at->diffForhumans() }}</p>
      </div>
   </div>
   <div class="ml-[4.5rem] text-justify mr-10">
      <small>{!! $reply->content !!}</small>
      @include('partials.replies', ['comment' => $comment, 'post_id' => $post_id])
   </div>
</div>
