<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-^12.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel Version">
  <img src="https://img.shields.io/badge/License-Restricted-red?style=for-the-badge" alt="License">
</p>

<br><br>

# Visita Aí - Controle de Visitas Epidemiológicas

Sistema acadêmico desenvolvido para a gestão de visitas epidemiológicas, utilizando o framework Laravel.

> **Desenvolvedor:** Bernardo Vivian Vieira  
> **Disciplina:** Laboratório de Engenharia de Software — UPF (2025/1)

---

## ⚠️ Requisitos

Para rodar este projeto, você precisará de:

- **PHP 8.2+**
- **Composer** (gerenciador de pacotes PHP)
- **Node.js** e **NPM** (para compilar os assets frontend)
- **Banco de dados MySQL** ou equivalente
- **Servidor Web** (Apache, Nginx ou `php artisan serve`)

> ⚡ Pode ser necessário habilitar algumas extensões do PHP para funcionamento correto.

---

## 🛠️ Instalação

Clone o repositório e acesse a pasta:

```bash
git clone https://github.com/bernardovvieira/visita-ai.git
cd visita-ai
```
Instale as dependências do PHP:
```bash
composer install
```
Instale as dependências do Node.js:
```bash
npm install
```
Compile os assets frontend:
```bash
npm run build
```
Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, especialmente as de banco de dados:
```bash
cp .env.example .env
```
Gere a chave de aplicação:
```bash
php artisan key:generate
```
Crie o banco de dados e execute as migrações:
```bash
php artisan migrate
php artisan db:seed
```
Inicie o servidor embutido do Laravel:
```bash
php artisan serve
```
Acesse o sistema pelo navegador em `http://localhost:8000`.

---

## 🫱🏽‍🫲🏼 Contribuição
A contribuição para este projeto é restrita. Se você deseja colaborar, entre em contato com o autor.

---

## 📃 Licença
Este projeto é restrito e não está disponível para uso público. Todos os direitos reservados ao autor. Confire a licença para mais detalhes.

---

## 📱 Contato
Para mais informações, entre em contato: 
> Bernardo Vivian Vieira
> E-mail: 179835@upf.br
> Linkedin: www.linkedin.com/in/bernardovivianvieira