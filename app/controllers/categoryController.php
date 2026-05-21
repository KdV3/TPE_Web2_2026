<?php
require_once __DIR__ . '/../models/categoryModel.php';
require_once __DIR__ . '/../views/categoryView.php';
require_once __DIR__ . '/../views/errorView.php';

class CategoryController {
    private $model;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new CategoryModel();
        $this->view = new CategoryView();
        $this->errorView = new ErrorView();
    }

    public function showCategory($req) {
        if (
            !isset($_POST['idCategory']) || empty($_POST['idCategory'])){
            return $this->errorView->renderError("Error al mostrar la categoria");
        }

       $id = $_POST["idCategory"];
       $products = $this->model->getProductsByCategory($id);
       $categories = $this->model->getAllCategories();
       $vendors = $this->model->getAllVendors();
       
       $this->view->setUser($req->user);
        $this->view->renderCategory($products, $categories, $vendors);
    }

     public function addCategory($req){
        if (
            !isset($_POST['name']) || empty($_POST['name']) ) 
            {
            return $this->errorView->renderError("Por favor, complete todos los campos.");
            }

        $name = $_POST['name'];

        $id = $this->model->insertCategory($name);

        if (empty($id)) {
            return $this->errorView->renderError("Error al agregar la categoria. Intente nuevamente.");
        }
        
        header("Location: " . BASE_URL );    
    }

    public function editCategory($req) {    
         if (
            !isset($_POST['name']) || empty($_POST['name']) ||
            !isset($_POST['idCategory']) || empty($_POST['idCategory']) 
        ) {
            return $this->errorView->renderError("Por favor, complete todos los campos.");
        }

        $name = $_POST['name'];
        $id_category = $_POST['idCategory'];

        $this->model->editCategory($name, $id_category);
        
        header("Location: " . BASE_URL );        
    }
    
     public function deleteCategory($req) {
        if (
            !isset($_POST['idCategory']) || empty($_POST['idCategory'])
        ) {
            return $this->errorView->renderError("No existe la categoria con ese ID.");
        }

        $idCat = $_POST['idCategory'];
        $prods = $this->model->getProductsByCategory($idCat);

        if ($prods){
            return $this->errorView->renderError("Error: La categoria contiene productos.");
        } else {
            $this->model->deleteCategory($idCat);
        }

        header("Location: " . BASE_URL );
    }
}