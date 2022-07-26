<div class="bg-secondary pb-10 rounded-2xl">
   <div class="w-full relative flex flex-col mb-10">
      <div class="h-32 bg-gradient-to-r from-sky-500 to-indigo-500"></div>
      @if (Route::is($author->name . '/status*'))
         <img src="{{ asset('img/profile_user/' . $author->avatar) }}" alt="{{ $author->name }}"
            class="rounded-full w-[20%] absolute left-1/2 -translate-x-1/2 top-3/4 -translate-y-1/3 sm:-translate-y-3/4 sm:w-[10%] md:w-[20%] md:-translate-y-0">
      @else
         <img src="{{ asset('img/profile_user/' . $author->avatar) }}" alt="{{ $author->name }}"
            class="rounded-full w-[20%] absolute left-1/2 -translate-x-1/2 top-3/4 -translate-y-1/3 sm:-translate-y-3/4 sm:w-[10%] md:w-[25%]">
      @endif
   </div>
   <div class="text-center" id="name-space-parent">
      <p id="name-space" class="capitalize ">{{ $author->name }} <button
            class="text-xs text-slate-500 hover:text-slate-50" onclick="toggleEditName()">Edit</button></p>
      <script>
         function toggleEditName() {
            $('#name-space').toggleClass('hidden');
            $('#name-space-parent').prepend(`
                <form action="{{ route('user.update') }}" method="post">
                    @csrf
                    <input type="text" class="input-primary @error('email') ring-pink-500 @enderror" name="name" value="{{ $author->name }}"><br>
                    <button type="submit" class="btn-primary group">
                        <span class="btn-primary__text">save</span>
                    </button>
                </form>
            `);

         }
      </script>
      <small class="text-secondary-grey">
         <span>@</span>
         <span>{{ $author->username }}</span>
      </small>
      <div class="flex justify-center">
         <div class="w-1/3">
            <p class="text-xs text-secondary-grey flex flex-col">
               <span class="text-3xl text-primary-white font-semibold">{{ $author->following->count() }}</span>
               <span>Following</span>
            </p>
         </div>
         @if (Route::is('user.status') && $author->id !== auth()->user()->id)
            <div class="w-1/3 self-center">
               <button
                  class="btn-secondary {{ auth()->user()->isFollow(auth()->user()->id, $author->id)? 'bg-purpink text-primary-white': null }}"
                  id="btn-follow-{{ $author->id }}" onclick="follow({{ $author->id }})">
                  {{ auth()->user()->isFollow(auth()->user()->id, $author->id)? 'Unfollow': 'Follow' }}
               </button>
               {{-- @if (App\Models\Follow::isFollow(auth()->user()->id, $author->id))
                  <form
                     action="{{ route('user.unfollow', [
                         'his_id' => $author->id,
                         'my_id' => auth()->user()->id,
                     ]) }}"
                     method="post">
                     @csrf
                     @method('POST')
                     <button class="btn-primary py-1">Unfollow</button>
                  </form>
               @else
                  <form
                     action="{{ route('user.follow', [
                         'his_id' => $author->id,
                         'my_id' => auth()->user()->id,
                     ]) }}"
                     method="post">
                     @csrf
                     @method('POST')
                     <button class="btn-secondary">Follow</button>
                  </form>
               @endif --}}

               {{-- <form
                  action="{{ route('user.follow', [
                      'his_id' => $author->id,
                      'my_id' => auth()->user()->id,
                  ]) }} "
                  method="POST">
                  @csrf
                  @method('POST')
                  <button
                     class="{{ auth()->user()->isFollow(auth()->user()->id, $author->id)? 'btn-primary py-1': 'btn-secondary' }}"
                     id="btn-follow">{{ auth()->user()->isFollow(auth()->user()->id, $author->id)? 'Unfollow': 'Follow' }}</button>
               </form> --}}

            </div>
         @endif
         <div class="w-1/3">
            <p class="text-xs text-secondary-grey flex flex-col">
               <span class="text-3xl text-primary-white font-semibold"
                  id="follower-count-{{ $author->id }}">{{ $author->follower->count() }}</span>
               <span>Followers</span>
            </p>
         </div>
      </div>
      <div class="flex justify-center mt-10 {{ Request::is('home') ? 'hidden' : null }}">
         <a href="/{{ $author->username }}/status"
            class="btn-secondary {{ Request::get('data') == null ? 'btn-secondary__active' : null }}">Post</a>
         <a href="?data=media"
            class="btn-secondary {{ Request::get('data') == 'media' ? 'btn-secondary__active' : null }}">Media</a>
         <a href="?data=following"
            class="btn-secondary {{ Request::get('data') == 'following' ? 'btn-secondary__active' : null }}">Following</a>
         <a href="?data=follower"
            class="btn-secondary {{ Request::get('data') == 'follower' ? 'btn-secondary__active' : null }}">Follower</a>
      </div>
   </div>
</div>
