<?php

namespace App\Models;

//-------- Custom Email ----------------------------//
use App\Notifications\CustomVerifyEmailNotification;
use App\Notifications\CustomResetPassword;
//--------------------------------------------------//
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role == 1;
    }

    public function isUser()
    {
        return $this->role == 0;
    }

    public function isActive()
    {
        return $this->status == 1;
    }

    public function sendEmailVerificationNotification()
    {
        $url = $this->verificationUrl();
        $this->notify(new CustomVerifyEmailNotification($url));
    }

    protected function verificationUrl()
    {
        return \URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $this->getKey(), 'hash' => sha1($this->getEmailForVerification())]
        );
    }

    public function getNameAttribute()
    {
        return $this->full_name;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
}
