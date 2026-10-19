<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Jenssegers\Agent\Agent;

class Session extends Model
{
    protected $table='sessions';
   public $incrementing=false;
    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload','last_activity'

    ];

    protected $hidden=['payload'];
    protected $appends=['Is_This_device'];

      public function getIsThisdeviceAttribute(): bool{
        return $this->id == request()->session()->getId();
    }
    public function getLastActivityAttribute($value):string {
       return Carbon::createFromTimestamp($value)->diffForHumans();

    }

     public function getUserAgentAttribute($value):array {
$agent = new Agent();
$agent->setUserAgent($value);

return [
    'platform'=>$agent->platform(),
    'browser'=>$agent->browser(),
                'is_desktop' => $agent->isDesktop()



];
    }

  




    //
}
