<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'author',
        'type',
        'image_path',
        'pdf_path',
        'education_level',
        'grade',
        'curriculum',
        'fiction_category',
        'borrow_count',
        'pages',
        'publication_year',
        'subject',
    ];

    protected $casts = [
        'grade' => 'integer',
    ];

    /**
     * Get the category that owns the book.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the borrowings for the book.
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Get list of available subjects
     */
    public static function getSubjects()
    {
        return [
            'matematika' => 'Matematika',
            'ipa' => 'IPA',
            'ips' => 'IPS',
            'bahasa_indonesia' => 'Bahasa Indonesia',
            'bahasa_inggris' => 'Bahasa Inggris',
            'ppkn' => 'PPKn',
            'penjaskes' => 'Penjaskes',
            'seni_budaya' => 'Seni Budaya',
            'prakarya' => 'Prakarya',
            'agama' => 'Pendidikan Agama',
        ];
    }
}
