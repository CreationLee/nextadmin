<?php
namespace App\Traits;

<<<<<<< HEAD
=======

>>>>>>> 45ef0167b8612174e00cd4c57dae797c0e0729ac
trait AdminUser
{


<<<<<<< HEAD
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
=======
    public function hasPermission($name)
    {
      if(!$this->relationLoaded('role' ))
      {
          $this->load( 'role' );
      }

      if(!$this->role->relationLoaded('permission')) {
            $this->role->load('permission');
      }

      return in_array($name, $this->role->pluck('key')->toArray());

>>>>>>> 45ef0167b8612174e00cd4c57dae797c0e0729ac
    }
}