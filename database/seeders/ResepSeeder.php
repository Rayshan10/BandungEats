<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Resep;

class ResepSeeder extends Seeder
{

    private array $statistik = [
        'Pedas' => 0,
        'Gurih' => 0,
        'Manis' => 0,
        'Jajanan' => 0,
        'Minuman' => 0,
        'Kuah' => 0,
        'Tumis' => 0,
    ];

    private array $quota = [
        'Pedas' => 70,
        'Gurih' => 120,
        'Manis' => 70,
        'Jajanan' => 70,
        'Minuman' => 60,
        'Kuah' => 60,
        'Tumis' => 50,
    ];

    private function loadDataset(): array
    {
        $file = database_path('dataset/Indonesian_Food_Recipes.csv');

        if (!file_exists($file)) {
            throw new \Exception("Dataset tidak ditemukan.");
        }

        $handle = fopen($file, 'r');

        if ($handle === false) {
            throw new \Exception("Gagal membuka dataset.");
        }

        fgetcsv($handle);

        $recipes = [];

        while (($row = fgetcsv($handle, 0, ",")) !== false) {
            $recipes[] = $row;
        }

        fclose($handle);

        return $recipes;
    }

    private function buildRecipeData(array $row, string $kategori): array
    {
        return [
            'kategori' => $kategori,
            'judul' => $row[0],
            'gambar' => $this->getGambar($kategori),
            'deskripsi' => $this->getDeskripsi($row[0], $kategori),
            'link' => $row[4],
            'waktu' => $this->getWaktu((int) $row[9]),
            'kesulitan' => $this->getKesulitan((int) $row[9]),
            'porsi' => !empty($row[7]) ? $row[7] . ' Porsi' : '2 Porsi',
            'bahan' => str_replace('--', PHP_EOL, $row[1]),
            'langkah' => $row[2],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function classifyRecipes(array $recipes): array
    {
        $grouped = [];

        foreach ($this->quota as $kategori => $limit) {
            $grouped[$kategori] = [];
        }

        foreach ($recipes as $row) {

            // Pastikan baris CSV memiliki minimal 10 kolom
            if (count($row) < 10) {
                continue;
            }

            $kategori = $this->getKategori(
                $row[0],
                $row[1],
                $row[5]
            );

            $grouped[$kategori][] = $this->buildRecipeData($row, $kategori);
        }

        return $grouped;
    }

    private function saveBalancedRecipes(array $grouped): void
    {
        DB::transaction(function () use ($grouped) {

            foreach ($this->quota as $kategori => $limit) {

                shuffle($grouped[$kategori]);

                $selected = array_slice(
                    $grouped[$kategori],
                    0,
                    min($limit, count($grouped[$kategori]))
                );

                Resep::insert($selected);

                $this->statistik[$kategori] = count($selected);
            }

        });
    }

    private function showStatistics(): void
    {
        $this->command->newLine();

        $this->command->info("========== HASIL IMPORT ==========");

        $total = 0;

        foreach ($this->statistik as $kategori => $jumlah) {
            $this->command->line(
                str_pad($kategori, 10) . " : " . $jumlah
            );

            $total += $jumlah;
        }

        $this->command->info("--------------------------------");

        $this->command->info("Total Resep : {$total}");

        $this->command->info("===============================");
    }

    public function run(): void
    {
        $recipes = $this->loadDataset();

        shuffle($recipes);

        $grouped = $this->classifyRecipes($recipes);

        $this->saveBalancedRecipes($grouped);

        $this->showStatistics();
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

            foreach ($rules['override'] ?? [] as $keyword) {

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

        $score = [];

        foreach ($config as $namaKategori => $rules) {

            $score[$namaKategori] = 0;

            // Judul
            foreach ($rules['judul'] ?? [] as $keyword) {
                if (str_contains($judul, strtolower($keyword))) {
                    $score[$namaKategori] += 5;
                }
            }

            // Bahan
            foreach ($rules['bahan'] ?? [] as $keyword) {
                if (str_contains($ingredients, strtolower($keyword))) {
                    $score[$namaKategori] += 2;
                }
            }

            // Category CSV
            foreach ($rules['category'] ?? [] as $keyword) {
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