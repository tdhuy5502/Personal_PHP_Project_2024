<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tbl_category_product';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name',
        'category_desc',
        'category_status',
        'created_at',
        'updated_at'
    ];
}
