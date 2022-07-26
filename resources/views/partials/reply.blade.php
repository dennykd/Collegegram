<div id="reply-section-{{ $comment->id }}">
   @foreach ($replies as $reply)
      @include('partials.fragment-reply')
   @endforeach
</div>
