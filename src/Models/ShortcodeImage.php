<?php

namespace Murdercode\LaravelShortcodePlus\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortcodeImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    /*
    If you have JSON fields, uncomment and put them here

    protected $casts = [
        'field_name' => 'array',
    ];
    */
}
