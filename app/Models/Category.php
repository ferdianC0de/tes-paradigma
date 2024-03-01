<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name'
    ];

    protected $cast = [
        'id' => 'uuid'
    ];

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
