@extends('layouts.main')

@section('content')
   <div>
      {{-- <div>{{ session('success') }}</div> --}}
      <div>
         <div class="relative bg-secondary m-2 p-2 pb-8 block rounded-2xl">
            <div class="abosolute flex items-center p-4 z-10">
               <img src="{{ asset('img/profile_user/' . $post->author->avatar) }}"
                  alt="{{ Route::is('menfess*')? auth()->user()->disguise($post->author->username): $post->author->username }}"
                  class="w-10 block rounded-full mr-4 shadow-sm">
               <div>
                  <p class="flex items-start">
                     <span class="mr-2">
                        {{ Request::is('menfess*')? auth()->user()->disguise($post->author->username): $post->author->username }}
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
                  <div class="mb-2 text-xs font-inter">
                     <p>
                        {{ Request::is('menfess*') ? $post->subject : null }}
                     </p>
                     <p class="">
                        {!! $post->content !!}
                     </p>
                  </div>
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
                              id="is-menfess">
                           <input type="hidden" name="post_id" value="{{ $post->id }}" id="post_id">
                           <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="user_id">
                           <input type="hidden" name="notif_trigger_user_id" value="{{ $post->author->id }}"
                              id="notif_trigger_user_id">
                           {{-- <button class="z-10">
                                        <x:feather-heart
                                            class="w-6 {{ $post->isLike(auth()->user()->id, $post->id) ? 'bg-pink-600' : 'bg-secondary' }} rounded-full p-[2.5px]" />
                                    </button>
                                    <span
                                        class="bg-white text-primary -ml-2 rounded-r-full min-w-[2rem] text-right px-2">{{ $post->likes->count() >= 1000 ? $post->likes->count() / 1000 . 'k' : $post->likes->count() }}</span> --}}
                        </form>
                     </small>
                     <small class="flex items-center">
                        <span class="z-10">
                           <x:feather-message-square class="w-6 bg-secondary-grey rounded-full p-[2.5px]" />
                        </span>
                        <span class="bg-white text-primary -ml-2 rounded-r-full min-w-[2rem] text-right px-2"
                           id="comment-count">{{ $post->comments->count() >= 1000 ? $post->comments->count() / 1000 . 'k' : $post->comments->count() }}</span>
                     </small>
                     {{-- @if (Request::is('menfess*'))
                        <small>By {{ $post->author->disguise($post->author->name) }}</small>
                     @endif --}}
                  </div>
                  <div>
                     @method('POST')
                     {{-- <input type="hidden" name="post_id" value="{{ $post->id }}"> --}}
                     {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
                     {{-- <input type="hidden" name="notif_trigger_user_id" value="{{ $post->author->id }}"> --}}
                     <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf_token">
                     <input type="hidden" name="is_menfess" value="{{ Request::is('menfess*') ? true : false }}"
                        id="is-menfess">
                     <input id="comment" type="text" name="content" placeholder="Comment"
                        class="block bg-secondary-2 border-none rounded-xl mt-3 p-3 pr-6 w-full overflow-x-auto text-xs"
                        value="{{ old('content') }}">

                     {{-- <button type="submit" class="flex flex-row-reverse items-center" id="submit-btn">
                        <x:feather-send class="rotate-45 w-4" />
                        <small class="mt-1">Comment</small>
                     </button> --}}
                  </div>
                  <button type="button" class="flex flex-row-reverse items-center"
                     onclick="doComment({{ auth()->user()->id }}, {{ $post->author->id }}, {{ $post->id }})">
                     <x:feather-send class="rotate-45 w-4" />
                     <small class="mt-1" id="submit-comment">Comment</small>
                  </button>
               </div>
            </div>
         </div>
      </div>
      <div class="p-2">
         <h2 class="font-semibold">Replies..</h2>
         {{-- @include('partials.comments') --}}
         <div class="relative">
            <img src="{{ asset('img/loader.gif') }}" class="absolute  block w-20 left-1/2 -translate-x-1/2" alt="loading"
               id="loading-comments">
         </div>
         <div id="comment-section">
            {{-- COMMENT WILL APPEND HERE --}}
         </div>
         <script>
            getComments({{ $post->id }}, {{ Request::is('menfess*') ? true : false }});
         </script>
      </div>
   </div>
@endsection

{{-- @section('notifications')
   @include('notifications', ['notifs' => $notifs])
@endsection --}}

@section('sidebar-row-2')
   <div class="mb-2" id="update-post-area">
      {{-- @include('partials.update-post', [
       'posts' => $posts->where('post_category_id', 1)->take(4),
   ]) --}}
      <img src="{{ asset('img/loader.gif') }}" alt="loading" id="loader-wrapper-post">
      <script>
         getUpdate(1, 'post');
      </script>
   </div>
@endsection
@section('sidebar-row-1')
   <div id="update-fess-area">
      {{-- @include('partials.update-fess', [
        'posts' => $posts->where('post_category_id', 2)->take(4),
        ]) --}}
      <img src="{{ asset('img/loader.gif') }}" alt="loading" id="loader-wrapper-fess">
      <script>
         getUpdate(2, 'fess');
      </script>
   </div>
@endsection
