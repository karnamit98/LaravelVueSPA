<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'user_id',
        'firstname',
        'mainname',
        'price',
        'pageslength'
    ];

    /**
     * Each Products belongs to a user(admin) who added it
     */
    public function user()
    {
        return $this->belongsTo( User::class);
    }
}
