<?php

namespace Tests\Unit;

use App\Console\Commands\SendJokes;
use App\Mail\JokeEmail;
use App\Models\Joke;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;
use Mail;

class UserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_index()
    {
        $response = $this->get(route('index'));

        $response->assertStatus(200);

        $response->assertViewIs('joke_delivery_form');

    }

    public function test_insert()
    {
        $response = $this->post('/send-jokes', [
            'name' => 'John Dine',
            'email' => 'john@yopmail.com',
            'start_time' => '02:00',
            'end_time' => '02:30',
            'jokes_no' => 4
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Dine',
            'email' => 'john@yopmail.com',
            'start_time' => '02:00:00',
            'end_time' => '02:30:00',
            'jokes_no' => 4
        ]);

        $response->assertStatus(302);

        $response->assertRedirect()->assertSessionHas('success', 'User created successfully');

    }

    public function test_send_jokes_cron()
    {

        Carbon::setTestNow(Carbon::parse('2024-04-02 23:55:00'));

        $user = User::create([
            'name' => 'kirn',
            'email' => 'kirn@example.com',
            'start_time' => '5:00',
            'end_time' => '10:00',
            'jokes_no' => 3,
        ]);

        $jokes = Joke::all();

        $expectedJokes = $jokes->random($user->jokes_no);

        Mail::shouldReceive('to')->with($user->email)->andReturnSelf();

        Mail::shouldReceive('send')->withArgs(function ($mailable) use ($expectedJokes) {

            $this->assertInstanceOf(JokeEmail::class, $mailable);

            $this->assertNotEquals($mailable->jokes, $expectedJokes);

            return true;
        });

        $job = new SendJokes();

        $job->handle();

        $this->assertTrue(true);

    }
}
