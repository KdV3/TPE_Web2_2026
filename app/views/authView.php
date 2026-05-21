<?php

class AuthView {
    protected $user;

    public function setUser($user) {
        $this->user = $user;
    }

    public function showLoginForm() {
        require_once __DIR__ . '/templates/login_form.phtml';
    }

    public function showRegisterForm() {
        require_once __DIR__ . '/templates/register_form.phtml';
    }
}