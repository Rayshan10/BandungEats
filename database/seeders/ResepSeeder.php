<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resep;

class ResepSeeder extends Seeder
{

    public function run(): void
    {
        $file = database_path('dataset/Indonesian_Food_Recipes.csv');

        if (!file_exists($file)) {
            $this->command->error('Dataset tidak ditemukan.');
            return;
        }

        $handle = fopen($file, 'r');

        // Lewati header
        fgetcsv($handle);

        $recipes = [];

        while (($row = fgetcsv($handle, 0, ",")) !== false) {

            $recipes[] = $row;

        }

        fclose($handle);

        shuffle($recipes);

        $statistik = [
            'Pedas' => 0,
            'Gurih' => 0,
            'Manis' => 0,
            'Jajanan' => 0,
            'Minuman' => 0,
            'Kuah' => 0,
            'Tumis' => 0,
        ];

        $count = 0;

        foreach ($recipes as $row) {

            if ($count >= 500) {

                break;

            }

            $kategori = $this->getKategori(
                $row[0],
                $row[1],
                $row[5]
            );

            $statistik[$kategori]++;

            Resep::create([

                'kategori' => $kategori,

                'judul' => $row[0],

                'gambar' => $this->getGambar($kategori),

                'deskripsi' => $this->getDeskripsi(
                    $row[0],
                    $kategori
                ),

                'link' => $row[4],

                'waktu' => $this->getWaktu(
                    (int)$row[9]
                ),

                'kesulitan' => $this->getKesulitan(
                    (int)$row[9]
                ),

                'porsi' => !empty($row[7])
                    ? $row[7].' Porsi'
                    : '2 Porsi',

                'bahan' => str_replace(
                    '--',
                    PHP_EOL,
                    $row[1]
                ),

                'langkah' => $row[2],

            ]);

            $count++;

        }

        $this->command->newLine();

        $this->command->info('========== HASIL IMPORT ==========');

        foreach ($statistik as $kategori => $jumlah) {
            $this->command->info("{$kategori} : {$jumlah}");
        }

        $this->command->info('--------------------------------');

        $this->command->info('Total Resep : '.$count);

        $this->command->info('===============================');
    }

    private function getKategori(
        string $judul,
        string $ingredients,
        string $category
    ): string
    {

        $judul = strtolower($judul);
        $ingredients = strtolower($ingredients);
        $category = strtolower($category);
        $config = config('resep_kategori');

        /*
        |--------------------------------------------------------------------------
        | OVERRIDE RULE
        |--------------------------------------------------------------------------
        */

        foreach ($config as $namaKategori => $rules) {

            if (!isset($rules['override'])) {
                continue;
            }

            foreach ($rules['override'] as $keyword) {

                if (str_contains($judul, strtolower($keyword))) {

                    return $namaKategori;

                }

            }

        }

/*
|--------------------------------------------------------------------------
| SCORING ENGINE
|--------------------------------------------------------------------------
*/

        /*
        |--------------------------------------------------------------------------
        | SCORING ENGINE
        |--------------------------------------------------------------------------
        */

        $score = [];

        foreach ($config as $namaKategori => $rules) {

            $score[$namaKategori] = 0;

            // Judul
            foreach ($rules['judul'] as $keyword) {
                if (str_contains($judul, strtolower($keyword))) {
                    $score[$namaKategori] += 5;
                }
            }

            // Bahan
            foreach ($rules['bahan'] as $keyword) {
                if (str_contains($ingredients, strtolower($keyword))) {
                    $score[$namaKategori] += 2;
                }
            }

            // Category CSV
            foreach ($rules['category'] as $keyword) {
                if (str_contains($category, strtolower($keyword))) {
                    $score[$namaKategori] += 3;
                }
            }

        }

        arsort($score);

        $kategori = array_key_first($score);

        if ($score[$kategori] == 0) {
            return 'Gurih';
        }

        return $kategori;
    }

    private function getGambar(string $kategori): string
    {
        return match ($kategori) {

            'Pedas' => 'resep/pedas.jpg',

            'Gurih' => 'resep/gurih.jpg',

            'Manis' => 'resep/manis.jpg',

            'Jajanan' => 'resep/jajanan.jpg',

            'Minuman' => 'resep/minuman.jpg',

            'Kuah' => 'resep/kuah.jpg',

            'Tumis' => 'resep/tumis.jpg',

            default => 'resep/default-food.jpg',

        };
    }

    private function getDeskripsi(string $judul, string $kategori): string
    {
        $templates = [

            "{$judul} merupakan hidangan {$kategori} yang cocok disajikan bersama keluarga.",

            "{$judul} adalah salah satu resep {$kategori} yang praktis dibuat di rumah.",

            "{$judul} menghadirkan cita rasa khas Indonesia yang cocok untuk menu sehari-hari.",

            "{$judul} menjadi pilihan menu {$kategori} dengan bahan yang mudah ditemukan.",

        ];

        return $templates[array_rand($templates)];
    }

    private function getKesulitan(int $step): string
    {
        if ($step <= 5) {

            return 'Mudah';

        }

        if ($step <= 9) {

            return 'Sedang';

        }

        return 'Sulit';
    }

    private function getWaktu(int $step): string
    {
        return ($step * 7) . ' Menit';
    }

}