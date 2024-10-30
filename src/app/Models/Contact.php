<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail'
    ];

    // Categoriesモデルとの結合
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 検索機能（名前とメールアドレス）
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('last_name', 'like', '%' . $keyword . '%')->orWhere('first_name', 'like' , '%' . $keyword . '%')->orWhere('email', 'like' , '%' . $keyword . '%');
        }
    }
    // 検索機能（性別）
    public function scopeGenderSearch($query, $gender)
    {
        if(!empty($gender)) {
            if($gender === '男性') {
                $query->where('gender', 1);
            }else if($gender === '女性') {
                $query->where('gender', 2);
            }else if($gender === 'その他') {
                $query->where('gender', 3);
            }else if($gender === '全て') {
                $query->whereIn('gender', [1, 2, 3]);
            }
        }
    }
    // 検索機能（お問い合わせの種類）
    public function scopeCategoryIdSearch($query, $category_id)
    {
        if(!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    //検索機能（日付）
    public function scopeDateSearch($query, $date)
    {
        if(!empty($date)) {
            $query->where('created_at', 'like', '%'. $date . '%');
        }
    }
}
