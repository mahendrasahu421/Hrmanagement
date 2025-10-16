<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // App\Models\Role.php
    public function menus()
    {
        return $this->belongsToMany(\App\Models\Menu::class, 'role_menu', 'role_id', 'menu_id')
            ->withPivot('can_view', 'can_edit')
            ->withTimestamps();
    }

}
