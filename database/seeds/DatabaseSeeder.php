<?php

use Illuminate\Database\Seeder;
use App\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        App\User::create([
          'name'      =>  'admin',
          'email'     =>  'admin@gmail.com',
          'password'  =>  bcrypt('password')
        ]);

        factory(Post::class,18)->create();
    }
}
