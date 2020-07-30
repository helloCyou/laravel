<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        \App\User::create([
//            'name'=>'lists',
//            'email'=>'55465dd@qq.com',
//            'password'=>bcrypt('123456'),
//            'is_admin'=>'1'
//        ]);
        factory(\App\User::class,100)->create();
        $user = \App\User::find(1);
        $user->name='ccc';
        $user->email = '1356024778@qq.com';
        $user->is_admin = '1';
        $user->password = bcrypt('admin888');
        $user->save();
        $user = \App\User::find(2);
        $user->name='sss';
        $user->email = '778@qq.com';
        $user->is_admin = '0';
        $user->password = bcrypt('admin888');
        $user->save();
    }
}
