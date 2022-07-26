<div class="pb-2">
   <form>
      {{-- @dd($comment) --}}
      @method('POST')
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf_token">
      <input type="hidden" name="is_menfess" id="is-menfess" value="{{ Request::is('menfess*') ? true : false }}">
      <input type="hidden" name="post_id" value="{{ $post_id }}">
      <input type="hidden" name="parent_id" value="{{ $comment->id }}">
      <input type="hidden" name="notif_trigger_user_id" value="{{ $comment->author->id }}">
      <input type="text" id="reply-{{ $reply->id }}" name="reply" placeholder="Reply this comment"
         value="{{ old('reply') }}"
         class="block bg-slate-700 border-none rounded-xl my-3 p-3 pr-6 w-full overflow-x-auto text-xs">

      {{-- <trix-editor input="reply"
            class="block bg-secondary-2 border-none rounded-xl my-3 pr-6 w-full overflow-x-auto text-xs">
         </trix-editor> --}}
   </form>
   <button type="submit" class="flex flex-row-reverse items-center"
      onclick="doReply({{ auth()->user()->id }}, {{ $comment->author->id }}, {{ $post_id }}, {{ $comment->id }},{{ $reply->id }})">
      <x:feather-send class="rotate-45 w-4" />
      <small class="mt-1" id="submit-reply-{{ $reply->id }}">Reply</small>
   </button>
</div>
