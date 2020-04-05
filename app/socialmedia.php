<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class socialmedia extends Model
{
    //
	protected $table = 'socialmedia';
	 protected $fillable = [
    	'heading','web_link','video_link','image_link','service','result','result_data','owner',
        
    ];
}
