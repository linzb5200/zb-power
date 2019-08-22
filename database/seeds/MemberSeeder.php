<?php

use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Member::class,20)->create([
            'password' => bcrypt('123456'),
            'uuid' => \Faker\Provider\Uuid::uuid()
        ]);
        $user = \App\Models\Member::find(1);
        $user->name = 'jonas888';
        $user->email ='jonas888@admin.com';
        $user->save();

        $user = \App\Models\Member::find(2);
        $user->name = 'jonas555';
        $user->email ='jonas555@admin.com';
        $user->save();
    }
}
