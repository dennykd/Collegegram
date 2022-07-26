<div
   class="z-50 fixed bottom-[70px] w-[80vw] right-5 p-2 h-80 rounded-2xl bg-secondary translate-x-[200%] md:translate-x-[0%] transition-all md:static md:w-full"
   id="notif">
   <h3 class="font-semibold">Notifications.</h3>
   <div id="notif-area" class="overflow-y-auto no-scrollbar">
      @foreach ($notifs->where('show', true)->take(6) as $notif)
         <div class="bg-secondary-2 py-2 px-3 text-xs rounded-xl relative mb-2 flex justify-between items-start"
            id="notif-content-{{ $notif->id }}">
            <span>{{ $notif->notifMessage($notif->type, $notif->from_username) }}</span>

            <div>
               @if (Route::is('menfess*'))
                  @if ($notif->type == 'follow')
                     <a class="text-purpink font-medium rounded-full py-1 px-2 transition-all duration-150 hover:text-white hover:bg-purpink"
                        href="/{{ $notif->from_username }}/status">Details..</a>
                  @else
                     <a class="text-purpink font-medium rounded-full py-1 px-2 transition-all duration-150 hover:text-white hover:bg-purpink"
                        href="/menfess/{{ $notif->post->post_code }}">Details..</a>
                  @endif
               @else
                  @if ($notif->type == 'follow')
                     <a class="text-purpink font-medium rounded-full py-1 px-2 transition-all duration-150 hover:text-white hover:bg-purpink"
                        href="/{{ $notif->from_username }}/status">Details..</a>
                  @else
                     <a class="text-purpink font-medium rounded-full py-1 px-2 transition-all duration-150 hover:text-white hover:bg-purpink"
                        href="/{{ $notif->post->author->username }}/status/{{ $notif->post->post_code }}">Details..</a>
                  @endif
               @endif
               <button class="absolute right-0 top-1 group" onclick="removeNotif({{ $notif->id }})">
                  <x:feather-x class="w-6 text-purpink group-hover:scale-90 transition-all" />
               </button>
               {{-- <form action="{{ route('notif.unshow') }}" method="post">
                  @csrf
                  @method('POST')
                  <input type="hidden" name="notif_id" value="{{ $notif->id }}">
                  <button class="absolute right-0 top-1 group" onclick="removeNotif($notif->id)">
                     <x:feather-x class="w-6 text-purpink group-hover:scale-90 transition-all" />
                  </button>
               </form> --}}
            </div>
         </div>
      @endforeach
   </div>
   <div class="absolute bottom-3 left-3" id="notif-tool">
      <button class="italic font-semibold text-xs text-purpink"
         onClick="removeAllNotif()">{{ $notifs->where('show', true)->count() ? 'Remove all' : null }}</button>
   </div>
</div>
