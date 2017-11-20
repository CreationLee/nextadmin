<?php
namespace App\Traits;


trait AdminUser
{


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

    }
}