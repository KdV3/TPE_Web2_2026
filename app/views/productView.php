<?php

class ProductView {
    protected $user;

    public function setUser($user) {
        $this->user = $user;
    }

    public function renderShop($products, $categories, $vendors) {
        $count = count($products);
        require_once __DIR__ . '/templates/products.phtml';
    }

    public function renderCategory($products, $categories, $vendors) {
        $count = count($products);
        require_once __DIR__ . '/templates/products-category.phtml';
    }

    public function renderProduct($product, $categories, $vendors) {
        require_once __DIR__ . '/templates/product.phtml';
    }

    public function renderVendor($products, $categories, $vendor) {
        $count = count($products);
        require_once __DIR__ . '/templates/vendor.phtml';
    }
}