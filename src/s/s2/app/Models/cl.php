<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cl extends Model
{
    use HasFactory;
    protected $fillable = ['uid'];

//     public function user()
// {
//     return $this->belongTo(User::class,'uid');
// }
}
