<?php

namespace App\Repositories\Contracts;

interface MessageRepositoryInterface {
    public function saveMessage($input);
    public function getUserMessages($user_id);
    public function deleteMessage($id);
    public function updateMessage($id, $input);
}