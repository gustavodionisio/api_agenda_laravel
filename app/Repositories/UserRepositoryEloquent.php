<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;

class UserRepositoryEloquent implements UserRepositoryInterface {
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function allUsers()
    {
        return $this->user->all();
    }

    public function saveUser($input)
    {
        $user = new User();
        $user->fill($input);
        $user->save();

        return $user;
    }

    public function getUser($id)
    {
        $user = $this->user->find($id);
        if(is_null($user)){
            return false;
        }

        return $user;
    }

    public function deleteUser($id)
    {
        $user = $this->user->find($id);
        if(is_null($user)){
            return false;
        }

        return $user->delete();
    }

    public function updateUser($id, $input)
    {
//        dd($input);
        $user = $this->getUser($id);
        if(!$user){
            return false;
        }

        $user->fill($input);

        if($user->save()){
            return $user;
        }

        return false;
    }
}