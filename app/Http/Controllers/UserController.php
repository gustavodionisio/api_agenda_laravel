<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    protected $user = null;

    public function __construct(UserRepositoryInterface $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    public function allUsers()
    {
        return Response::create($this->user->allUsers(), Response::HTTP_OK);
    }

    public function getUser($id)
    {
        $user = $this->user->getUser($id);

        if (!$user) {
            return Response::create(['response' => 'Usuário não encontrado!'], Response::HTTP_NOT_FOUND);
        }

        return Response::create($user, Response::HTTP_OK);
    }

    public function saveUser()
    {
        $inputs = $this->request->post();
        $validation = validator($inputs, $this->user->user->rules, $this->user->user->messages);

        // falha na validação
        if ($validation->fails()) {
            $response = Response::create([
                'response' => 'Erro ao tentar alterar usuário!',
                'errors' => $validation->errors()->getMessages()
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $user = $this->user->saveUser($inputs);

            // falha  ao realizar update do usuário
            if (!$user) {
                $response = Response::create(['response' => 'Erro ao tentar alterar usuário!'], Response::HTTP_NOT_FOUND);
            } else {
                $response = Response::create($user, Response::HTTP_OK);
            }
        }

        return $response;
    }

    public function updateUser($id)
    {
        $inputs = $this->request->post();
        $validation = validator($inputs, $this->user->user->rules, $this->user->user->messages);

        // falha na validação
        if ($validation->fails()) {
            $response = Response::create([
                'response' => 'Erro ao tentar alterar usuário!',
                'errors' => $validation->errors()->getMessages()
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $user = $this->user->updateUser($id, $inputs);

            // falha  ao realizar update do usuário
            if (!$user) {
                $response = Response::create(['response' => 'Erro ao tentar alterar usuário!'], Response::HTTP_NOT_FOUND);
            } else {
                $response = Response::create($user, Response::HTTP_OK);
            }
        }

        return $response;
    }

    public function deleteUser($id)
    {
        $user = $this->user->deleteUser($id);
        if (!$user) {
            return Response::create(['response' => 'Erro ao tentar remover usuário!'], Response::HTTP_NOT_FOUND);
        }

        return Response::create(['response' => 'Usuário removido com sucesso!'], Response::HTTP_OK);
    }

}
