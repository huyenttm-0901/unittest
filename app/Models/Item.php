<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
    	'name',
    	'quantity',
    	'description',
    	'user_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
