<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class uploadedfile extends Model
{
    //
	protected $table = 'uploadedfile';
	 protected $fillable = [
    	'filetype','originalname','extension','realpath','size','memetype','savedestination','savedname',
        
    ];
}
