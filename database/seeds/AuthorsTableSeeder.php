<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Author::class, 50)->create()->each(function ($a){
            $a->articles()->saveMany(factory(App\Article::class, 1)->make(['author_id' => NULL])
            );
        });
    }
}
