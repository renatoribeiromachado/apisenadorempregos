<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $table = "api_users_senador";
    protected $fillable = ['name','email', 'url','password','image'];
    
    public function getResults($data, $total)
    {
        if (!isset($data['filter']) && !isset($data['name']) && !isset($data['email']))
            return $this->paginate($total);

        return $this->where(function ($query) use ($data) {
                    if (isset($data['filter'])) {
                        $filter = $data['filter'];
                        $query->where('name', $filter);
                        $query->orWhere('email', 'LIKE', "%{$filter}%");
                    }

                    if (isset($data['name']))
                        $query->where('name', $data['name']);
                    
                    if (isset($data['email'])) {
                        $email = $data['email'];
                        $query->where('email', 'LIKE', "%{$email}%");
                    }
                })//->toSql();dd($results);
                ->paginate($total);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
