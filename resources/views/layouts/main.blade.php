<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{ $title }}</title>
   @include('partials.font')
   @trixassets
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="{{ asset('js/myscript.js') }}"></script>
</head>

<body class="font-poppins bg-primary text-primary-white">
   <div class="hidden md:block">
      <header class="z-30 fixed top-0 inset-x-0 bg-secondary h-[50px] flex justify-between">
         <a href="{{ route('home') }}" class="mt-3 md:mr-[8rem] lg:mr-[23rem] xl:mr-[40rem] 2xl:mr-[50rem]">
            <img src="{{ asset('img/CG.png') }}" alt="" class="w-10 inline text-purpink ml-4">
            <h6 class="text-purpink font-semibold inline ml-2"><span class="font-light">College</span> Gram</h6>
         </a>
         <a href="{{ route('home') }}" class="bg-secondary-2 rounded-full my-2 hover:bg-primary-white group">
            <div class="mx-5 mt-[5px]">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                  class="fill-purpink w-5 h-5 mb-1 inline">
                  <path
                     d="M11.4297 25.9776V22.1441C11.4296 21.1726 12.2196 20.3834 13.198 20.3773H16.7908C17.7736 20.3773 18.5703 21.1683 18.5703 22.1441V22.1441V25.9665C18.5703 26.8091 19.255 27.4939 20.1037 27.5H22.5548C23.6995 27.5029 24.7984 27.0535 25.609 26.2509C26.4195 25.4483 26.875 24.3584 26.875 23.2219V12.3323C26.875 11.4142 26.4651 10.5434 25.7558 9.95438L17.4287 3.34284C15.9731 2.1864 13.8942 2.22376 12.4817 3.43173L4.33377 9.95438C3.59093 10.526 3.14694 11.3995 3.125 12.3323V23.2108C3.125 25.5796 5.05923 27.5 7.44522 27.5H9.84036C10.249 27.5029 10.6419 27.3438 10.9318 27.058C11.2218 26.7722 11.3849 26.3833 11.3849 25.9776H11.4297Z" />
               </svg>
               <p class="inline text-[14px] text-primary-white font-semibold group-hover:text-primary">Home</p>
            </div>
         </a>
         <a href="{{ route('menfess') }}" class="bg-secondary-2 rounded-full my-2 hover:bg-primary-white group">
            <div class="px-3 mt-[5px]">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                  class="fill-purpink w-5 h-5 mb-1 inline">
                  <path
                     d="M22.3981 17.9001C22.0744 18.2139 21.9256 18.6676 21.9994 19.1126L23.1106 25.2626C23.2044 25.7839 22.9844 26.3114 22.5481 26.6126C22.1206 26.9251 21.5519 26.9626 21.0856 26.7126L15.5494 23.8251C15.3569 23.7226 15.1431 23.6676 14.9244 23.6614H14.5856C14.4681 23.6789 14.3531 23.7164 14.2481 23.7739L8.71061 26.6751C8.43686 26.8126 8.12686 26.8614 7.82311 26.8126C7.08311 26.6726 6.58936 25.9676 6.71061 25.2239L7.82311 19.0739C7.89686 18.6251 7.74811 18.1689 7.42436 17.8501L2.91061 13.4751C2.53311 13.1089 2.40186 12.5589 2.57436 12.0626C2.74186 11.5676 3.16936 11.2064 3.68561 11.1251L9.89811 10.2239C10.3706 10.1751 10.7856 9.88762 10.9981 9.46262L13.7356 3.85012C13.8006 3.72512 13.8844 3.61012 13.9856 3.51262L14.0981 3.42512C14.1569 3.36012 14.2244 3.30637 14.2994 3.26262L14.4356 3.21262L14.6481 3.12512H15.1744C15.6444 3.17387 16.0581 3.45512 16.2744 3.87512L19.0481 9.46262C19.2481 9.87137 19.6369 10.1551 20.0856 10.2239L26.2981 11.1251C26.8231 11.2001 27.2619 11.5626 27.4356 12.0626C27.5994 12.5639 27.4581 13.1139 27.0731 13.4751L22.3981 17.9001Z" />
               </svg>
               <p class="inline text-[14px] text-primary-white font-semibold group-hover:text-primary">Menfess</p>
            </div>
         </a>
         <form action="{{ route('logout') }}" class="z-50" method="post">
            @csrf
            @method('POST')
            <button>
               <x:feather-log-out class="text-primary-white w-6 h-6 mt-3" />
            </button>
         </form>
         <a href="{{ route('user.status', ['author' => auth()->user()]) }}"
            class="px-2 mr-5 pt-1 bg-secondary-2 rounded-full my-2 hover:bg-primary-white group">
            <img src="{{ asset('img/profile_user/' . auth()->user()->avatar) }}" alt=""
               class="inline fill-purpink w-7 h-7 mr-2 rounded-full">
            <p class="inline text-[14px] text-primary-white font-semibold group-hover:text-primary">
               {{ auth()->user()->username }}</p>
         </a>
      </header>
   </div>
   {{-- NAV MOBILE --}}
   <div class="z-50 fixed bg-secondary h-[50px] w-full md:hidden top-0 left-0">
      <header class="flex items-center justify-between relative">
         <div class="flex items-center px-4">
            <button class="block absolute mt-2 left-4" id="hamburger" name="hamburger" type="button">
               <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
               <span class="hamburger-line transition duration-300 ease-in-out"></span>
               <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
            </button>
         </div>
         <nav id="nav-menu"
            class="z-10 -translate-y-[200%] absolute py-2 px-2 bg-secondary h-[80vh] shadow-lg rounded-lg w-full top-full transition-all duration-300">
            <ul class="block">
               <li class="group text-center">
                  <a href="{{ route('home') }}" class="text-base hover:text-purpink">Home</a>
               </li>
               {{-- <li class="group">
                        <a href="{{ route('home') }}" class="text-base text hover:text-purpink">About</a>
                    </li> --}}
               {{-- <li class="group">
                        <a href="{{ route('home') }}" class="text-base text hover:text-purpink">Setting</a>
                    </li> --}}
               <li class="group text-center">
                  <form action="{{ route('logout') }}" class="z-50" method="post">
                     @csrf
                     @method('POST')
                     <button class="text-base hover:text-purpink">
                        Logout
                     </button>
                  </form>
               </li>
            </ul>
         </nav>
         <a href=""><img src="{{ asset('img/CG.png') }}" alt="" class="w-10 mt-2 text-purpink ml-4"></a>
         <a href="">
            <x:feather-search class="w-9 mt-2 text-purpink mr-4" />
         </a>
      </header>
   </div>
   <div class="grid grid-cols-1 gap-x-2 p-4 mt-14 md:grid-cols-[.75fr_1.5fr_.75fr]">
      <div class="hidden md:block">
         <div class="rounded-2xl overflow-hidden">
            @yield('sidebar-row-1')
         </div>
         <div class="my-2"></div>
         <div class="">
            @yield('sidebar-row-2')
         </div>
      </div>
      <div class="overflow-x-scroll no-scrollbar md:h-[86vh]" id="post-area">
         @yield('content')
      </div>
      <script>
         page = 1;
         $("#post-area").scroll(function() {
            // console.log($(this).scrollTop());;
            if ($(this).scrollTop() + $(this).height() > $("#scrolled-content").height()) {
               page++;
               loadMoreData(page);
            }
         })
      </script>
      <div class="" id="notif-here">
         <img src="{{ asset('img/loader.gif') }}" alt="loading" id="loader-wrapper-notif">
         {{-- @yield('notifications') --}}
         <script>
            getNotif('notif')
         </script>
      </div>
      {{-- MOBILE BOTTOM NAV --}}
      <div class="z-30 md:hidden">
         <nav class="fixed bottom-0 inset-x-0 bg-primary h-[50px] flex justify-between">
            <a href="{{ route('home') }}" class="">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                  class="fill-purpink w-9 h-9 mt-2 ml-5 hover:fill-darkpink hover:-translate-y-2 hover:ease-in-out duration-700">
                  <path
                     d="M11.4297 25.9776V22.1441C11.4296 21.1726 12.2196 20.3834 13.198 20.3773H16.7908C17.7736 20.3773 18.5703 21.1683 18.5703 22.1441V22.1441V25.9665C18.5703 26.8091 19.255 27.4939 20.1037 27.5H22.5548C23.6995 27.5029 24.7984 27.0535 25.609 26.2509C26.4195 25.4483 26.875 24.3584 26.875 23.2219V12.3323C26.875 11.4142 26.4651 10.5434 25.7558 9.95438L17.4287 3.34284C15.9731 2.1864 13.8942 2.22376 12.4817 3.43173L4.33377 9.95438C3.59093 10.526 3.14694 11.3995 3.125 12.3323V23.2108C3.125 25.5796 5.05923 27.5 7.44522 27.5H9.84036C10.249 27.5029 10.6419 27.3438 10.9318 27.058C11.2218 26.7722 11.3849 26.3833 11.3849 25.9776H11.4297Z" />
               </svg>
            </a>
            <a href="{{ route('menfess') }}" class="">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                  class="fill-purpink w-9 h-9 mt-2 ml-5 hover:fill-darkpink hover:-translate-y-2 hover:ease-in-out duration-700">
                  <path
                     d="M22.3981 17.9001C22.0744 18.2139 21.9256 18.6676 21.9994 19.1126L23.1106 25.2626C23.2044 25.7839 22.9844 26.3114 22.5481 26.6126C22.1206 26.9251 21.5519 26.9626 21.0856 26.7126L15.5494 23.8251C15.3569 23.7226 15.1431 23.6676 14.9244 23.6614H14.5856C14.4681 23.6789 14.3531 23.7164 14.2481 23.7739L8.71061 26.6751C8.43686 26.8126 8.12686 26.8614 7.82311 26.8126C7.08311 26.6726 6.58936 25.9676 6.71061 25.2239L7.82311 19.0739C7.89686 18.6251 7.74811 18.1689 7.42436 17.8501L2.91061 13.4751C2.53311 13.1089 2.40186 12.5589 2.57436 12.0626C2.74186 11.5676 3.16936 11.2064 3.68561 11.1251L9.89811 10.2239C10.3706 10.1751 10.7856 9.88762 10.9981 9.46262L13.7356 3.85012C13.8006 3.72512 13.8844 3.61012 13.9856 3.51262L14.0981 3.42512C14.1569 3.36012 14.2244 3.30637 14.2994 3.26262L14.4356 3.21262L14.6481 3.12512H15.1744C15.6444 3.17387 16.0581 3.45512 16.2744 3.87512L19.0481 9.46262C19.2481 9.87137 19.6369 10.1551 20.0856 10.2239L26.2981 11.1251C26.8231 11.2001 27.2619 11.5626 27.4356 12.0626C27.5994 12.5639 27.4581 13.1139 27.0731 13.4751L22.3981 17.9001Z" />
               </svg>
            </a>
            <button class="" id="notif-btn">
               <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                  class="fill-purpink w-9 h-9 mt-2 ml-5 hover:fill-darkpink hover:-translate-y-2 hover:ease-in-out duration-700">
                  <path
                     d="M5.60002 11.2C5.59926 9.45467 6.14215 7.75247 7.15326 6.32989C8.16437 4.90731 9.59348 3.835 11.242 3.26196C11.1782 2.862 11.2019 2.45294 11.3115 2.06302C11.4211 1.6731 11.6139 1.3116 11.8768 1.00345C12.1397 0.695309 12.4662 0.44786 12.834 0.278181C13.2018 0.108501 13.602 0.0206299 14.007 0.0206299C14.4121 0.0206299 14.8123 0.108501 15.18 0.278181C15.5478 0.44786 15.8744 0.695309 16.1373 1.00345C16.4001 1.3116 16.593 1.6731 16.7026 2.06302C16.8122 2.45294 16.8359 2.862 16.772 3.26196C18.418 3.83735 19.844 4.91066 20.8525 6.33304C21.861 7.75542 22.4018 9.45636 22.4 11.2V19.6L26.6 22.4V23.8H1.40002V22.4L5.60002 19.6V11.2ZM16.8 25.2C16.8 25.9426 16.505 26.6548 15.9799 27.1799C15.4548 27.705 14.7426 28 14 28C13.2574 28 12.5452 27.705 12.0201 27.1799C11.495 26.6548 11.2 25.9426 11.2 25.2H16.8Z" />
               </svg>
            </button>
            <a href="{{ route('user.status', ['author' => auth()->user()]) }}"><img
                  src="{{ asset('img/profile_user/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                  class="fill-purpink w-9 h-9 mt-2 mr-5 outline outline-purpink hover:fill-darkpink hover:-translate-y-2 hover:ease-in-out duration-700 rounded-full">></a>
         </nav>
      </div>
   </div>
   <script src="{{ asset('js/app.js') }}"></script>
   {{-- <script src="{{ asset('js/myscript.js') }}"></script> --}}
   <script>
      // FUNCTION START
      function like(id_post) {
         let menfess = $('#menfess_id').val();
         let user_id = $('#user_id').val();
         let notif_trigger_user_id = $('#notif_trigger_user_id').val();
         $.ajax({
            type: 'POST',
            url: "{{ url('like') }}",
            data: {
               _token: '{{ csrf_token() }}',
               is_menfess: menfess,
               user_id: user_id,
               post_id: id_post,
               notif_trigger_user_id: notif_trigger_user_id,
               isAjax: true
            },
            success: function(data) {
               $('#like-icon-' + data.data.post_id).toggleClass('bg-pink-600');
               let like_count = '';
               if (data.data.like_count > 1000) {
                  like_count = (data.data.like_count / 1000).toFixed(1) + 'k';
               } else {
                  like_count = data.data.like_count;
               }
               $('#like-count-' + data.data.post_id).text(like_count);
               //    console.log(data.data);
               // console.log($('#like-count-'+data.data.post_id).attr('id'));
            }
         });
      }

      function getNotifMessage(type, from_username, category = 1) {
         from_username = (category == 1) || category == null ? from_username : 'someone';
         switch (type) {
            case 'like':
               return from_username + ' liked your post';
            case 'comment':
               return from_username + ' commented on your post';
            case 'follow':
               return from_username + ' followed you';
            case 'mention':
               return from_username + ' mentioned you in a post';
            case 'reply':
               return from_username + ' replied to your comment';
         }
      }

      $(function() {
         // prevent the submit button to be pressed twice
         $("#submit-form").submit(function() {
            $(this).find('#submit-btn').attr('disabled', true);
            $(this).find('#submit-btn').text('Sending..').addClass('text-xs');
         });
      })

      function removeAllNotif() {
         $.ajax({
            type: 'POST',
            url: "{{ url('remove-notif/all') }}",
            data: {
               _token: '{{ csrf_token() }}',
               isAjax: true
            },
            success: function(data) {
               //    console.log(data);
               $('#notif-area').empty();
               $('#notif-tool').addClass('hidden');
            }
         });
      }

      function removeNotif(notif_id) {
         $.ajax({
            type: 'POST',
            url: "{{ url('remove-notif') }}",
            data: {
               _token: '{{ csrf_token() }}',
               notif_id: notif_id,
               isAjax: true
            },
            success: function(data) {
               //    console.log(data);
               $('#notif-content-' + notif_id).remove();
               if (count(data.notifs) == 0) {
                  $('#notif-tool').addClass('hidden');
               }
            }
         });
      }

      function follow(his_id) {
         $.ajax({
            type: 'POST',
            url: "{{ url('follow') }}",
            data: {
               _token: '{{ csrf_token() }}',
               his_id: his_id,
               isAjax: true
            },
            beforeSend: function() {
               $('#btn-follow-' + his_id).attr('disabled', true);
               $('#btn-follow-' + his_id).text('Loading..');
            },
            success: function(data) {
               //    console.log(data);
               $('#btn-follow-' + his_id).attr('disabled', false);
               if (data.follow == true) {
                  $('#btn-follow-' + his_id).text('Unfollow');
               } else {
                  $('#btn-follow-' + his_id).text('Follow');
               }
               //    $('#btn-follow-' + his_id).toggleClass('btn-primary');
               $('#btn-follow-' + his_id).toggleClass('bg-purpink').toggleClass('text-primary-white');
               $('#follower-count-' + his_id).text(data.follower_count);
            }
         })
      }

      //   FUNCTION END

      // DOM READY START
      // global
      const postArea = document.querySelector('#post-area');

      // Hamburger
      const hamburger = document.querySelector('#hamburger');
      const navMenu = document.querySelector('#nav-menu');

      hamburger.addEventListener('click', function() {
         hamburger.classList.toggle('hamburger-active');
         navMenu.classList.toggle('translate-y-[0%]');
         notif.classList.remove('translate-x-[0%]');
      });

      navMenu.addEventListener('click', function() {
         hamburger.classList.toggle('hamburger-active');
         navMenu.classList.toggle('translate-y-[0%]');
      });

      //   notif
      $("#notif").ready(function() {
         const notif = document.querySelector('#notif');
      });
      const notifBtn = document.querySelector('#notif-btn');

      notifBtn.addEventListener('click', function() {
         notif.classList.toggle('translate-x-[0%]');
         navMenu.classList.remove('translate-y-[0%]');
         hamburger.classList.remove('hamburger-active');
      });

      //   global deactivation
      postArea.addEventListener('click', function() {
         notif.classList.remove('translate-x-[0%]');
         navMenu.classList.remove('translate-y-[0%]');
         hamburger.classList.remove('hamburger-active');
      });
      // DOM READY END
      // <span>{{ App\Models\Notification::notifMessage('${m.type}', '${m.from_username}') }}</span>
      // CHANEL LISTENER BROADCAST START
      const Htpp = window.axios;
      const Echo = window.Echo;

      var channel = Echo.channel('notifs.' + '{{ auth()->user()->id }}');
      channel.listen('NotifEvent', function(data) {
         //  console.log(data);
         const m = data.message;
         $('#notif-tool').removeClass('hidden');
         $('#notif-area').prepend(`
            <div class="bg-secondary-2 py-2 px-3 text-xs rounded-xl relative mb-2 flex justify-between items-start">
                <span>${getNotifMessage(m.type, m.from_username, (m.post == null) ? 1 : m.post.post_category_id)}</span>

            <div>
               @if (Route::is('menfess*'))
                  @if ('${m.type}' == 'follow')
                     <a class="text-purpink font-medium rounded-full py-1 px-2 transition-all duration-150 hover:text-white hover:bg-purpink"
                        href="/${m.from_username}/status">Details..</a>
                  @else
                     <a class="text-purpink font-medium rounded-full py-1 px-2 transition-all duration-150 hover:text-white hover:bg-purpink"
                        href="/menfess/${m.post == null ? 'test' : m.post.post_code}">Details..</a>
                  @endif
               @else
                  @if ('${m.type}' == 'follow')
                     <a class="text-purpink font-medium rounded-full py-1 px-2 transition-all duration-150 hover:text-white hover:bg-purpink"
                        href="/${m.from_username}/status">Details..</a>
                  @else
                     <a class="text-purpink font-medium rounded-full py-1 px-2 transition-all duration-150 hover:text-white hover:bg-purpink"
                        href="/${m.user.username}/status/${m.post == null ? 'test' : m.post.post_code}">Details..</a>
                  @endif
               @endif
               <form action="{{ route('notif.unshow') }}" method="post">
                  @csrf
                  @method('POST')
                  <input type="hidden" name="notif_id" value="${m.id}">
                  <button class="absolute right-0 top-1 group">
                     <x:feather-x class="w-6 text-purpink group-hover:scale-90 transition-all" />
                  </button>
               </form>
            </div>
         </div>
         `);
      });
      // CHANEL LISTENER BROADCAST END
   </script>
</body>

</html>
