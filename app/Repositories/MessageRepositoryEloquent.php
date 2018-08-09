<?php

namespace App\Repositories;

use App\Message;
use App\Repositories\Contracts\MessageRepositoryInterface;

class MessageRepositoryEloquent implements MessageRepositoryInterface
{
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function saveMessage($input)
    {
        $message = new Message();
        $message->fill($input);
        $message->save();

        return $message;
    }

    private function getMessage($id)
    {
        $message = $this->message->find($id);
        if (is_null($message)) {
            return false;
        }

        return $message;
    }

    public function getUserMessages($user_id)
    {
        $message = $this->message->where('user_id', $user_id)->get();
        if (is_null($message)) {
            return false;
        }

        return $message;
    }

    public function deleteMessage($id)
    {
        $message = $this->message->find($id);
        if (is_null($message)) {
            return false;
        }

        return $message->delete();
    }

    public function updateMessage($id, $input)
    {
        $message = $this->getMessage($id);
        if (!$message) {
            return false;
        }

        $message->fill($input);

        if ($message->save()) {
            return $message;
        }

        return false;
    }
}