<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

class Anggota extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'anggota';

    protected $fillable = [

        'anggota_id',
        'nama',
        'gender',
        'hubungan',
        'pekerjan',
        'status',
        'keluarga_id',
        'alamat1',
        'alamat2',
        'email',
        'telpon_rumah',
        'telpon_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'tempat_baptis',
        'tanggal_baptis',
        'tempat_sidi',
        'tanggal_sidi',
        'tempat_nikah',
        'tanggal_nikah',
        'gereja_asal',
        'gereja_terdaftar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
