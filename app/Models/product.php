<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

   // protected $fillable = [
   //     'name',
   //     'description',
   //     'amount',
   //     'price',
   //     'user_id'
   // ];
   protected $guarded = [];

  

   public function user()
   {
        return $this->belongsTo(User::class);
   }

   public function categories()
   {
     return $this->belongsToMany('App\Models\Category', 'product_categories', 'product_id', 'category_id');
   }
}
