<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Wallet;

class Deposit extends Model
{
    use HasFactory;
    
    public $fillable = ['amount', 'wallet_id', 'txnref', 'user_id'];
    
    public function user(){
        $this->belongsTo(User::class);
    }

    public function wallet(){
        $this->belongsTo(Wallet::class);
    }

    protected static function boot() {
	    parent::boot();

	    static::saved(function ($deposit) {
           Wallet::find($deposit->wallet_id)->increment('amount', $deposit->amount);
	    });
	}
}
