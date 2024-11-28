<?php
namespace App\Service;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService{
    public function createUser($data){
        try{
            $user = User::create($data);
            return $user ;
        }catch(Exception){
            throw new Exception();
        }
    }
    public function showUserById(string $id){
        try{
            $user = User::findOrFail($id);
            return $user ;
        }catch(ModelNotFoundException){
            throw new ModelNotFoundException();
        }
    }
}
