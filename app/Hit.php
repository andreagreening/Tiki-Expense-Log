<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Hit extends Model
{
    public static function log(){
    	//	Ignore admin
    	$ip = Request::ip();
    	// if($ip == '47.35.110.40') return; UNCOMMENT LATER
    	$hit = New Hit;
    	$hit->ip = $ip;
    	$hit->user_agent = implode(Request::header()['user-agent']);
    	$hit->page = Request::url();
    	$hit->save();
    }
}
