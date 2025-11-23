<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Voted;
use App\Models\Voter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'email_admin' => 'kamaluddinarsyadfadllillah@mail.ugm.ac.id',
            'password' => Hash::make('12345678')
        ]);
        Voted::factory(3)->create();
        Voter::create(['name' => 'Kamaluddin Arsyad Fadllillah', 'email' => 'kamaluddinarsyadfadllillah@mail.ugm.ac.id']);
        Voter::create(['name' => 'Kamaluddin Arsyad Fadllillah', 'email' => 'kamaluddin.arsyad17@gmail.com']);
        Voter::create(['name' => 'Kamaluddin Arsyad Fadllillah', 'email' => 'kamaluddin.arsyad05@gmail.com']);
        Voter::create(['name' => 'Kamaluddin Arsyad Fadllillah', 'email' => 'arsyadkamaluddin@gmail.com']);
    }
}
