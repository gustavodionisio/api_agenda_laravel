<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\MessageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class MessageController extends BaseController
{
    protected $message = null;

    public function __construct(MessageRepositoryInterface $message, Request $request)
    {
        $this->message = $message;
        $this->request = $request;
    }

    public function getUserMessages($user_id)
    {
        $messages = $this->message->getUserMessages($user_id);
        if (!$messages) {
            $response = Response::create(['response' => 'Este usuário não possui mensagens!'], Response::HTTP_NOT_FOUND);
        } else {
            $response = Response::create($messages, Response::HTTP_OK);
        }

        return $response;
    }

    public function saveMessage()
    {
        $inputs = $this->request->post();
        $validation = validator($inputs, $this->message->message->rules, $this->message->message->messages);

        // falha na validação
        if ($validation->fails()) {
            $response = Response::create([
                'response' => 'Erro ao tentar alterar mensagem!',
                'errors' => $validation->errors()->getMessages()
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $message = $this->message->saveMessage($inputs);

            // falha  ao realizar update da mensagem
            if (!$message) {
                $response = Response::create(['response' => 'Erro ao tentar alterar mensagem!'], Response::HTTP_NOT_FOUND);
            } else {
                $response = Response::create($message, Response::HTTP_OK);
            }
        }

        return $response;
    }

    public function updateMessage($id)
    {
        $inputs = $this->request->only('descricao');
        $validation = validator($inputs, $this->message->message->rules, $this->message->message->messages);

        // falha na validação
        if ($validation->fails()) {
            $response = Response::create([
                'response' => 'Erro ao tentar alterar mensagem!',
                'errors' => $validation->errors()->getMessages()
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $message = $this->message->updateMessage($id, $inputs);

            // falha  ao realizar update da mensagem
            if (!$message) {
                $response = Response::create(['response' => 'Erro ao tentar alterar mensagem!'], Response::HTTP_NOT_FOUND);
            } else {
                $response = Response::create($message, Response::HTTP_OK);
            }
        }

        return $response;
    }

    public function deleteMessage($id)
    {
        $message = $this->message->deleteMessage($id);
        if (!$message) {
            return Response::create(['response' => 'Erro ao tentar remover mensagem!'], Response::HTTP_NOT_FOUND);
        }

        return Response::create(['response' => 'Mensagem removida com sucesso!'], Response::HTTP_OK);
    }

}
