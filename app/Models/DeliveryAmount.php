<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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


    public static function ensure($deliveryAmount): int
    {
        if ($deliveryAmount <= 4000000)
            return 4000;
        else if ($deliveryAmount <= 30000000)
            return ($deliveryAmount * 0.2) / 100;
        else if ($deliveryAmount <= 50000000)
            return ($deliveryAmount * 0.25) / 100;
        else if ($deliveryAmount <= 70000000)
            return ($deliveryAmount * 0.3) / 100;
        else if ($deliveryAmount <= 100000000)
            return ($deliveryAmount * 0.35) / 100;
        return 0;
    }

    public static function getOrderDeliveryAmount($request = null)
    {
        $item = null;
        $products = null;
        $province = '';
        $city = '';
        if ($request != null) {
            $item = Order::whereId($request['id'])->first();
            $products = $item->orderItems;
            $city = $item->address->city->name;
            $province = $item->address->city->province->name;
        } else {
            $item = Auth::user();
            $province = $item->address->city->province->name;
            $city = $item->address->city->name;
            $products = $item->buy_carts;
        }
        $bigCitiesPercentage = 0;
        $deliveryAmount = 0;
        $province_percentage = 0;
        switch ($city) {
            case 'تهران':
            case 'مشهد':
            case 'کرج':
            case 'یزد':
            case 'اصفهان':
            case 'شیراز':
                $bigCitiesPercentage = 15;
        }
        switch ($province) {
            case 'مازندران':
                $province_percentage = 0;
                break;
            case 'گلستان' :
            case 'سمنان':
            case 'تهران' :
            case 'البرز' :
            case 'قزوین' :
            case 'گیلان':
                $province_percentage = 40;
                break;
            default:
                $province_percentage = 60;
                break;
        }
        $productWeight = 0;
        foreach ($products as $product) {
            $productDeliveryAmount = self::getPrice($product->product_variation->weight);
            $productDeliveryAmount += ($productDeliveryAmount * $province_percentage) / 100;
            $productDeliveryAmount += ($productDeliveryAmount * $bigCitiesPercentage) / 100;
            $deliveryAmount += $productDeliveryAmount * $product->quantity;
            $productWeight += $product->product_variation->weight * $product->quantity;
        }
        $ensureAmount = self::ensure($deliveryAmount);
        $deliveryAmount += $ensureAmount;
        return [
            'deliveryAmount' => (int)$deliveryAmount,
            'finalWeight' => $productWeight,
            'ensureAmount' => (int)$ensureAmount,
            'bigCityPercentage' => $bigCitiesPercentage,
        ];
    }
}
