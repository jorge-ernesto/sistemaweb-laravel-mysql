<?php

namespace App\Traits;

trait UserTrait
{    
    public function havePermission($perm){        
        //echo "<script>console.log('" . json_encode($this->roles) . "')</script>";
        foreach($this->roles as $key=>$role){
            if($role['full-access'] == 'yes'){
                return true;
            }
                          
            //echo "<script>console.log('" . json_encode($role->permissions) . "')</script>";
            foreach($role->permissions as $key=>$permiso){
                if($permiso->slug == $perm){
                    return true;
                }
            }
        }

        return false;
    }
}