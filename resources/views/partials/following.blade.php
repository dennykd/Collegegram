<div class="bg-secondary rounded-2xl mt-2 p-2">
   @if ($following->count() == 0)
      <div class="bg-secondary p-1 rounded-2xl">
         <p class="text-secondary-grey text-center">No Following xD, so fun :)</p>
      </div>
   @endif
   @foreach ($following as $follow)
      <div class="bg-secondary-2 p-1 rounded-2xl mb-2 flex">
         <div class="rounded-full bg-purpink w-6 h-6"></div>
         <a class="ml-2"
            href="/{{ $follow->followed_username }}/status">{{ $follow->followed_username }}</a>
      </div>
   @endforeach
</div>
