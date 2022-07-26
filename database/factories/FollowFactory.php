<?php

namespace Database\Factories;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follow>
 */
class FollowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $data = $this->generatedFollows(User::all()->random()->id, User::all()->random()->id);
        return [
            'followed_user_id' => $data['followed_user_id'],
            'followed_username' => $data['followed_username'],
            'whoami_user_id' => $data['whoami_user_id'],
            'whoami_username' => $data['whoami_username'],

        ];
    }

    public function generatedFollows($followed_user_id, $user_id)
    {
        if ($followed_user_id === $user_id) {
            return $this->generatedFollows(User::all()->random()->id, User::all()->random()->id);
        }
        if (Follow::where('followed_user_id', $followed_user_id)->where('whoami_user_id', $user_id)->exists()) {
            return $this->generatedFollows(User::all()->random()->id, User::all()->random()->id);
        }
        return [
            'followed_user_id' => $followed_user_id,
            'followed_username' => User::find($followed_user_id)->username,
            'whoami_user_id' => $user_id,
            "whoami_username" => User::find($user_id)->username,
        ];
    }
}
