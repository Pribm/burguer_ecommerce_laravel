<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSettings extends Model
{
    use HasFactory;

    protected $table = 'website_settings';

    protected $fillable = [
        "site_name",
        "email_address",
        "slogan",
        "footer_message",
        "facebook_address",
        "instagram_address",
        "twitter_address",
        "whatsapp_number",
        "horizontal_logo",
        "vertical_logo",
        "favicon",
    ];

    protected $guarded = ['id'];
}
