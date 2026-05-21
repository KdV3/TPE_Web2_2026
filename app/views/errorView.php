<?php

class ErrorView {
    protected $user;

    public function setUser($user) {
        $this->user = $user;
    }

    public function renderError($err = null) {
        require_once __DIR__ . '/templates/error.phtml';
    }

}