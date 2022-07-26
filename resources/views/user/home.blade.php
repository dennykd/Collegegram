@extends('layouts.main')
@section('content')
   <div id="scrolled-content">
      <div class="rounded-2xl overflow-hidden">
         @include('partials.posting')
      </div>
      <div id="post-parent">
         @include('partials.fragment-post')
      </div>
      <div class="relative">
         <img src="{{ asset('img/loader.gif') }}" class="absolute  block w-20 left-1/2 -translate-x-1/2" alt="loading"
            id="loading-paginate">
      </div>
   </div>
@endsection

{{-- @section('notifications')
   @include('notifications', ['notifs' => $notifs])
   <div class="hidden md:block">
   </div>
@endsection --}}


@section('sidebar-row-1')
   <div class="hidden md:block">
      @includeWhen(!Route::is('menfess'), 'partials.profile', ['author' => auth()->user()])
   </div>
@endsection

@section('sidebar-row-2')
   <div class="hidden md:block" id="update-post-area">
      <img src="{{ asset('img/loader.gif') }}" alt="loading" id="loader-wrapper-update">
      @if (Route::is('menfess*'))
         <script>
            getUpdate(1, 'update', 'post');
         </script>
      @else
         {{-- @include('partials.update-fess', [
             'posts' => $posts->where('post_category_id', 2)->take(4),
         ]) --}}
         <script>
            getUpdate(2, 'update',
               'post');
         </script>
      @endif
   </div>
@endsection
