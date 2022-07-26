<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $post_id = Post::all()->random()->id;
        $user_id = User::all()->random()->id;

        if (Like::all()->count() == 0) {
            return [
                'post_id' => $post_id,
                'user_id' => $user_id,
            ];
        } else {
            $this->generateLike($post_id, $user_id);
        }
    }

    public function generateLike($post_id, $user_id)
    {
        if (!Like::where('post_id', $post_id)->where('user_id', $user_id)->exists()) {
            return [
                'post_id' => $post_id,
                'user_id' => $user_id,
            ];
        }

        return $this->definition(Post::all()->random()->id, User::all()->random()->id);
    }
}
