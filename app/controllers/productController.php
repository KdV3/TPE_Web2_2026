<?php
require_once __DIR__ . '/../models/productModel.php';
require_once __DIR__ . '/../views/productView.php';
require_once __DIR__ . '/../views/errorView.php';

class ProductController {
    private $model;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new ProductModel();
        $this->view = new ProductView();
        $this->errorView = new ErrorView();
    }

    public function showAll($req) {
       $products = $this->model->getAllProducts();
       $categories = $this->model->getAllCategories();
       $vendors = $this->model->getAllVendors();
       
       $this->view->setUser($req->user);
       $this->view->renderShop($products, $categories, $vendors);
    }

    public function showProduct($req,$id) {
       $product = $this->model->getProduct($id);
       $categories = $this->model->getAllCategories();
       $vendors = $this->model->getAllVendors();
       
       $this->view->setUser($req->user);
       $this->view->renderProduct($product, $categories, $vendors);
    }

    public function showVendor($req, $vend) {
       $products = $this->model->getProductsByVendor($vend);
       $categories = $this->model->getAllCategories();
       $vendor = $this->model->getVendorByName($vend);

       
       $this->view->setUser($req->user);
       $this->view->renderVendor($products, $categories, $vendor);
    }

    public function addProduct($req) {    
        if (
            !isset($_POST['name']) || empty($_POST['name']) ||
            !isset($_POST['description']) || empty($_POST['description']) ||
            !isset($_POST['category']) || empty($_POST['category']) ||
            !isset($_POST['price']) || empty($_POST['price']) ||
            !isset($_POST['discount']) || !isset($_POST['img'])
        ) {
            return $this->errorView->renderError("Por favor, complete todos los campos.");
        }

        $name = $_POST['name'];
        $description = $_POST['description'];
        $id_category = $_POST['category'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $productOwner = $_SESSION["id"];
        $imgProd = $_POST['img'];

        $id = $this->model->insertProduct($name, $description, $id_category, $price, $discount, $productOwner, $imgProd);

        if (empty($id)) {
            return $this->errorView->renderError("Error al agregar el producto. Intente nuevamente.");
        }
        
        header("Location: " . BASE_URL );        
    }

    public function editProduct($req, $idProd) {    
         if (
            !isset($_POST['name']) || empty($_POST['name']) ||
            !isset($_POST['description']) || empty($_POST['description']) ||
            !isset($_POST['category']) || empty($_POST['category']) ||
            !isset($_POST['price']) || empty($_POST['price']) ||
            !isset($_POST['discount'])
        ) {
            return $this->errorView->renderError("Por favor, complete todos los campos.");
        }

        $name = $_POST['name'];
        $description = $_POST['description'];
        $id_category = $_POST['category'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];

        $id = $this->model->editProduct($name, $description, $id_category, $price, $discount, $idProd);
        
        header("Location: " . BASE_URL );        
    }

    public function deleteProduct($req,$idProd) {

        $prod = $this->model->getProduct($idProd);

        if (!$prod) {
            return $this->errorView->renderError("No existe el producto");
        }

        $this->model->deleteProduct($idProd);

        header("Location: " . BASE_URL );
    }


}