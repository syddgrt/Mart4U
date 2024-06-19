<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) { 
            $query->where('stock_name', 'like', '%' . request('search') . '%') 
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
    protected $primaryKey = 'stock_id'; // Set Primary Key
    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // To create relationship with user. 
    }
}
