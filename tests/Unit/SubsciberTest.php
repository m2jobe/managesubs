<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Models\Subscriber;
use App\Models\Field;

class SubscrberTest extends TestCase
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

        $this->actingAs($this->user)->postJson('/api/subscribers/', [
            'name' => 'MJ Lamin',
            'email' => 'thejobemuhammed@gmail.com',
            'state' => 'active'
        ])
        ->assertSuccessful()
        ->assertJsonStructure(['name', 'email', 'state']);
    }

    /** @test */
    public function canGetFields()
    {
        $subscriber = factory(Subscriber::class)->create();
        factory(Field::class)->create(['subscriber_id' => $subscriber->id]);
        factory(Field::class)->create(['subscriber_id' => $subscriber->id]);
        factory(Field::class)->create(['subscriber_id' => $subscriber->id]);

        $this->actingAs($this->user)
            ->getJson('/api/subscribers/'.$subscriber->id.'/fields/')
            ->assertSuccessful()
            ->assertJsonStructure(['fields']);
    }
}
