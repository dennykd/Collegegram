<?php

namespace Database\Factories;

use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id = $this->faker->numberBetween(1, PostCategory::all()->count());
        if ($id === 2) {
            $subject = $this->faker->sentence(1);
        } else {
            $subject = null;
        }
        return [
            'content' => $this->faker->text,
            'user_id' => $this->faker->numberBetween(1, User::all()->count()),
            'post_code' => Str::random(10),
            'post_category_id' => $id,
            'subject' => $subject
        ];
    }
}
