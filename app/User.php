<?php

namespace App;

use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;
use App\Notifications\EmployerResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'level', 'verified_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verified()
    {
        return $this->verified_token === null;
    }

    public function sendVerificationEmail()
    {
        $this->notify(new VerifyEmail($this));
    }

    public function sendResetPasswordEmail()
    {
        $this->notify(new ResetPassword($this));
    }

    public function sendEmployerResetPasswordEmail()
    {
        $this->notify(new EmployerResetPassword($this));
    }
}
