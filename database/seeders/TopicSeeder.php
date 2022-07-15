<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Programming', 'Design', 'SEO', 'Business', 'Random'];

        foreach ($names as $name) {
            Topic::create([
                'name' => $name
            ]);
        }
//        Topic::factory(10)->create();
    }
}
