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
        $topics = ['Programming', 'Design', 'SEO', 'Business', 'Random'];

        foreach ($topics as $topic) {
            Topic::create([
                'name' => $topic
            ]);
        }
//        Topic::factory(10)->create();
    }
}
