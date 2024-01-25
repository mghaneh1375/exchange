<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyDigest extends JsonResource
{
    
    private static $avgPrices;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $price = 0;
        if(self::$avgPrices != null) {
            foreach(self::$avgPrices as $currency) {
                if($currency['currency'] == $this->abbr) {
                    $price = number_format(round($this->price + $currency['average_price']));
                    break;
                }
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'abbr' => $this->abbr,
            'price' => $price,
            'countries' => CountryDigest::collection($this->countries)->toArray($request)
        ];
    }

    
    public static function customCollection($resource, $avgPrices): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        self::$avgPrices = $avgPrices;
        return parent::collection($resource);
    }
}
