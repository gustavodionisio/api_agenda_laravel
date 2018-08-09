<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['nome', 'sobrenome', 'telefone', 'email'];

    public $rules = [
        'nome' => ['sometimes', 'required', 'min:2', 'max:100'],
        'sobrenome' => ['sometimes', 'required', 'min:2', 'max:100'],
        'telefone' => ['sometimes', 'required', 'regex:/^\(\d{2}\)\d{4,5}-\d{4}$/'],
        'email' => ['sometimes', 'required', 'email', 'unique:users']
    ];

    public $messages = [
        'nome.required' => 'O campo :attribute é obrigatório!',
        'nome.min' => 'O campo :attribute precisa conter pelo menos 2 caracteres!',
        'nome.max' => 'O campo :attribute não pode conter mais que 100 caracteres!',
        'sobrenome.required' => 'O campo :attribute é obrigatório!',
        'sobrenome.min' => 'O campo :attribute precisa conter pelo menos 2 caracteres!',
        'sobrenome.max' => 'O campo :attribute não pode conter mais que 100 caracteres!',
        'telefone.required' => 'O campo :attribute é obrigatório!',
        'telefone.regex' => 'O campo :attribute precisa estar em um dos seguintes formatos: (xx)xxxxx-xxxx ou (xx)xxxx-xxxx !',
        'email.required' => 'O campo :attribute é obrigatório!',
        'email.email' => 'O campo :attribute precisa estar no formato de um e-mail!',
        'email.unique' => 'O endereço de e-mail submetido já foi cadastrado por outro usuário!'
    ];


}
