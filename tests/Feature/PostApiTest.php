<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

it('user can create post', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test-token')->plainTextToken;

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->postJson('/api/posts', [
        'title' => 'Test Post',
        'content' => 'This is a test post content',
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'title' => 'Test Post',
            'content' => 'This is a test post content',
        ]);
});

it('usuário autenticado pode listar posts', function () {
    $user = \App\Models\User::factory()->create();
    $token = $user->createToken('api-token')->plainTextToken;
    \App\Models\Post::factory()->count(3)->create(['user_id' => $user->id]);

    $response = $this->withHeader('Authorization', 'Bearer ' . $token)
        ->getJson('/api/posts');

    $response->assertOk();
    $response->assertJsonStructure([
        '*' => ['id', 'title', 'content', 'user_id', 'created_at', 'updated_at']
    ]);
});
