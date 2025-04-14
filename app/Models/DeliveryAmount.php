<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAmount extends Model
{
    protected $fillable = [
        'weight',
        'price',
    ];

    public static function getPrice(int $weight)
    {
        switch ($weight) {
            case 1:
                return self::find(1)->price;
            case 2:
                return self::find(2)->price;
            case 3:
                return self::find(3)->price;
            case 4 :
            case 5:
                return self::find(4)->price;
            case 6 :
            case 7 :
            case 8 :
            case 9 :
            case 10:
                return self::find(5)->price;
            case 11 :
            case 12 :
            case 13 :
            case 14 :
            case 15:
                return self::find(6)->price;
            case 16 :
            case 17 :
            case 18 :
            case 19 :
            case 20:
                return self::find(7)->price;
            default:
                return self::find(8)->price;
        }
    }
}
