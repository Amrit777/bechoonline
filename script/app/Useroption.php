<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useroption extends Model
{
    // amit singh
    public function taxValue()
    {
        $user_id = domain_info('user_id');
        $tax = Useroption::where('user_id', $user_id)->where('key', 'tax')->first();
        return !empty($tax) ? $tax : 0;
    }
    public function gstinValue()
    {
        $user_id = domain_info('user_id');
        $gstin = Useroption::where('user_id', $user_id)->where('key', 'gstin')->first();
        return !empty($gstin) ? $gstin : "";
    }
    public function min_delivery_amtValue()
    {
        $user_id = domain_info('user_id');
        $min_delivery_amt = Useroption::where('user_id', $user_id)->where('key', 'min_delivery_amt')->first();
        return !empty($min_delivery_amt) ? $min_delivery_amt : 0;
    }
}
