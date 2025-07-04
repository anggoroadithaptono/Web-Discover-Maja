<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['nama', 'email', 'password'];

    public $timestamps = false;

    // Cek apakah email sudah ada
    public static function emailExists($email)
    {
        return DB::table('users')->where('email', $email)->exists();
    }

    // Validasi kombinasi email dan password
    public static function validateCredentials($email, $password)
    {
        $user = DB::table('users')->where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }
}
