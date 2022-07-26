@extends('layouts.main')

@section('content')
   <div class="rounded-2xl overflow-hidden">
      @include('partials.profile', [
          'author' => $author,
          'followers' => $followers,
          'following' => $following,
      ])
   </div>
   <div class="">
      @switch(Request::get('data'))
         @case('media')
            <h2>Ini Media</h2>
         @break

         @case('follower')
            @include('partials.follower', ['followers' => $followers])
         @break

         @case('following')
            @include('partials.following', ['following' => $following])
         @break

         @default
            <div id="scrolled-content">
               <div id="post-parent">
                  @include('partials.fragment-post')
               </div>
            </div>
      @endswitch
      <div class="relative">
         <img src="{{ asset('img/loader.gif') }}" class="absolute  block w-20 left-1/2 -translate-x-1/2" alt="loading"
            id="loading-paginate">
      </div>
   </div>
@endsection

{{-- @section('notifications')
   @include('notifications')
@endsection --}}

@section('sidebar-row-2')
   <div class="hidden md:block" id="update-post-area">
      <img src="{{ asset('img/loader.gif') }}" alt="loading" id="loader-wrapper-post">
      <script>
         getUpdate(1, 'post', 'post');
      </script>
   </div>
   <span class="block mb-2"></span>
   <div class="hidden md:block" id="update-fess-area">
      <img src="{{ asset('img/loader.gif') }}" alt="loading" id="loader-wrapper-fess">
      <script>
         getUpdate(2, 'fess', 'fess');
      </script>
   </div>

   {{-- @include('partials.update-post', [
       'posts' => $posts->where('post_category_id', 1)->take(4),
   ])
   <div class="mb-2"></div>
   @include('partials.update-fess', [
       'posts' => $posts->where('post_category_id', 2)->take(4),
   ]) --}}
@endsection
