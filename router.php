<?php
require_once __DIR__ . '/app/controllers/productController.php';
require_once __DIR__ . '/app/controllers/authController.php';
require_once __DIR__ . '/app/controllers/categoryController.php';

require_once __DIR__ . '/app/middlewares/sessionMiddleware.php';
require_once __DIR__ . '/app/middlewares/guardMiddleware.php';

session_start();

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// accion por default
$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

$req = new StdClass();
$req = (new SessionMiddleware())->run($req);

switch ($params[0]) {
    case 'home':   
        $controller = new ProductController();
        $controller->showAll($req);
    break;

    case "producto" :
        $controller = new ProductController();
        switch ($params[1]){

        case "addProduct":    
        $req = (new GuardMiddleware())->run($req);
        $controller->addProduct($req);
        break;

        case 'editProduct':
        $idProd = $params[2] ?? null;
        $req = (new GuardMiddleware())->run($req);
        $controller->editProduct($req,$idProd);
        break;

         case 'deleteProduct':
        $idProd = $params[2] ?? null;
        $req = (new GuardMiddleware())->run($req);
        $controller->deleteProduct($req,$idProd);
        break;

        default:
        $idProd = $params[1] ?? null;
        $controller->showProduct($req, $idProd);
        break;
        } 
    break;

    case "tienda" :
        $controller = new CategoryController();
        if (isset($params[1])){
            switch ($params[1]){

            case 'addCategory':
            $req = (new GuardMiddleware())->run($req);
            $controller->addCategory($req);
            break;

            case 'editCategory':
            $req = (new GuardMiddleware())->run($req);
            $controller->editCategory($req);
            break;

            case 'deleteCategory':
            $req = (new GuardMiddleware())->run($req);
            $controller->deleteCategory($req);
            break;

            default:
            echo '404 error';
            break;
            }  
        } else {
            $controller->showCategory($req);
        }
        
    break;

    case "vendedor" :
        $vend = $params[1] ?? null;
        $controller = new ProductController();
        $controller->showVendor($req, $vend);
    break;

    case 'editProfile':
        $idProfile = $params[1] ?? null;
        $req = (new GuardMiddleware())->run($req);
        $controller = new AuthController();
        $controller->editProfile($req,$idProfile);
    break;
    
    case 'login_form':
        $controller = new AuthController();
        $controller->showLoginForm($req);
    break;

    case 'login':
        $controller = new AuthController();
        $controller->login($req);
    break;

    case 'cerrar':
        $req = (new GuardMiddleware())->run($req);
        $controller = new AuthController();
        $controller->logOut($req);
    break;

    case 'registro_form':
        $controller = new AuthController();
        $controller->showRegisterForm($req);
    break;

    case 'registro':
        $controller = new AuthController();
        $controller->register($req);
    break;

    default:
        echo '404 error';
        break;
}

