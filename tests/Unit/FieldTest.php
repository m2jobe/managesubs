<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Models\Subscriber;
use App\Models\Field;

class FieldTest extends TestCase
{
    /** @var \App\User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function authenticate()
    {
        $this->postJson('/api/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ])
        ->assertSuccessful()
        ->assertJsonStructure(['token', 'expires_in'])
        ->assertJson(['token_type' => 'bearer']);
    }

    /** @test */
    public function canCreateNewField()
    {

        $subscriber = factory(Subscriber::class)->create();

        $this->actingAs($this->user)->postJson('/api/fields', [
            'subscriber_id' => $subscriber->id,
            'title' => 'test',
            'type' => 'number'
        ])
        ->assertSuccessful()
        ->assertJsonStructure(['title', 'type']);
    }

    /** @test */
    public function canUpdateExistingField()
    {
        $testTitle = 'test';
        $testType = 'number';
        $subscriber = factory(Subscriber::class)->create();
        $field = factory(Field::class)->create(['subscriber_id' => $subscriber->id]);

        $this->actingAs($this->user)->putJson('/api/fields/'.$field->id, [
            'subscriber_id' => $subscriber->id,
            'title' => $testTitle,
            'type' => $testType
        ])
        ->assertSuccessful()
        ->assertJsonStructure(['title', 'type']);

        $this->assertDatabaseHas('fields', [
            'title' => $testTitle,
            'type' => $testType,
            'id' => $field->id
        ]);
    }
}
