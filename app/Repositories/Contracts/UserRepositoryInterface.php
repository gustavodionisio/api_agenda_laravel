<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface {
    public function allUsers();
    public function saveUser($input);
    public function getUser($id);
    public function deleteUser($id);
    public function updateUser($id, $input);
}