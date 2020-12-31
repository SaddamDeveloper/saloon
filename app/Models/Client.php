<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
class Client extends Authenticatable
{
    protected $table ='clients';
    protected $fillable = [
        'name','mobile','email','otp','work_experience','state','city','address','pin','image','gst','latitude','longitude','opening_time','closing_time','clientType','status','password','profile_status','api_token','service_city_id','job_status','address_proof','address_proof_file','photo_proof','photo_proof_file','business_proof','business_proof_file','verify_status'
    ];
    protected $hidden = ['password'];


    public function images()
    {
        return $this->hasMany('App\Models\ClientImage','client_id','id');
    }

    public function jobs()
    {
        return $this->hasMany('App\Models\Job','user_id','id');
    }

    public function serviceCity()
    {
        return $this->belongsTo('App\Models\ServiceCity','service_city_id','id');
    }

    public function clientSchedules()
    {
        return $this->hasMany('App\Models\ClientSchedule','user_id','id')->whereDate('date','>=' ,Carbon::now());
    }

    public function review()
    {
        return $this->hasMany('App\Models\Review','client_id','id');
    }
}
