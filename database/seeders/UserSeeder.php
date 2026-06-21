<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@smkn1sungailiat.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole('admin');

        $guru1 = User::create([
            'name'     => 'Budi Santoso, S.Pd',
            'email'    => 'budi@smkn1sungailiat.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $guru1->assignRole('guru_wali');

        $guru2 = User::create([
            'name'     => 'Sari Dewi, S.Pd',
            'email'    => 'sari@smkn1sungailiat.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $guru2->assignRole('guru_wali');

        $ortu = User::create([
            'name'     => 'Ahmad Fauzi',
            'email'    => 'ortu1@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        $ortu->assignRole('orang_tua');

        $siswa = User::create([
            'name'     => 'Rizky Pratama',
            'email'    => 'rizky@siswa.smkn1sungailiat.sch.id',
            'password' => Hash::make('password123'),
        ]);
        $siswa->assignRole('siswa');
    }
}