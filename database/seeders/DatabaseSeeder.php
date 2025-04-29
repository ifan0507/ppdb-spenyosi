<?php

namespace Database\Seeders;

use App\Models\Jalur;
use App\Models\Info;
use App\Models\MataPelajaran;
use App\Models\OrtuSiswa;
use App\Models\Register;
use App\Models\SiswaBaru;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            [
                "nama_jalur" => "Umum",
                "keterangan" => "Jalur Umum adalah jalur pendaftaran terbuka bagi seluruh calon peserta didik yang ingin melanjutkan pendidikan ke SMP Negeri 1 Yosowilangun tanpa kriteria khusus. Seleksi dilakukan berdasarkan kuota dan waktu pendaftaran."
            ],
            [
                "nama_jalur" => "Afirmasi (Siswa dari keluarga kurang mampu)",
                "keterangan" => "Jalur Afirmasi diperuntukkan bagi calon peserta didik yang berasal dari keluarga kurang mampu dan ingin bersekolah di SMP Negeri 1 Yosowilangun. Dibutuhkan bukti pendukung seperti KIP, KKS, atau surat keterangan tidak mampu dari pihak berwenang."
            ],
            [
                "nama_jalur" => "Pindah Tugas (Orang tua/wali pindah kerja)",
                "keterangan" => "Jalur ini dikhususkan untuk calon peserta didik yang mengikuti orang tua/wali yang pindah tugas kerja ke wilayah sekitar SMP Negeri 1 Yosowilangun. Wajib melampirkan surat keterangan resmi dari instansi tempat orang tua/wali bekerja."
            ],
            [
                "nama_jalur" => "Lomba/Tahfidz (Peraih prestasi di bidang akademik/non-akademik atau tahfidz Al-Qur'an)",
                "keterangan" => "Jalur ini memberi kesempatan bagi calon peserta didik yang memiliki prestasi lomba di bidang akademik, non-akademik, atau hafalan Al-Qur'an untuk mendaftar ke SMP Negeri 1 Yosowilangun. Wajib melampirkan bukti prestasi atau surat keterangan tahfidz."
            ],
            [
                "nama_jalur" => "Prestasi (Nilai Raport)",
                "keterangan" => "Jalur Prestasi seleksi berdasarkan nilai rapor dari semester sebelumnya. Jalur ini ditujukan bagi calon peserta didik dengan capaian akademik tinggi yang ingin melanjutkan pendidikan di SMP Negeri 1 Yosowilangun."
            ],
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
            'id_jalur' => '5',
            'email_verified_at' => now(),
            'verification_code' => null,
        ]);

        // $akun = Register::create([
        //     'nisn' => '1234566233',
        //     "no_register" => "202504180004",
        //     'email' => 'farhan@gmail.com',
        //     'password' => '123',
        //     'id_jalur' => '5',
        //     'email_verified_at' => now(),
        //     'verification_code' => null,
        // ]);

        // $siswa = SiswaBaru::create([
        //     'id_register_siswa' => $akun->id,
        //     'nama' => 'farhan',
        //     'nisn' => $akun->nisn,
        //     'email' => $akun->email,
        //     'nik' => "_",
        //     "tempat_lahir" => "_",
        //     "asal_sekolah" => "_",
        //     "kabupaten" => "_",
        //     "kecamatan" => "_",
        //     "desa" => "_",
        //     "alamat" => "_",
        //     "no_hp" => "_",
        //     "lokasi" => "_",
        //     "jarak_sekolah" => '5.0',
        //     "foto_kk" => 'default_document.png',
        //     "foto_siswa" => 'default_siswa.png',
        //     "foto_akte" => 'default_document.png',
        //     "status_berkas" => "1"
        // ]);

        // OrtuSiswa::create([
        //     'id_siswa' => $siswa->id,
        //     "ayah" => "_",
        //     "pekerjaan_ayah" => "_",
        //     "pendidikan_ayah" => "_",
        //     "ibu" => "_",
        //     "pekerjaan_ibu" => "_",
        //     "pendidikan_ibu" => "_",
        //     "no_hp" => "_",
        //     "status_berkas" => "1"
        // ]);


        // $sourcePath = public_path('assets/SOAL.pdf');

        // $destinationPath = 'admin/info-files/SOAL.pdf';

        // // Copy ke storage
        // Storage::put($destinationPath, File::get($sourcePath));
        // Info::create([
        //     'judul' => 'testing blabalana',
        //     'file' =>  $destinationPath,
        //     'deskripsi' => 'nvsklg;nga gwggwr gjgbergjergegvngenvjbfjbviebvibe'
        // ]);
    }
}
