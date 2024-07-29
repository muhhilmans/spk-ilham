<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Criteria::create([
            'name' => 'Pengetahuan',
            'score' => 30
        ]);

        Criteria::create([
            'name' => 'Keterampilan',
            'score' => 20
        ]);

        Criteria::create([
            'name' => 'Absen',
            'score' => 15
        ]);

        Criteria::create([
            'name' => 'Sikap (Penilaian Guru)',
            'score' => 10
        ]);

        Criteria::create([
            'name' => 'Sikap (Penilaian Siswa)',
            'score' => 10
        ]);

        Criteria::create([
            'name' => 'Ekstrakulikuler',
            'score' => 5
        ]);

        Criteria::create([
            'name' => 'Prestasi',
            'score' => 10
        ]);
    }
}
