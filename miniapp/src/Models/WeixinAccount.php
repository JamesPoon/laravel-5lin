<?php

namespace Weixin\App\Models;

use Illuminate\Database\Eloquent\Model;

class WeixinAccount extends Model
{
    protected $table = "wx_account";
    protected $primaryKey = 'appid';
    protected $keyType = 'varchar';

    public function users() {
        return $this->hasMany(WeixinUser::class, "appid");
    }
}
