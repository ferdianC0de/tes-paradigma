<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'text',
        'price',
        'stocks',
        'descriptions',
        'category_id'
    ];

    public function getCategory(): BelongsTo{
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->id = Str::uuid();
            } catch (Exception $e) {
                abort(500, $e->getMessage());
            }
        });
    }

}
