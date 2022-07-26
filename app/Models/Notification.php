<?php

namespace App\Models;

use App\Events\NotifEvent;
use function PHPUnit\Framework\isFalse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user', 'post'];

    public static function notifMessage($type, $author)
    {
        switch ($type) {
            case 'like':
                return $author . ' liked your post';
            case 'comment':
                return $author . ' commented on your post';
            case 'follow':
                return $author . ' followed you';
            case 'mention':
                return $author . ' mentioned you in a post';
            case 'reply':
                return $author . ' replied to your comment';
        }
    }

    public static function preventTwice($type, $from_user, $to_user_id, $post_id, $isMenfess = false)
    {
        $whoami = ($isMenfess == false) ? $from_user->username : 'Someone';
        if (!Notification::where('to_user_id', $to_user_id)->where('from_user_id', $from_user->id)->where('type', $type)->where('post_id', $post_id)->exists() && $from_user->id != $to_user_id) {
            $value = Notification::create([
                'to_user_id' => $to_user_id,
                'from_user_id' => $from_user->id,
                'from_username' => $whoami,
                'post_id' => $post_id,
                'type' => $type
            ]);
            $value = Notification::find($value->id);
            NotifEvent::dispatch($value);
            return true;
        }
        return  false;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
