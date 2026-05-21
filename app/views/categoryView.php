<?php

class CategoryView {
    protected $user;

    public function setUser($user) {
        $this->user = $user;
    }

    public function renderCategory($products, $categories, $vendors) {
        $count = count($products);
        require_once __DIR__ . '/templates/products-category.phtml';
    }
}