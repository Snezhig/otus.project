<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'expression'
    ];

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();
        static::saving(function ($model) {
            if (empty($model->attributes['slug'])) {
                $model->attributes['slug'] = Str::lower(Str::slug($model->attributes['name'], '-'));
            }
        });
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
