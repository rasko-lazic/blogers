<?php

namespace App\Controllers;

use Core\Session;
use App\Router;
use App\Models\User;

class AuthController {

    /**
     * @throws \Exception
     */
    public function login(): void
    {
        // TODO auth here
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (is_null($email) || is_null($password)) {
            throw new \Exception("Missing data");
        }

        $user = $this->authenticate($email, $password);

        Session::login($user->id);
        Router::redirect('/');
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
}