<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resep;

class ResepSeeder extends Seeder
{

    private array $kategoriMap = [

        'Pedas' => [
            'balado',
            'rica',
            'geprek',
            'mercon',
            'sambal',
            'seblak',
            'woku',
            'cabai',
            'lado',
            'pedas',
            'teri balado',
            'ayam penyet',
        ],

        'Kuah' => [
            'soto',
            'sup',
            'sop',
            'rawon',
            'bakso',
            'gulai',
            'kari',
            'coto',
            'mie kocok',
            'sayur asem',
            'sayur bening',
            'lontong kari',
            'mie rebus',
        ],

        'Minuman' => [
            'es ',
            'jus',
            'juice',
            'kopi',
            'teh',
            'bandrek',
            'bajigur',
            'wedang',
            'susu',
            'milkshake',
            'smoothie',
            'sirup',
            'cendol',
            'es buah',
        ],

        'Manis' => [
            'brownies',
            'cake',
            'bolu',
            'puding',
            'kolak',
            'donat',
            'klepon',
            'lapis',
            'roti',
            'martabak manis',
            'kue',
            'dessert',
        ],

        'Jajanan' => [
            'batagor',
            'cireng',
            'cilok',
            'combro',
            'misro',
            'pempek',
            'surabi',
            'martabak',
            'bakwan',
            'lumpia',
            'pastel',
            'risol',
            'tahu isi',
            'otak',
        ],

        'Tumis' => [
            'tumis',
            'oseng',
            'capcay',
            'kangkung',
            'cah ',
        ],

    ];

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

        $count = 0;

        $statistik = [
            'Pedas' => 0,
            'Gurih' => 0,
            'Manis' => 0,
            'Jajanan' => 0,
            'Minuman' => 0,
            'Kuah' => 0,
            'Tumis' => 0,
        ];

        while (($row = fgetcsv($handle, 0, ",")) !== false) {

            // Import 10 data dulu untuk testing
            if ($count >= 50) {
                break;
            }

            $kategori = $this->getKategori(
                $row[0], // Title
                $row[1], // Ingredients
                $row[5]  // Category
            );

            $this->command->line(
                "{$row[0]} ==> {$kategori}"
            );

            $statistik[$kategori]++;

            Resep::create([

                'kategori' => $kategori,

                'judul' => $row[0],

                'gambar' => $this->getGambar($kategori),

                'deskripsi' => $this->getDeskripsi($row[0], $kategori),

                'link' => $row[4],

                'waktu' => $this->getWaktu((int)$row[9]),

                'kesulitan' => $this->getKesulitan((int)$row[9]),

                'porsi' => $this->getPorsi((int)$row[7]),

                'bahan' => str_replace('--', PHP_EOL, $row[1]),

                'langkah' => $row[2],

            ]);

            $count++;
        }

        fclose($handle);

        $this->command->newLine();

        $this->command->info('========== HASIL IMPORT ==========');

        foreach ($statistik as $kategori => $jumlah) {

            $this->command->line(
                str_pad($kategori, 12) . ' : ' . $jumlah
            );

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
        $config = config('resep_kategori');

        $judul = strtolower($judul);
        $ingredients = strtolower($ingredients);
        $category = strtolower($category);

        $score = [];

        foreach ($config as $namaKategori => $rules) {

            $score[$namaKategori] = 0;

            // skor dari judul
            foreach ($rules['judul'] as $keyword) {

                if (str_contains($judul, strtolower($keyword))) {

                    $score[$namaKategori] += 3;

                }

            }

            // skor dari bahan
            foreach ($rules['bahan'] as $keyword) {

                if (str_contains($ingredients, strtolower($keyword))) {

                    $score[$namaKategori] += 2;

                }

            }

            // skor dari category dataset
            foreach ($rules['category'] as $keyword) {

                if (str_contains($category, strtolower($keyword))) {

                    $score[$namaKategori] += 1;

                }

            }

        }

        arsort($score);

        return array_key_first($score);
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
        return "{$judul} merupakan resep kategori {$kategori} yang mudah dibuat di rumah dan cocok disajikan sebagai menu sehari-hari.";
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

    private function getPorsi(int $bahan): string
    {
        if ($bahan <= 5) {

            return '2 Porsi';

        }

        if ($bahan <= 10) {

            return '4 Porsi';

        }

        return '6 Porsi';
    }
}