

# RESTful API para controle de contatos (chamados de users) e mensagens


Ao baixar o projeto, é necessário instalar as dependências composer, configurar o banco de dados e executar as migrations para gerar a estrutura no banco de dados.

## Configuração das rotas
Configuração realizada no arquivo /routes/api.php
### Rotas e funções de contatos
- GET api/user: retorna a lista de contatos.
- POST api/user: cadastra um novo contato.
- PUT api/user/{id}: altera um contato que possui o id indicado.
- DELETE api/user/{id}: remove um contato que possui o id indicado.

### Rotas e funções de mensagens
- GET api/message/{user_id}: retorna as mensagens de um contato que possui o id indicado.
- POST api/message: cadastra uma nova mensagem.
- PUT api/message/{id}: altera uma mensagem que possui o id indicado.
- DELETE api/message/{id}: remove uma mensagem que possui o id indicado.



## Estrutura
Foi utilizado o padrão de MVC + Repository.
### Contatos
- Controller: UserController
- Comunicação direta com: App\Repositories\UserRepositoryEloquent (que implementa a interface App\Repositories\Contracts\UserRepositoryInterface)
- Repository se comunica com o model App\User

### Mensagens
- Controller: MessageController
- Comunicação direta com: App\Repositories\MessageRepositoryEloquent (que implementa a interface App\Repositories\Contracts\MessageRepositoryInterface)
- Repository se comunica com o model App\Message

## Validação
Validação de dados utilizando o helper validator()