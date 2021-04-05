<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('make:user', function () {
   $emailcounter=100;
   $passwordcounter=100000 ;
   $user=[];
   for ($i=0; $i < 20; $i++) { 

    User::create([
        'name' => 'mr. '.($emailcounter+$i),
        'email' => ($emailcounter+$i)."@test.com",
        'password' => bcrypt("123456"),
    ]);
   }
});