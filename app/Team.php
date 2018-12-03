<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
// use Category;
// use Transaction;


class Team extends Model
{
    protected $fillable = ['user_id'];

    public function users()
    {
    	return $this->belongsToMany('User', 'teams_users');
    }

    public function invites()
    {
    	return $this->hasMany('Invite');
    }

    public function owner()
    {
    	return $this->belongsTo('User', 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany('Transaction');
    }

    public function categories()
    {
        return $this->hasMany('Category');
    }

    public function defaultTeam()
    {
        $defaultTeamId = Auth::user()->default_team_id;
        return $this->id == $defaultTeamId;
    }




}
