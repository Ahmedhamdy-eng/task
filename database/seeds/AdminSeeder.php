<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $admin = Admin::create([
            'name'       => 'super_admin',
            'email'      => 'super_admin@app.com',
            'password'   =>  '123456789',
        ]);
    }
}
