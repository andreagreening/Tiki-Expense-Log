<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Team;

use Log;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function transactions()
    {
      return $this->hasMany('Transaction');
    }

    public function categories()
    {
      return $this->hasMany('Category');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team', 'teams_users');
    }

    public function team()
    {
        return $this->hasOne('Team');
    }

   public function invites()
   {
        return $this->hasMany('Invite');
   }

   public function isOnTeam($teamId){
    $team = Team::find($teamId);
    if(!$team) return false;
    if($team->users->isEmpty()) return false;
    $isOnTeam = $team->users->contains($this->id);

    return $isOnTeam;

   }

   public function isDemo()
   {
      return $this->demo;

   }

   public function isAdmin()
   {
      return $this->admin;
   }

   /**
    *   Delete User
    */
   public function deleteUserAndAllData()
   {
        //  TODO: Delete Team, Account, Cats, Transactions, user_account, etc
        //  Log::info('Deleting User ID: ' . $this->id);
        // $this->account->delete()
        // $this->transactions()->delete()

        $this->categories()->delete();
        $this->transactions()->delete();
        $this->team->users()->detach($this->id);
        $this->team()->delete();
        $this->delete();

        Log::info('Deleting User ID: ' . $this->id);
   }
   /**
    *       Delete Demo Accounts Older than X
    */
   public static function deleteDemoAccounts($hours = 2)
   {
        $time = Carbon::now()->subHours($hours)->format('Y-m-d H:i:s');
        $users = User::where('created_at', '<=', $time)
            ->where('demo', 1)->get();
        if($users->isEmpty()) return;
        Log::debug('Deleting ' .$users->count() . ' Demo user accounts that are older than  ' . $hours . ' hours');
        foreach($users as $user){
            $user->deleteUserAndAllData();
        }
        return;
   }


}
