<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the books for the category.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Check if this category is for learning books.
     */
    public function isLearningCategory()
    {
        return $this->isClassCategory() || $this->isSubjectCategory();
    }

    /**
     * Check if this category is for class-based learning books (Kelas 7-12).
     */
    public function isClassCategory()
    {
        $classSlugs = ['kelas-7', 'kelas-8', 'kelas-9', 'kelas-10', 'kelas-11', 'kelas-12'];
        return in_array($this->slug, $classSlugs);
    }

    /**
     * Check if this category is for subject-based learning books.
     */
    public function isSubjectCategory()
    {
        $subjectSlugs = [
            'matematika', 'bahasa-indonesia', 'bahasa-inggris', 'fisika', 'kimia', 
            'biologi', 'sejarah', 'ekonomi', 'ipa', 'ips', 'ppkn'
        ];  
        return in_array($this->slug, $subjectSlugs);
    }

    /**
     * Check if this category is for novel books.
     */
    public function isNovelCategory()
    {
        $novelSlugs = ['fantasy', 'romance', 'action', 'drama', 'fiksi', 'non-fiksi', 'self-improvement'];
        return in_array($this->slug, $novelSlugs);
    }
}
