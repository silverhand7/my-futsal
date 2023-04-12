<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function getFullNameAttribute()
    {
        return ucwords($this->name);
    }

    public function watchNotifications()
    {
        return DB::table('nova_notifications')
            ->where('notifiable_type', 'App\Models\Customer')
            ->where('notifiable_id', $this->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function watchNewNotifications()
    {
        return DB::table('nova_notifications')
            ->where('notifiable_type', 'App\Models\Customer')
            ->where('notifiable_id', $this->id)
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function readNotifications()
    {
        return DB::table('nova_notifications')
            ->where('notifiable_type', 'App\Models\Customer')
            ->where('notifiable_id', $this->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => date('Y-m-d H:i:s')
            ]);
    }
}
