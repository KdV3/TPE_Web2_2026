<?php
require_once __DIR__ . '/../models/usersModel.php';
require_once __DIR__ . '/../views/authView.php';
require_once __DIR__ . '/../views/errorView.php';

class AuthController {
    private $view;
    
    public function __construct() {
        $this->model = new UsersModel();
        $this->view = new AuthView();
        $this->errorView = new ErrorView();
    }
    
    public function showLoginForm($req){
        $this->view->showLoginForm();
    }

    public function showRegisterForm($req){
        $this->view->showRegisterForm();
    }

    public function login($req){
        if(empty($_POST["email"]) || empty($_POST["password"]))
            return $this->view->showLoginForm();

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->model->getByEmail($email);

        if(!$user) {
            return $this->errorView->renderError("Usuario o contraseña incorrecta");
        }

        if(!password_verify($password, ($user->contrasenia))) {
            return $this->errorView->renderError("Usuario o contraseña incorrecta");
        }

        $_SESSION["id"] = $user->id_vendedor;
        $_SESSION["email"] = $user->email;

        header("Location: ". BASE_URL);
    }

    public function register($req){
        if (
            ($this->model->getByEmail($_POST["email"]))|| 
            !isset($_POST['name']) || empty($_POST['name']) ||
            !isset($_POST['email']) || empty($_POST['email']) ||
            !isset($_POST['adress']) || empty($_POST['adress']) ||
            !isset($_POST['phoneNumber']) || empty($_POST['phoneNumber']) ||
            !isset($_POST['information']) || empty($_POST['information'])||
            !isset($_POST['password']) || empty($_POST['password'])
            ) {
            return $this->errorView->renderError("Cuenta ya creada con esa direccion de correo");
        }

        $name = $_POST["name"];
        $email = $_POST["email"];
        $adress = $_POST["adress"];
        $phoneNumber = $_POST["phoneNumber"];
        $information = $_POST["information"];
        $logo = null;
 
        $password =password_hash($_POST["password"], PASSWORD_BCRYPT);

        $id = $this->model->register($name,$email,$adress,$phoneNumber,$information,$logo,$password);

        if (empty($id)) {
            return $this->errorView->renderError("Error de registro.");
        }
        
        header("Location: " . BASE_URL );   
    }

    public function editProfile($req, $idProfile) {     
        if (
            !isset($_POST['name']) || empty($_POST['name']) ||
            !isset($_POST['email']) || empty($_POST['email']) ||
            !isset($_POST['adress']) || empty($_POST['adress']) ||
            !isset($_POST['phoneNumber']) || empty($_POST['phoneNumber']) ||
            !isset($_POST['info']) || empty($_POST['info'])
        ) {
            return $this->errorView->renderError("Por favor, complete todos los campos.");
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $adress = $_POST['adress'];
        $phoneNumber = $_POST['phoneNumber'];
        $info = $_POST['info'];

        $id = $this->model->editProfile($name, $email, $adress, $phoneNumber, $info, $idProfile);
        
        header("Location: " . BASE_URL );        
    }


    function logOut($req){
        session_destroy();
        header("Location: " . BASE_URL );
    }

}
