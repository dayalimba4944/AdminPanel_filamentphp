<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $table = 'contact_infos';

    protected $fillable = [
        'onwn_name',
        'website_name',
        'website_logo',
        'phone_code',
        'phone_number',
        'email',
        'address',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'linkedin',
    ];

    protected $dates = ['deleted_at'];
}
