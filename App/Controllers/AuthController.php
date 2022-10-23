<?php

namespace App\Controllers;

use Core\Database;
use Core\Request;
use Core\Session;
use App\Router;
use App\Models\User;

class AuthController {

    public function register(Request $request): void
    {
        $firstName = $request->get('firstName', null);
        $lastName = $request->get('lastName', null);
        $email = $request->get('email', null);
        $password = $request->get('password', null);
        $passwordConfirmation = $request->get('passwordConfirmation', null);

        try {
            $this->validateRegistration($email, $password, $passwordConfirmation);

            $userId = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => "{$firstName}_$lastName",
                'email' => $email,
                'password' => md5($password),
            ]);
            Session::login($userId);
        } finally {
            Router::redirect('/');
        }
    }

    public function login(Request $request): void
    {
        $email = $request->get('email', null);
        $password = $request->get('password', null);

        try {
            $user = $this->authenticate($email, $password);
            Session::login($user->id);
        } finally {
            Router::redirect('/');
        }
    }

    public function logout(): void
    {
        Session::logout();
        Router::redirect('/');
    }

    /**
     * @param $email
     * @param $password
     * @return User
     * @throws \Exception
     */
    private function authenticate($email, $password): ?User
    {
        $user = User::select([
            ['email', '=', $email],
            ['password', '=', md5($password)],
        ]);

        if (empty($user)) {
            throw new \Exception('User not found');
        }

        return $user[0];
    }

    private function validateRegistration(string $email, string $password, string $passwordConfirmation): void
    {
        $query = Database::getInstance()->prepare('SELECT EXISTS (SELECT * FROM users WHERE email = :email)');
        $query->execute(['email' => $email]);
        $emailIsTaken = array_values($query->fetch())[0] ?? true;

        if ($emailIsTaken) {
            throw new \Exception('Email is taken');
        }

        if ($password !== $passwordConfirmation) {
            throw new \Exception('Passwords don\'t match');
        }
    }
}