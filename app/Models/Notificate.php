<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Notificate extends Model
{
    protected $table = "notifications";

    protected $appends = ['message'];

    public function getMessageAttribute(){
        $type = $this->type;
        if($type == "new_contest_content"){
            return trans('app.'.$type);
        }elseif ($type == "new_member_join_contest"){
            return str_replace(":name", User::find($this->from_id)->name, trans('app.'.$type));
        }
    }
}