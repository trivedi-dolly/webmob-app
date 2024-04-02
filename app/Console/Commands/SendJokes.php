<?php

namespace App\Console\Commands;

use App\Mail\JokeEmail;
use App\Models\Joke;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class SendJokes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:jokes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is for sending jokes to users at their specific time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $curretTime = Carbon::now()->format('H:i');
        // dd($curretTime);

        $users = User::whereTime('start_time', '<=', $curretTime)->whereTime('end_date', '>=', $curretTime)->get();

        foreach ($users as $user) {
            $jokes = Joke::inRandomOrder()->limit($user->jokes_no)->get();

            Mail::to($user->email)->send(new JokeEmail($jokes));
        }
    }
}
