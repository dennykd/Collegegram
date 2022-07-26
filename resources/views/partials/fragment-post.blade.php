@foreach ($posts as $post)
   <div class="relative bg-secondary my-2 p-2 pb-8 block rounded-2xl">
      <div class="abosolute flex items-center p-4 z-10">
         <img src="{{ asset('img/profile_user/' . $post->author->avatar) }}" alt="{{ $post->author->username }}"
            class="w-10 block rounded-full mr-4 shadow-sm">
         <div>
            <p class="flex items-start">
               <span class="mr-2">
                  {{ Request::is('menfess*') ? $post->author->disguise($post->author->username) : $post->author->name }}
               </span>
               <a href="/{{ $post->author->username }}/status"
                  class="text-secondary-grey text-xs {{ Route::is('menfess*') ? 'hidden' : null }}">
                  <span>@</span>{{ $post->author->username }}
               </a>
            </p>
            <p class="text-xs text-secondary-grey">{{ $post->created_at->diffForhumans() }}</p>
         </div>
      </div>
      <div>
         <div class="ml-[4.5rem] text-justify mr-10">
            <a class="block mb-2 text-xs font-inter"
               href="/{{ Request::is('menfess*') ? 'menfess/' . $post->post_code : $post->author->username . '/status/' . $post->post_code }}">
               <p>
                  {{ Request::is('menfess*') ? $post->subject : null }}
               </p>
               <p class="font-poppins">
                  {{ strip_tags(\Illuminate\Support\Str::words($post->content, 20, '...')) }}
               </p>
            </a>
            <div class="mt-4 flex justify-end">
               <small class="mr-4 flex items-center">
                  <button class="z-10">
                     <x:feather-heart
                        class="w-6 bg-secondary {{ $post->isLike(auth()->user()->id, $post->id) ? 'bg-pink-600' : null }} rounded-full p-[2.5px]"
                        id="like-icon-{{ $post->id }}" onclick="like({{ $post->id }})" />
                  </button>
                  <span class="bg-white text-primary -ml-2 rounded-r-full min-w-[2rem] text-right px-2"
                     id="like-count-{{ $post->id }}">{{ $post->likes->count() >= 1000 ? round($post->likes->count() / 1000, 1) . 'k' : $post->likes->count() }}</span>
                  <form action="/like" method="post" class="flex items-center">
                     @csrf
                     @method('POST')
                     <input type="hidden" name="is_menfess" value="{{ Request::is('menfess*') ? true : false }}"
                        id="menfess_id">
                     <input type="hidden" name="post_id" value="{{ $post->id }}" id="post_id">
                     <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                     <input type="hidden" name="notif_trigger_user_id" value="{{ $post->author->id }}"
                        id="notif_trigger_user_id">
                     {{-- <button class="z-10">
                     <x:feather-heart
                        class="w-6 {{ $post->isLike(auth()->user()->id, $post->id) ? 'bg-pink-600' : 'bg-secondary' }} rounded-full p-[2.5px]"
                        id="like-icon" />
                  </button>
                  <span class="bg-white text-primary -ml-2 rounded-r-full min-w-[2rem] text-right px-2"
                     id="like-count">{{ $post->likes->count() >= 1000 ? $post->likes->count() / 1000 . 'k' : $post->likes->count() }}</span> --}}
                  </form>
               </small>
               <small class="flex items-center">
                  <span class="z-10">
                     <x:feather-message-square class="w-6 bg-secondary-grey rounded-full p-[2.5px]" />
                  </span>
                  <span
                     class="bg-white text-primary -ml-2 rounded-r-full min-w-[2rem] text-right px-2">{{ $post->comments->count() >= 1000 ? $post->comments->count() / 1000 . 'k' : $post->comments->count() }}</span>
               </small>
               {{-- @if (Request::is('menfess*'))
               <small>By {{ $post->author->disguise($post->author->name) }}</small>
            @endif --}}
            </div>
         </div>
      </div>
   </div>
@endforeach
