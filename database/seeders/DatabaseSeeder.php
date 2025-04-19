<?php

namespace Database\Seeders;

use App\Models\Jalur;
use App\Models\MataPelajaran;
use App\Models\OrtuSiswa;
use App\Models\Register;
use App\Models\SiswaBaru;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        MataPelajaran::insert([
            ["nama_matapelajaran" => "Pendidikan Agama"],
            ["nama_matapelajaran" => "Pendidikan Pancasila & Kewarganegaraan"],
            ["nama_matapelajaran" => "Bahasa Indonesia"],
            ["nama_matapelajaran" => "Matematika"],
            ["nama_matapelajaran" => "Ilmu Pengetahuan Alam (IPA)"],
            ["nama_matapelajaran" => "Ilmu Pengetahuan Sosial (IPS)"],
            ["nama_matapelajaran" => "Seni Budaya dan Prakarya"],
            ["nama_matapelajaran" => "Pend. Jasmani, Olahraga dan Kesehatan"]
        ]);

        Jalur::insert([
            ["nama_jalur" => "Umum"],
            ["nama_jalur" => "Afirmasi (Siswa dari keluarga kurang mampu)"],
            ["nama_jalur" => "Pindah Tugas (Orang tua/wali pindah kerja)"],
            ["nama_jalur" => "Lomba/Tahfidz (Peraih prestasi di bidang akademik/non-akademik atau tahfidz Al-Qur'an)"],
            ["nama_jalur" => "Prestasi (Nilai Raport)"]
        ]);

        User::create([
            'email' => "ipan@gmail.com",
            'password' => '123',
            'name' => "ifan",
            'role' => "admin",
        ]);

    }
}
