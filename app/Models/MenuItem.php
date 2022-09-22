<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public function childrenNested()
    {
        return $this->hasMany(MenuItem::class,'parent_id','id')->whereNull('parent_id');
    }

    public function children()
    {
        return $this->childrenNested()->with('children');
    }

}
