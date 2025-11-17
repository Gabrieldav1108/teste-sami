# CRUD de Pessoas - Laravel

Este é um projeto elaborado como desafio técnico em Laravel que consiste o desenvolvimento de um CRUD (Create, Read, Update, Delete) de pessoas.

---

## 📝 Visão Geral do Projeto

O projeto possui a funcionalidade de gerenciar registros de pessoas com os seguintes campos:

- **nome**: Nome completo da pessoa
- **cpf**: CPF (Cadastro de Pessoa Física)
- **data_nascimento**: Data de nascimento
- **email**: E-mail
- **telefone**: Telefone

O sistema inclui:

- Validações de dados no backend
- Mensagens de erro personalizadas
- Interface simples para criação, edição, listagem e exclusão de pessoas

---

## ⚙️ Como Rodar o Projeto

O projeto foi configurado para rodar usando **Laravel Herd**, que já inclui PHP e Composer.  
link para instalação do Laravel Herd -> https://herd.laravel.com/

### Passo a Passo:

1. **Clone o repositório dentro da pasta Herd(que será criada na instalação do Laravel Herd):**

git clone https://github.com/Gabrieldav1108/teste-sami   
cd teste-sami

2. **Instale as dependências:**

composer install

3. **Configure o arquivo de ambiente:**

cp .env.example .env  
    --Em seguida, abra o arquivo .env e configure as informações do banco de dados (MySQL).

4. **Rode as migrations:**

php artisan migrate

5. **Crie a chave:**

php artisan key:generate

6. **Inicie o servidor usando Laravel Herd:**

Abra o Laravel Herd

Acesse a seguinte url no navegador: http://crud-pessoas.test/  
Ou dentro do laravel herd vá na sessão "sites" e clice na aba "URL"

## 🔗 Rotas da Aplicação

| Método | Rota                   | Descrição                     |
|--------|------------------------|--------------------------------|
| GET    | `/`                    | Página inicial / Boas-vindas  |
| GET    | `/people`             | Lista todas as pessoas         |
| GET    | `/people/create`      | Formulário de criação          |
| POST   | `/people`             | Salva uma nova pessoa          |
| GET    | `/people/{id}/edit`   | Formulário de edição           |
| PUT    | `/people/{id}`        | Atualiza uma pessoa            |
| DELETE | `/people/{id}`        | Remove uma pessoa              |

