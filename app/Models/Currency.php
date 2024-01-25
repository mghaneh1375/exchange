<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {

    protected $fillable = [
        'name', 'price', 'icon', 'abbr'
    ];

    public $timestamps = false;
    protected $table = "currency";

    
    public function countries() {
        return $this->hasMany(Country::class);
    }

}

?>