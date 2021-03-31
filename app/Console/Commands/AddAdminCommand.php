<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Cerbero\CommandValidator\ValidatesInput;

class AddAdminCommand extends Command
{
    use ValidatesInput;
    protected function rules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->confirm('Are you sure you want to create a new admin?')){
            $this->info('Your Name: '.$this->option('name'));
            $this->info('Your Email: '.$this->option('email'));
            $this->info('Your Password: '.$this->option('password'));
            
            if($this->confirm('Do you confirm that the email and password are correct?')){
                $admin = User::create([
                    'name' => $this->option('name'),
                    'email' => $this->option('email'),
                    'password' => Hash::make($this->option('password')),
                    'level' => 'admin',
                ]);
                $admin->assignRole('admin');
                
                $this->info('Admin with name: '. $admin->name .' created successfully'); 
            }
        }   
    }
}
