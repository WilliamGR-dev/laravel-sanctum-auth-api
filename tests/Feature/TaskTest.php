<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function createUser()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => Hash::make($this->faker->password(8)),
        ];

        return User::create($userData);
    }

    /// GET

    public function test_show_task_unauthorized()
    {
        $response = $this->getJson('/api/tasks/1');

        $response->assertStatus(401);
    }

    public function test_show_task_not_found()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $response = $this->actingAs($user)->getJson('/api/tasks/1');

        $response->assertStatus(404);
    }

    public function test_show_task_forbidden()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $task = Task::create([
            'user_id' => 9,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);


        $response = $this->actingAs($user)->getJson('/api/tasks/1');

        $response->assertStatus(403);
    }

    public function test_show_task_success()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $task = Task::create([
            'user_id' => 1,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $response = $this->actingAs($user)->getJson('/api/tasks/1');

        $response->assertStatus(200);
    }

    /// POST

    public function test_post_task_unauthorized()
    {
        $formData = [
            'body' => $this->faker->text(20),
            'completed' => false,
        ];

        $response = $this->postJson('/api/tasks/', $formData);

        $response->assertStatus(401);
    }

    public function test_post_task_no_input()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $response = $this->actingAs($user)->postJson('/api/tasks/');
        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors']);
    }

    public function test_post_task_invalid_input()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $formData = [
            'body' => $this->faker->text(20),
        ];

        $response = $this->actingAs($user)->postJson('/api/tasks/', $formData);
        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors']);
    }

    public function test_post_task_success()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $formData = [
            'body' => $this->faker->text(20),
            'completed' => false,
        ];

        $response = $this->actingAs($user)->getJson('/api/tasks/', $formData);

        $response->assertStatus(200);
    }

    /// PUT
    public function test_put_task_unauthorized_no_auth()
    {
        $formData = [
            'body' => $this->faker->text(20),
            'completed' => true,
        ];

        $task = Task::create([
            'user_id' => 1,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $response = $this->putJson('/api/tasks/1', $formData);

        $response->assertStatus(401);
    }

    public function test_put_task_unauthorized()
    {
        $formData = [
            'body' => $this->faker->text(20),
            'completed' => true,
        ];

        $task = Task::create([
            'user_id' => 8,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $response = $this->putJson('/api/tasks/1', $formData);

        $response->assertStatus(401);
    }

    public function test_put_task_not_found()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $formData = [
            'body' => $this->faker->text(20),
            'completed' => true,
        ];

        $task = Task::create([
            'user_id' => 1,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $response = $this->actingAs($user)->putJson('/api/tasks/9', $formData);

        $response->assertStatus(404);
    }

    public function test_put_task_no_input()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $task = Task::create([
            'user_id' => 1,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $formData = [];

        $response = $this->actingAs($user)->putJson('/api/tasks/1', $formData);
        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors']);
    }

    public function test_put_task_success()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $formData = [
            'body' => $this->faker->text(20),
            'completed' => true,
        ];

        $task = Task::create([
            'user_id' => 1,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $response = $this->actingAs($user)->putJson('/api/tasks/1', $formData);

        $response->assertStatus(200);
    }


    /// DELETE

    public function test_delete_task_unauthorized_no_auth()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $task = Task::create([
            'user_id' => 1,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $response = $this->deleteJson('/api/tasks/1');

        $response->assertStatus(401);
    }

    public function test_delete_task_unauthorized()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $task = Task::create([
            'user_id' => 8,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $response = $this->actingAs($user)->deleteJson('/api/tasks/1');

        $response->assertStatus(403);
    }

    public function test_delete_task_not_found()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $task = Task::create([
            'user_id' => 1,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $response = $this->actingAs($user)->deleteJson('/api/tasks/9');

        $response->assertStatus(404);
    }

    public function test_delete_task_success()
    {
        $user = $this->createUser();
        $token = $user->createToken('api')->plainTextToken;

        $task = Task::create([
            'user_id' => 1,
            'body' => $this->faker->text(20),
            'completed' => false,
        ]);

        $response = $this->actingAs($user)->deleteJson('/api/tasks/1');

        $response->assertStatus(204);
    }
}
