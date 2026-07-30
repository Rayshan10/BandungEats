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

        $count = 0;

        while (($row = fgetcsv($handle, 0, ",")) !== false) {

            // Import 10 data dulu untuk testing
            if ($count >= 500) {
                break;
            }

            $kategori = $this->getKategori($row[0]);

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

        $this->command->info("Berhasil mengimpor {$count} resep.");
    }

    private function getKategori(string $judul): string
    {
        $judul = strtolower($judul);

        // Minuman
        if (
            str_contains($judul, 'es ') ||
            str_contains($judul, 'jus') ||
            str_contains($judul, 'bandrek') ||
            str_contains($judul, 'bajigur') ||
            str_contains($judul, 'wedang') ||
            str_contains($judul, 'teh') ||
            str_contains($judul, 'kopi') ||
            str_contains($judul, 'susu')
        ) {
            return 'Minuman';
        }

        // Jajanan
        if (
            str_contains($judul, 'batagor') ||
            str_contains($judul, 'cireng') ||
            str_contains($judul, 'cilok') ||
            str_contains($judul, 'combro') ||
            str_contains($judul, 'misro') ||
            str_contains($judul, 'martabak') ||
            str_contains($judul, 'surabi') ||
            str_contains($judul, 'otak') ||
            str_contains($judul, 'pempek')
        ) {
            return 'Jajanan';
        }

        // Manis
        if (
            str_contains($judul, 'cake') ||
            str_contains($judul, 'brownies') ||
            str_contains($judul, 'puding') ||
            str_contains($judul, 'bolu') ||
            str_contains($judul, 'donat') ||
            str_contains($judul, 'roti') ||
            str_contains($judul, 'kue') ||
            str_contains($judul, 'kolak')
        ) {
            return 'Manis';
        }

        // Kuah
        if (
            str_contains($judul, 'soto') ||
            str_contains($judul, 'sup') ||
            str_contains($judul, 'sop') ||
            str_contains($judul, 'bakso') ||
            str_contains($judul, 'mie kocok')
        ) {
            return 'Kuah';
        }

        // Tumis
        if (
            str_contains($judul, 'tumis') ||
            str_contains($judul, 'capcay') ||
            str_contains($judul, 'oseng')
        ) {
            return 'Tumis';
        }

        // Pedas
        if (
            str_contains($judul, 'balado') ||
            str_contains($judul, 'geprek') ||
            str_contains($judul, 'rica') ||
            str_contains($judul, 'sambal') ||
            str_contains($judul, 'mercon') ||
            str_contains($judul, 'seblak')
        ) {
            return 'Pedas';
        }

        return 'Gurih';
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