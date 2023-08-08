<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // protected $table = 'product_categories';

    protected $guarded = [];

    //public function product_categories()
   // {
    //    return $this->belongsToMany(product_category::class)->withPivot();
    //}
    public function getCategories() {
        $product = Product::find(1);
        $categories = $product->categories; // Returns a Laravel Collection
        foreach($categories as $category) {
          // Do what you want with $category
          $category->pivot->updated_at;
        }
      }
}
