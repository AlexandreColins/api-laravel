<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# API Laravel - Documentação Profissional

## Visão Geral

API RESTful desenvolvida em Laravel, seguindo padrões profissionais de arquitetura, autenticação, documentação e testes automatizados. Ideal para projetos escaláveis e de fácil manutenção.

---

## Requisitos
- **PHP:** 8.1 ou superior
- **Composer:** 2.x
- **SQLite** (ou outro banco suportado pelo Laravel)
- **Node.js/NPM** (opcional, para assets)

---

## Instalação e Setup

1. **Clone o repositório:**
   ```sh
   git clone git@github.com:AlexandreColins/api-laravel.git
   cd api-laravel
   ```

2. **Instale as dependências PHP:**
   ```sh
   composer install
   ```

3. **Configure o ambiente:**
   ```sh
   cp .env.example .env
   # Edite o .env conforme necessário (DB_CONNECTION=sqlite recomendado para testes)
   ```

4. **Gere a chave da aplicação:**
   ```sh
   php artisan key:generate
   ```

5. **Rode as migrations e seeders:**
   ```sh
   php artisan migrate:fresh --seed
   ```
   Isso criará as tabelas e populará o banco com usuários e posts de exemplo.

---

## Autenticação (Laravel Sanctum)
- Registre um usuário via `/api/register` ou utilize um usuário criado pelo seeder.
- Faça login em `/api/login` para obter um token de acesso.
- Envie o token no header das requisições protegidas:
  ```
  Authorization: Bearer SEU_TOKEN
  ```

---

## Documentação Swagger
- Acesse: [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)
- Clique em **Authorize** e insira: `Bearer SEU_TOKEN`
- Teste todos os endpoints diretamente pela interface web.

---

## Testes Automatizados
- Execute todos os testes com:
  ```sh
  php artisan test
  ```
- Testes cobrem autenticação, criação e listagem de posts.

---

## Estrutura e Boas Práticas
- **Service/Repository Pattern:** Separação clara entre regras de negócio e acesso a dados.
- **API Resources:** Respostas padronizadas usando `App\Http\Resources\PostResource`.
- **Form Requests:** Validação centralizada.
- **Políticas:** Controle de acesso com `PostPolicy`.
- **Swagger/OpenAPI:** Todos os endpoints documentados.
- **Seeders:** Banco populado automaticamente para testes.
- **PSR-4:** Estrutura de namespaces e arquivos compatível com autoload do Composer.

---

## Dicas Rápidas
- Para resetar o banco: `php artisan migrate:fresh --seed`
- Sempre envie o token como `Bearer ...` no header Authorization.
- Para criar novos endpoints, siga o padrão de anotações Swagger já presente nos controllers.
- Para rodar localmente: `php artisan serve`

---

## Contato
Dúvidas ou sugestões? Abra uma issue ou entre em contato pelo GitHub.

---

Projeto pronto para produção, fácil de evoluir e com setup rápido!
