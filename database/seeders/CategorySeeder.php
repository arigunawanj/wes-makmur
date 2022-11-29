<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['namaKategori' => 'Kunyit', 'descKategori' => 'Jamu Kunyit'],
            ['namaKategori' => 'Kunir', 'descKategori' => 'Jamu Kunir'],
        ];

        foreach ($data as $value) {
            Category::insert([
                'namaKategori' => $value['namaKategori'],
                'descKategori' => $value['descKategori'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
