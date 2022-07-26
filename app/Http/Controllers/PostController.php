<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use App\Models\Comment;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
    public function userUpdate(Request $request)
    {
        $name = $request->name;
        User::where('id', auth()->user()->id)->first()->update(['name' => $name]);
        return back();
    }
    // FOR POSTING START
    public function all(User $author, Request $request)
    {
        $posts = Post::where('post_category_id', 1)->where('user_id', $author->id)->paginate(10);
        if ($request->ajax()) {
            $view = view('partials.fragment-post', ['posts' => $posts])->render();
            return response()->json(['html' => $view, 'data_count' => $posts->count()]);
        }
        return view('user.profile', [
            'title' => 'Post by ' . $author->name,
            'author' => $author,
            'posts' => $posts,
            'media' => $author->media()->latest()->get(),
            'followers' => $author->follower()->latest()->get(),
            'following' => $author->following()->latest()->get(),
            // 'notifs' => Notification::where('to_user_id', auth()->user()->id)->latest()->get(),
        ]);
    }
    public function show(User $author, Post $posts, Request $request)
    {
        // return dump($posts->comments);
        if ($request->ajax()) {
            $data = Comment::where('commentable_id', $request->post_id)->where('parent_id', null)->latest()->get();
            $view = view('partials.comments', [
                'comments' => $data,
                'post_id' => $request->post_id,
                'is_menfess' => $request->is_menfess,
            ])->render();
            return response()->json(['html' => $view, 'comment_count' => $data->count()]);
        }
        return view('user.post', [
            'title' => 'Post by @' . $author->username,
            'post' => $posts,
            'author' => $author,
            // 'posts' => Post::latest()->get(),
            // 'notifs' => Notification::where('to_user_id', auth()->user()->id)->latest()->get(),
        ]);
    }

    public function allFess(Request $request)
    {
        $posts = Post::where('post_category_id', 2)->latest()->paginate(15);
        if ($request->ajax()) {
            $view = view('partials.fragment-post', ['posts' => $posts])->render();
            return response()->json(['html' => $view, 'data_count' => $posts->count()]);
        }
        return view('user.home', [
            'title' => "MenFess",
            'posts' => $posts,
            // 'notifs' => Notification::where('to_user_id', auth()->user()->id)->latest()->get(),
        ]);
    }

    public function getUpdate(Request $request)
    {
        $post = Post::where('post_category_id', $request->category_id)->latest()->take(4)->get();
        $view_name = $request->category_id == 1 ? 'partials.update-post' : 'partials.update-fess';
        $data =  view($view_name, [
            'posts' => $post,
        ])->render();

        return response()->json(['success' => true, 'html' => $data]);
    }

    public function showFess(User $author, Post $posts)
    {
        return view('user.post', [
            'title' => 'Discussion',
            // 'posts' => Post::latest()->get(),
            'post' => $posts,
            'author' => $author,
            // 'comments' => Comment::where('commentable_id', $posts->id)->latest()->get(),
            // 'likes' => Like::where('post_id', $posts->id)->get(),
            // 'notifs' => Notification::where('to_user_id', auth()->user()->id)->latest()->get(),
        ]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'post_category_id' => 'required',
            'user_id' => 'required',
            'content' => 'required',
            'subject' => 'max:255|min:1'
        ]);

        $validatedData['post_code'] = Str::random(10);
        // $validatedData['content'] = $request['post-trixFields']['content'];
        Post::create($validatedData);
        if ($validatedData['post_category_id'] == 1) {
            return redirect()->route('home')->with('success', 'Post created successfully');
        } else {
            return redirect()->route('menfess')->with('success', 'Post created successfully');
        }
    }

    public function destroy(Request $request)
    {
        return $request;
    }

    public function like(Request $request)
    {
        $isAjax = $request->isAjax ?? false;
        $validatedData = $request->validate([
            'post_id' => 'required',
            'user_id' => 'required',
            'notif_trigger_user_id' => 'required'
        ]);
        $data = Like::where('post_id', $validatedData['post_id'])->where('user_id', $validatedData['user_id']);
        if ($data->exists()) {
            $data->delete();
            if ($isAjax) {
                return response()->json([
                    'data' => [
                        'like' => false,
                        'message' => 'Post unliked successfully',
                        // 'post_id' => $validatedData['post_id'],
                        // 'user_id' => $validatedData['user_id'],
                        'like_count' => Like::where('post_id', $validatedData['post_id'])->count(),
                        'post_id' => $validatedData['post_id']
                    ],
                ]);
            } else {
                return redirect()->back()->with('success', 'Post unliked successfully');
            }
        } else {
            $like = new Like;
            $like->post_id = $validatedData['post_id'];
            $like->author()->associate(auth()->user());
            $like->save();
            Notification::preventTwice('like', auth()->user(), $validatedData['notif_trigger_user_id'], $validatedData['post_id'], $request->is_menfess);
            if ($isAjax) {
                return response()->json([
                    'data' => [
                        'like' => true,
                        'message' => 'Post like successfully',
                        // 'post_id' => $validatedData['post_id'],
                        // 'user_id' => $validatedData['user_id'],
                        'like_count' => Like::where('post_id', $validatedData['post_id'])->count(),
                        'post_id' => $validatedData['post_id']
                    ],
                ]);
            } else {
                return redirect()->back()->with('success', 'You liked this post');
            }
        }
    }

    public function comment(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required',
            'user_id' => 'required',
            'content' => 'required',
            'notif_trigger_user_id' => 'required'
        ]);

        $comment = new Comment;
        $comment->content = $validatedData['content'];
        $comment->author()->associate(auth()->user());

        $post = Post::find($validatedData['post_id']);
        $post->comments()->save($comment);

        $newComment = $post->comments->where('user_id', auth()->user()->id)->last();
        Notification::preventTwice('comment', auth()->user(), $validatedData['notif_trigger_user_id'], $validatedData['post_id'], $request->is_menfess);
        return response()->json(['html' => view('partials.fragment-comment', [
            'comment' => $newComment,
            'post_id' => $request->post_id,
            'is_menfess' => $request->is_menfess,
        ])->render(), 'comment_count' => $post->comments->count()]);
    }

    public function reply(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required',
            'parent_id' => 'required',
            'reply' => 'required',
            'notif_trigger_user_id' => 'required'
        ]);

        $reply_data = new Comment;
        $reply_data->content = $validatedData['reply'];
        $reply_data->author()->associate(auth()->user());
        $reply_data->parent_id = $validatedData['parent_id'];
        // $reply_data->commentable_id = $validatedData['post_id'];

        $post = Post::find($validatedData['post_id']);
        $post->comments()->save($reply_data);

        $comment = Comment::find($validatedData['parent_id']);

        $newReply = $comment->replies->where('user_id', auth()->user()->id)->last();
        $myReply = $comment->replies->where('id', $request->current_comment)->first();
        $current_comment_id = is_null($myReply) ? $comment->id : $myReply->id;
        Notification::preventTwice('reply', auth()->user(), $validatedData['notif_trigger_user_id'], $validatedData['post_id'], $request->is_menfess);
        return response()->json([
            'html' => view('partials.fragment-reply', [
                'reply' => $newReply,
                'post_id' => $request->post_id,
                'comment' => $post->comments->where('id', $validatedData['parent_id'])->first(),
                'is_menfess' => $request->is_menfess,
            ])->render(),
            'parent_id' => $comment->id,
            'current_comment' => $current_comment_id
        ]);

        // return redirect()->back()->with('success', 'Reply created successfully');
    }

    // FOR POSTING END

    public function unshow_notif(Request $request)
    {
        $notif = Notification::find($request->notif_id);
        $notif->show = false;
        $notif->save();
        return redirect()->back();
    }

    public function follow(Request $request)
    {
        $request->has('_token') ? back() : null;
        $isAjax = $request->isAjax ?? false;
        $validatedData = $request->validate([
            'his_id' => 'required',
        ]);
        $data = Follow::where('whoami_user_id', auth()->user()->id)->where('followed_user_id', $validatedData['his_id']);

        if ($data->exists()) {
            $data->delete();
            if ($isAjax) {
                return response()->json([
                    'follow' => false,
                    'message' => 'You unfollowed this user',
                    'follower_count' => Follow::where('followed_user_id', $validatedData['his_id'])->count(),
                    'followed_user_id' => $validatedData['his_id']
                ]);
            }
        } else {
            $follow = new Follow();

            $follow->followed_user_id = $validatedData['his_id'];
            $follow->followed_username = User::find($validatedData['his_id'])->username;
            $follow->whoami_user_id = auth()->user()->id;
            $follow->whoami_username = auth()->user()->username;
            $follow->save();

            Notification::preventTwice('follow', auth()->user(), $validatedData['his_id'], null, false);
            if ($isAjax) {
                return response()->json([
                    'follow' => true,
                    'message' => 'You followed this user',
                    'follower_count' => Follow::where('followed_user_id', $validatedData['his_id'])->count(),
                    'followed_user_id' => $validatedData['his_id']
                ]);
            }
        }

        return back();
    }
    public function unfollow(Request $request)
    {
        $validatedData = $request->validate([
            'his_id' => 'required',
        ]);

        $follow = new Follow();
        $follow = $follow->where('followed_user_id', $validatedData['his_id'])->where('whoami_user_id', auth()->user()->id);
        $follow->delete();

        return back();
    }
}
