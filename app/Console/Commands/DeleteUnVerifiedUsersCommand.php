<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteUnVerifiedUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:un-verified-users';

    /**
     * The console command description.
     *
     * @var string
     */
protected $description = 'This command will be delete un verified users';

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
        //--------------- laravel log file e print---------------//
        // info('Custom Artisan command');


        //--------------- Writing Output ---------------//
        // $this->info('User Deleted Successfully!');


        //--------------- Prompting For Input ---------------//
        // $name = $this->ask("What is your Name?");
        // $this->info("You Habe Entered : $name");

        // $name = $this->ask("What is your Name?");
        // $password = $this->secret("Enter Yore Password");
        // $this->info("You Habe Entered Name: $name");
        // $this->info('You Habe Entered Password:' . $password);


        //--------------- Asking For Confirmation ---------------//
        // $name = '';
        // if ($this->confirm('Do you wish to continue?')) {
        //     $name = $this->ask("What is your name?");
        // }
        // $this->info("You Habe Entered Name: $name");


        // $name = '';
        // if ($this->confirm('Do you wish to continue?',true)) {
        //     $name = $this->ask('What is your name?');
        // }
        // $this->info("You Habe Entered Name: $name");


        //--------------- Auto-Completion ---------------//
        // $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
        // $this->info("You Habe Entered Name: $name");

        // $name = $this->anticipate('What is your address?', function ($input) {
        //     // Return auto-completion options...
        // });


        //--------------- Multiple Choice Questions ---------------//
        // $defaultIndex = 0;
        // $name = $this->choice(
        //     'What is your name?',
        //     ['Taylor', 'Dayle', 'Biplob', 'Bipu'],
        //     $defaultIndex
        // );
        //  $this->info('You Habe Entered Name:' . $name);

        // Error message display
        // $this->error('Something went wrong!');
        
        // Line Print 
        // $this->line('Display this on the screen');

        // // Write a single blank line...
        // $this->newLine();

        // // Write three blank lines...
        // $this->newLine(3);



        //------------ Tables ------------//

        // $this->table(
        //     ['Name', 'Email'],
        //     User::all(['name', 'email'])->toArray()
        // );

        //------------ Progress Bars ------------//

        // $users = $this->withProgressBar(User::all(), function ($user) {
        //     $this->performTask($user);
        // });



        // $users = User::all();
        // $bar = $this->output->createProgressBar(count($users));
        // $bar->start();
        // foreach ($users as $user) {
        //     $this->performTask($user);

        //     $bar->advance();
        // }

        // $bar->finish();




        //----------------------- Final Use case in Handel Method -----------------//

        // check korlam use gulo ase kina.
        // $this->table(
        //     ['Name', 'email'],
        //     User::WhereNull('email_verified_at')->get('name', 'email')
        // );

        User::WhereNull('email_verified_at')->delete();
        $this->info('Users Haas Been Deleted Successfully!');










    }
}
