<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // Item::factory()->times(10)->create();
        $items = [
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Buku tulis",
                "price"=> 5000,
                "description"=> "Buku tulis kertas HVS ukuran A5"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Pensil",
                "price"=> 2000,
                "description"=> "Pensil kayu dengan ujung yang tajam"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Buku catatan",
                "price"=> 10000,
                "description"=> "Buku catatan spiral ukuran A4"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Penggaris",
                "price"=> 3000,
                "description"=> "Penggaris plastik ukuran 30cm"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Pulpen",
                "price"=> 5000,
                "description"=> "Pulpen warna hitam dengan tinta yang tahan lama"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Kertas HVS",
                "price"=> 15000,
                "description"=> "Kertas HVS ukuran A4 dengan ketebalan 70gsm"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Spidol",
                "price"=> 10000,
                "description"=> "Spidol warna-warni untuk menulis di papan tulis"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Stabilo",
                "price"=> 8000,
                "description"=> "Stabilo warna-warni untuk menandai teks"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Penghapus",
                "price"=> 1000,
                "description"=> "Penghapus karet yang mudah dihapus"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Sticky notes",
                "price"=> 5000,
                "description"=> "Sticky notes berwarna-warni untuk menuliskan catatan"
            ],
            [
                "id" => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16),
                "name"=> "Clipboard",
                "price"=> 15000,
                "description"=> "Clipboard kayu dengan klip kawat"
            ]
        ];

        Item::insert($items);
    }
}

