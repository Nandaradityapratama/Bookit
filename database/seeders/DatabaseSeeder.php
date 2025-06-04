<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Visit;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Buat user admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'nisn' => 'ADMIN-00000001',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Buat beberapa kategori
        $categories = [
            ['name' => 'Matematika', 'slug' => 'matematika'],
            ['name' => 'Bahasa Indonesia', 'slug' => 'bahasa-indonesia'],
            ['name' => 'Bahasa Inggris', 'slug' => 'bahasa-inggris'],
            ['name' => 'IPA', 'slug' => 'ipa'],
            ['name' => 'IPS', 'slug' => 'ips'],
            ['name' => 'Novel', 'slug' => 'novel'],
            ['name' => 'Biografi', 'slug' => 'biografi'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Buat beberapa buku
        $books = [
            [
                'title' => 'Matematika Kelas X',
                'description' => 'Buku pelajaran matematika untuk kelas X SMA/MA',
                'author' => 'Tim Matematika',
                'category_id' => 1,
                'type' => 'book',
                'image_path' => '/images/books/matematika.jpg'
            ],
            [
                'title' => 'Dilan 1990',
                'description' => 'Novel tentang kisah cinta di tahun 1990',
                'author' => 'Pidi Baiq',
                'category_id' => 6,
                'type' => 'novel',
                'image_path' => '/images/books/dilan.jpg'
            ],
            // Tambahkan buku lainnya sesuai kebutuhan
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Tambah kunjungan awal
        Visit::create([
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Seeder'
        ]);

        $this->call([
            AdminSeeder::class,
        ]);
    }
}
