<?php
namespace App\Traits;

trait AdminUser
{


    //检测管理员权限
    public function hasPermission($name)
    {
        //加载user表与role表的关系
        if(!$this->relationLoaded('role')){
            $this->load('role');
        }

        //使用加载来的role对象查找permission
        if($this->role->relationLoaded('permissions')) {
            $this->role->load('permissions');
        }

        return in_array($name, $this->role->permissions->pluck('key')->toAray());
    }
}