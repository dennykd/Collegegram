<div class="bg-secondary my-2 rounded-2xl" id="comment-area">
   <div>
      <div class="abosolute flex items-center p-4 z-10">
         <img src="{{ asset('img/profile_user/' . $comment->author->avatar) }}" alt="{{ $comment->author->username }}"
            class="w-10 block rounded-full mr-4 shadow-sm">
         <div>
            <p class="flex items-start">
               <span class="mr-2">
                  {{ $is_menfess ? $comment->author->disguise($comment->author->username) : $comment->author->name }}
               </span>
               <a href="/{{ $comment->author->username }}/status"
                  class="text-secondary-grey text-xs {{ $is_menfess ? 'hidden' : null }}">
                  <span>@</span>{{ $is_menfess ? $comment->author->disguise($comment->author->username) : $comment->author->username }}
               </a>
            </p>
            <p class="text-xs text-secondary-grey">{{ $comment->created_at->diffForhumans() }}</p>
         </div>
      </div>
   </div>
   <div class="ml-[4.5rem] text-justify mr-10">
      <small class="text-[10px !important]">{!! $comment->content !!}</small>

      <div class="pb-2">
         <form>
            {{-- @dd($comment) --}}
            @method('POST')
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf_token">
            <input type="hidden" name="is_menfess" id="is-menfess"
               value="{{ Request::is('menfess*') ? true : false }}">
            <input type="hidden" name="post_id" value="{{ $post_id }}">
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <input type="hidden" name="notif_trigger_user_id" value="{{ $comment->author->id }}">
            <input type="text" id="reply-{{ $comment->id }}" name="reply" placeholder="Reply this comment"
               value="{{ old('reply') }}"
               class="block bg-slate-700 border-none rounded-xl my-3 p-3 pr-6 w-full overflow-x-auto text-xs">

            {{-- <trix-editor input="reply"
            class="block bg-secondary-2 border-none rounded-xl my-3 pr-6 w-full overflow-x-auto text-xs">
         </trix-editor> --}}
         </form>
         <button type="submit" class="flex flex-row-reverse items-center"
            onclick="doReply({{ auth()->user()->id }}, {{ $comment->author->id }}, {{ $post_id }}, {{ $comment->id }}, {{ $comment->id }})">
            <x:feather-send class="rotate-45 w-4" />
            <small class="mt-1" id="submit-reply-{{ $comment->id }}">Reply</small>
         </button>
      </div>

      @include('partials.reply', [
          'replies' => $comment->replies()->get(),
          'comment' => $comment,
          'post_id' => $post_id,
      ])
   </div>
