<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    
	/**
	* 返回表名，不用处理单数复数
	*/

	public function getTable(){
	    return $this->table ? $this->table : strtolower(class_basename($this));
	}
}
