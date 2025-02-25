<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class Category extends Model
{
    use HasFactory;
    public function scopeOnlyParent($query) {
    return $query->whereNull('parent_id');
    }
        
    
    public function children()
    {
        return $this->hasMany(self::class,'parent_id');
    }
    public function descendants() {
        return $this->children()->with('descendants');
        
    }
}
