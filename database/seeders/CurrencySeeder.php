<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cron = Currency::create([
            'name' => 'کرون نروژ',
            'icon' => 'norway.png',
            'price' => 32000,
            'abbr' => 'NOK'
        ]);

        Country::create([
            'name' => 'نروژ',
            'currency_id' => $cron->id
        ]);
        
        $cron2 = Currency::create([
            'name' => 'کرون سوئد',
            'icon' => 'swedan.png',
            'price' => 32000,
            'abbr' => 'SEK'
        ]);

        Country::create([
            'name' => 'سوئد',
            'currency_id' => $cron2->id
        ]);

        $cron3 = Currency::create([
            'name' => 'کرون دانمارک',
            'icon' => 'danmark.png',
            'price' => 32000,
            'abbr' => 'DKK'
        ]);

        Country::create([
            'name' => 'دانمارک',
            'currency_id' => $cron3->id
        ]);
        
        $dollar = Currency::create([
            'name' => 'دلار',
            'icon' => 'caneda.png',
            'price' => 38000,
            'abbr' => 'CAD'
        ]);
        
        Country::create([
            'name' => 'کانادا',
            'currency_id' => $dollar->id
        ]);
        
        $pond = Currency::create([
            'name' => 'پوند',
            'icon' => 'england.png',
            'price' => 38000,
            'abbr' => 'GBP'
        ]);

        Country::create([
            'name' => 'انگلیس',
            'currency_id' => $pond->id
        ]);

        $euro = Currency::create([
            'name' => 'یورو',
            'icon' => 'euro.png',
            'price' => 38000,
            'abbr' => 'EURO'
        ]);

        Country::create([
            'name' => 'آلمان',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'اتریش',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'اسپانیا',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'استونی',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'اسلوواکی',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'اسلوونی',
            'currency_id' => $euro->id
        ]);

        Country::create([
            'name' => 'ایتالیا',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'ایرلند',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'بلژیک',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'پرتغال',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'فرانسه',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'فنلاند',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'قبرس',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'مالت',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'لوگزامبورگ',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'هلند',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'یونان',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'لیتوانی',
            'currency_id' => $euro->id
        ]);

        Country::create([
            'name' => 'لتونی',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'کرواسی',
            'currency_id' => $euro->id
        ]);
        
        Country::create([
            'name' => 'سایر',
            'currency_id' => $euro->id
        ]);
        
    }
}
