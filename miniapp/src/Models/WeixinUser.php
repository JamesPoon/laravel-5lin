<?php

namespace Weixin\App\Models;

use Illuminate\Database\Eloquent\Model;

class WeixinUser extends Model
{
    protected $table = "wx_user";
    protected $primaryKey = 'open_id';
    protected $keyType = 'varchar';

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }
    public function account() {
        return $this->belongsTo(WeixinAccount::class, "appid");
    }
}
