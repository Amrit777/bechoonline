<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    //protected $table="sub_domains";

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function theme()
    {
        return $this->belongsTo('App\Models\Template', 'template_id', 'id');
    }

    protected $fillable = [
        'domain',
        'full_domain',
        'status',
        'user_id',
        'template_id ',
        'shop_type',
        'created_at',
        'updated_at',
        'domain_purchased_from',
        'domain_username',
        'domain_password',
        'custom_domain'
    ];
}
