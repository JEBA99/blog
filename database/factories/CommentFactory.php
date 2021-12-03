<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\database\factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * 
     */
    protected $model = Comment::class;
    public function definition()
    {
        return [
            'post_id' => POST::factory(),
            'body' => $this->faker->paragraph()
        ];
    }
}
