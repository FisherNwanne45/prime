<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = ['id'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // Provide default values for all the user attributes your views use
        return $this->belongsTo(User::class)->withDefault([
            'first_name' => 'Deleted',
            'last_name' => 'User',
            'full_name' => 'Deleted User',
        ]);
    }
}