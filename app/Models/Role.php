<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Role extends BaseModel
{
    
    public function permissions()
	{
		return $this->belongsToMany(Permission::class);
	}

	public function givePermission(Permission $permission)
	{
		return $this->permissions()->save($permission);
	}
}
