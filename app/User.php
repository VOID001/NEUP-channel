<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    protected $fillable = ['cookie_id', 'first_login_ip', 'last_login_ip', 'ban_level', 'admin_flag'];

    public function refreshUserCookie()
    {

    }

    public function banUser()
    {

    }

    public function unbanUser()
    {

    }
}
