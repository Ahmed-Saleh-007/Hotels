<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use App\Notifications\ClientMissing;
use App\Notifications\ClientGreeting;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class EmailSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $users = User::where('level','client')->where('last_login', '<=', Carbon::now()->toDateTimeString())->get();
        //$users = User::where('level','client')->where('last_login', '<=', Carbon::now()->subMonth()->toDateTimeString())->get();
        foreach($users as $user) {
            $user->notify((new ClientMissing()));
        }
    }
}
