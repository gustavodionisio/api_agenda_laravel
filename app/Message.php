<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['descricao', 'user_id'];

    public $rules = [
        'descricao' => ['required', 'max:100'],
        'user_id' => ['required', 'exists:users,id']
    ];

    public $messages = [
        'descricao.required' => 'O campo :attribute é obrigatório!',
        'descricao.max' => 'O campo :attribute não pode conter mais que 100 caracteres!',
        'user_id.required' => 'O campo de usuário é obrigatório!',
        'user_id.exists' => 'O usuário selecionado não existe!'
    ];

}
