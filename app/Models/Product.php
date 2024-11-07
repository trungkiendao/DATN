<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
     // Tên bảng trong database
     protected $table = 'products';

     // Các cột có thể được gán giá trị hàng loạt
     protected $fillable = ['id', 'name', 'image','price','description'];
 
     // Nếu bảng có timestamps, bạn có thể bỏ qua phần này
     public $timestamps = true;
}
