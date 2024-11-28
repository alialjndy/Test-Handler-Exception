<?php
namespace App\Service;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthService{
    public function register($data){
        try{
            $user = User::create($data);
            return $user ;
        }catch(Exception $e){
            throw new ModelNotFoundException();
        }
    }
}
