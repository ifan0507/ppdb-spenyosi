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


        $akun = Register::create([
            'nisn' => '1234567890',
            "no_register" => "202504180001",
            'email' => 'ipan.lmj0507@gmail.com',
            'password' => '123',
            'id_jalur' => '1',
            'email_verified_at' => now(),
            'verification_code' => null,
        ]);

        $siswa = SiswaBaru::create([
            'id_register_siswa' => $akun->id,
            'nama' => 'ifan',
            'nisn' => '1234567890',
            'email' => 'ipan.lmj0507@gmail.com',
            'nik' => "_",
            "tempat_lahir" => "_",
            "asal_sekolah" => "_",
            "kabupaten" => "_",
            "kecamatan" => "_",
            "desa" => "_",
            "alamat" => "_",
            "no_hp" => "_",
            "lokasi" => "_",
            "foto_kk" => 'default_document.png',
            "foto_siswa" => 'default_siswa.png',
            "foto_akte" => 'default_document.png',
            "status_berkas" => "1"
        ]);

        OrtuSiswa::create([
            'id_siswa' => $siswa->id,
            "ayah" => "_",
            "pekerjaan_ayah" => "_",
            "pendidikan_ayah" => "_",
            "ibu" => "_",
            "pekerjaan_ibu" => "_",
            "pendidikan_ibu" => "_",
            "no_hp" => "_",
            "status_berkas" => "1"
        ]);
    }
}
