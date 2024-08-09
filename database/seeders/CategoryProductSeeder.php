<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $datas = [
            "Makanan", "Minuman", "Elektronik", "Kesehatan", "Fashion"
        ];

        foreach ($datas as $data) {
            CategoryProduct::create([
                "name" => $data,
            ]);
        }

    }
}
