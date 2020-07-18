<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\KramerInComming;

class Customer extends Model
{
    protected $guarded = []; // すべてのプロパティを設定可能にするため,[]の空の配列を設定

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function customerLogs()
    {
        return $this->hasMany(CustomerLog::class);
    }

    protected $dispatchesEvents = [
        'created' => KramerInComming::class,
    ];
}
