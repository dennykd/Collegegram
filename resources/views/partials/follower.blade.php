<div class="bg-secondary rounded-2xl mt-2 p-2">
   @if ($followers->count() == 0)
      <div class="bg-secondary p-1 rounded-2xl">
         <p class="text-secondary-grey text-center">No Followers xD, so sed :(</p>
      </div>
   @endif
   @foreach ($followers as $follower)
      <div class="bg-secondary-2 p-1 rounded-2xl mb-2 flex">
         <div class="rounded-full bg-purpink w-6 h-6"></div>
         <a class="ml-2"
            href="/{{ $follower->whoami_username }}/status">{{ $follower->whoami_username }}</a>
      </div>
   @endforeach
</div>
