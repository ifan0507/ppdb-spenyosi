<?php

namespace Database\Seeders;

use App\Models\Akademik;
use App\Models\DataRaport;
use App\Models\DocumentAfirmasi;
use App\Models\DocumentMutasi;
use App\Models\DocumentPrestasiLomba;
use App\Models\Jalur;
use App\Models\Info;
use App\Models\MataPelajaran;
use App\Models\NonAkademik;
use App\Models\OrtuSiswa;
use App\Models\Pendaftaran;
use App\Models\RataRataRaport;
use App\Models\Register;
use App\Models\SiswaBaru;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
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
            ["nama_matapelajaran" => "Pend. Jasmani, Olahraga dan Kesehatan"],
            ["nama_matapelajaran" => "Bahasa Jawa"]
        ]);

        Jalur::insert([
            [
                "nama_jalur" => "Umum",
                "keterangan" => "Jalur Umum adalah jalur pendaftaran terbuka bagi seluruh calon peserta didik yang ingin melanjutkan pendidikan ke SMP Negeri 1 Yosowilangun tanpa kriteria khusus. Seleksi dilakukan berdasarkan seleksi domisili
                            dan zonasi sesuai daya tampung sekolah."
            ],
            [
                "nama_jalur" => "Afirmasi (KIP, KKS, PKH)",
                "keterangan" => "Jalur Afirmasi diperuntukkan bagi calon peserta didik yang berasal dari keluarga kurang mampu dan ingin bersekolah di SMP Negeri 1 Yosowilangun. Dibutuhkan bukti pendukung seperti KIP, KKS, atau surat keterangan tidak mampu dari pihak berwenang."
            ],
            [
                "nama_jalur" => "Pindah Tugas (Orang tua/wali pindah kerja)",
                "keterangan" => "Jalur ini dikhususkan untuk calon peserta didik yang mengikuti orang tua/wali yang pindah tugas kerja ke wilayah sekitar SMP Negeri 1 Yosowilangun. Wajib melampirkan surat keterangan resmi dari instansi tempat orang tua/wali bekerja."
            ],
            [
                "nama_jalur" => "Prestasi Lomba Akademik",
                "keterangan" => "Jalur ini memberi kesempatan bagi calon peserta didik yang memiliki prestasi lomba di bidang akademik, non-akademik, atau hafalan Al-Qur'an untuk mendaftar ke SMP Negeri 1 Yosowilangun. Wajib melampirkan bukti prestasi atau surat keterangan tahfidz."
            ],
            [
                "nama_jalur" => "Prestasi Lomba Non Akademik",
                "keterangan" => "Jalur ini memberi kesempatan bagi calon peserta didik yang memiliki prestasi lomba di bidang akademik, non-akademik, atau hafalan Al-Qur'an untuk mendaftar ke SMP Negeri 1 Yosowilangun. Wajib melampirkan bukti prestasi atau surat keterangan tahfidz."
            ],
            [
                "nama_jalur" => "Prestasi Nilai Raport",
                "keterangan" => "Jalur Prestasi seleksi berdasarkan nilai rapor dari semester sebelumnya. Jalur ini ditujukan bagi calon peserta didik dengan capaian akademik tinggi yang ingin melanjutkan pendidikan di SMP Negeri 1 Yosowilangun."
            ],
        ]);

        User::insert([
            [
                'id' => (string) Str::ulid(),
                'email' => "ipan.lmj0507@gmail.com",
                'password' =>  bcrypt('@Bismillah2025'),
                'name' => "ifan",
                'role' => "admin",
            ],
            [
                'id' => (string) Str::ulid(),
                'email' => "catfly765@gmail.com",
                'password' =>  bcrypt('@Bismillah2025'),
                'name' => "bima",
                'role' => "admin",
            ],
            [
                'id' => (string) Str::ulid(),
                'email' => "aisadwy@gmail.com",
                'password' =>  bcrypt('@Bismillah2025'),
                'name' => "Aisa",
                'role' => "admin",
            ],
            [
                'id' => (string) Str::ulid(),
                'email' => "alvionita@gmail.com",
                'password' =>  bcrypt('@Bismillah2025'),
                'name' => "Alvionita",
                'role' => "admin",
            ],
            [
                'id' => (string) Str::ulid(),
                'email' => "admin@gmail.com",
                'password' =>  bcrypt('@Bismillah2025'),
                'name' => "Admin",
                'role' => "admin",
            ],
        ]);

        // $akun = Register::create([
        //     'nisn' => '1234567890',
        //     "no_register" => "202504180001",
        //     'email' => 'ipan.lmj0507@gmail.com',
        //     'password' => '123',
        //     'id_jalur' => '5',
        //     'email_verified_at' => now(),
        //     'verification_code' => null,
        // ]);



        // $tingkatPrestasi = ['Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional'];
        // $jura = ['Peringkat 1', 'Peringkat 2', 'Peringkat 3', 'Lainnya'];
        // $afirmasi = ['KIP', 'KKS', 'PKH'];
        for ($i = 0; $i < 20; $i++) {
            $akun = Register::create([
                'nisn' => fake()->unique()->numerify('##########'), // 10 digit angka
                'no_register' => now()->format('Ymd') . fake()->unique()->numerify('####'),
                'email' => fake()->unique()->safeEmail(),
                // 'email' => 'ifan@gmail.com',
                'password' => '123',
                'id_jalur' => '1',
                'email_verified_at' => now(),
                'verification_code' => null,
            ]);

            $siswa = SiswaBaru::create([
                'id_register_siswa' => $akun->id,
                'nama' => fake()->name(),
                'nisn' => $akun->nisn,
                'email' => $akun->email,
                'nik' => fake()->numerify('################'),
                'jenis_kelamin' => fake()->randomElement(['Laki-Laki', 'Perempuan']),
                'tempat_lahir' => fake()->city(),
                'tanggal_lahir' => fake()->date(),
                'asal_sekolah' => fake()->company(),
                'kabupaten' => fake()->city(),
                'kecamatan' => fake()->city(),
                'desa' => fake()->streetName(),
                'kab_id' => fake()->numerify('35###'),
                'kec_id' => fake()->numerify('35###'),
                'desa_id' => fake()->numerify('35###'),
                'rt' => fake()->numerify('###'),
                'rw' => fake()->numerify('###'),
                'alamat' => fake()->address(),
                'no_hp' => fake()->numerify('08##########'),
                'email' => fake()->safeEmail(),
                'lokasi' => fake()->latitude(-8.5, -7.0) . ',' . fake()->longitude(111.0, 114.0),
                'jarak_sekolah' => fake()->randomFloat(2, 0.1, 10.0),
                'foto_kk' => 'default_document.png',
                'foto_siswa' => 'default_siswa.png',
                'foto_akte' => 'default_document.png',
                'status_berkas' => '1'
            ]);


            OrtuSiswa::create([
                'id_siswa' => $siswa->id,
                'ayah' => fake()->name('male'),
                'status_ayah' => 'Hidup',
                'status_hubungan' => 'Ayah Kandung',
                'hubungan_wali' => 'Orang Tua',
                'pekerjaan_ayah' => fake()->jobTitle(),
                'pendidikan_ayah' => 'SMA',
                'ibu' => fake()->name('female'),
                'status_ibu' => 'Hidup',
                'pekerjaan_ibu' => fake()->jobTitle(),
                'pendidikan_ibu' => 'SMA',
                'no_hp' => fake()->numerify('08##########'),
                'status_berkas' => '1',
            ]);

            // DocumentAfirmasi::create([
            //     'id_register' => $akun->id,
            //     'jenis_afirmasi' => Arr::random($afirmasi),
            //     'status_berkas' => '1',
            //     'image' => 'default_document.png'
            // ]);

            // DocumentMutasi::create([
            //     'id_register' => $akun->id,
            //     'asal_tugas' => fake()->city(),
            //     'status_berkas' => '1',
            //     'thn_pindah' => fake()->numberBetween(2005, 2010),
            //     'image' => 'default_document.png'
            // ]);

            // Akademik::create([
            //     'id_register' => $akun->id,
            //     'nama_prestasi' => fake()->randomElement([
            //         'Olimpiade Matematika',
            //         'Lomba Cerdas Cermat',
            //         'Lomba Baca Puisi',
            //         'Lomba Sains',
            //         'Lomba Desain Poster',
            //     ]),
            //     'tingkat_prestasi' => Arr::random($tingkatPrestasi),
            //     'perolehan' => Arr::random($jura),
            //     // 'kategori' => 
            //     'status_berkas' => '1',
            //     'image' => 'default_document.png'
            // ]);
            // NonAkademik::create([
            //     'id_register' => $akun->id,
            //     'nama_prestasi' => fake()->randomElement([
            //         'Lomba Pidato Bahasa Indonesia',
            //         'Turnamen Futsal',
            //         'Festival Musik Tradisional',
            //         'Lomba Kaligrafi',
            //         'Lomba Karya Tulis Ilmia'
            //     ]),
            //     'tingkat_prestasi' => Arr::random($tingkatPrestasi),
            //     'perolehan' => Arr::random($jura),
            //     // 'kategori' => 
            //     'status_berkas' => '1',
            //     'image' => 'default_document.png'
            // ]);

            // $mapelList = MataPelajaran::all(); // Ambil semua 8 mapel

            // $kelas4_1_total = 0;
            // $kelas4_2_total = 0;
            // $kelas5_1_total = 0;
            // $kelas5_2_total = 0;
            // $kelas6_1_total = 0;

            // foreach ($mapelList as $mapel) {
            //     $kelas4_1 = rand(70, 90);
            //     $kelas4_2 = rand(70, 90);
            //     $kelas5_1 = rand(70, 90);
            //     $kelas5_2 = rand(70, 90);
            //     $kelas6_1 = rand(70, 90);

            //     DataRaport::create([
            //         'id_register' => $akun->id,
            //         'id_mapel' => $mapel->id,
            //         'kelas4_1' => $kelas4_1,
            //         'kelas4_2' => $kelas4_2,
            //         'kelas5_1' => $kelas5_1,
            //         'kelas5_2' => $kelas5_2,
            //         'kelas6_1' => $kelas6_1,
            //     ]);

            //     $kelas4_1_total += $kelas4_1;
            //     $kelas4_2_total += $kelas4_2;
            //     $kelas5_1_total += $kelas5_1;
            //     $kelas5_2_total += $kelas5_2;
            //     $kelas6_1_total += $kelas6_1;
            // }

            // $jumlah_mapel = $mapelList->count();

            // $rata_kelas4_1 = $kelas4_1_total / $jumlah_mapel;
            // $rata_kelas4_2 = $kelas4_2_total / $jumlah_mapel;
            // $rata_kelas5_1 = $kelas5_1_total / $jumlah_mapel;
            // $rata_kelas5_2 = $kelas5_2_total / $jumlah_mapel;
            // $rata_kelas6_1 = $kelas6_1_total / $jumlah_mapel;

            // // Hitung total rata-rata sesuai controller (dibagi 4)
            // $total_rata = ($rata_kelas4_1 + $rata_kelas4_2 + $rata_kelas5_1 + $rata_kelas5_2 + $rata_kelas6_1) / 4;

            // DataRaport::where('id_register', $akun->id)->update([
            //     'rata_kelas4_sem1' => $rata_kelas4_1,
            //     'rata_kelas4_sem2' => $rata_kelas4_2,
            //     'rata_kelas5_sem1' => $rata_kelas5_1,
            //     'rata_kelas5_sem2' => $rata_kelas5_2,
            //     'rata_kelas6_sem1' => $rata_kelas6_1,
            //     'status' => '1',
            // ]);
            // RataRataRaport::create([
            //     'id_register' => $akun->id,
            //     'image' => 'default_document.png',
            //     'total_rata_rata' => $total_rata
            // ]);

            Pendaftaran::create([
                'id_register' => $akun->id,
                'status' => 'Pending',
                'tanggal_daftar' => Carbon::now(),
            ]);
        }


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
