<?php

namespace App\Controllers;



class Users extends \App\Libraries\Controller{


    public function __construct(){

        $this->userModel = $this->model("User");
    }

    public function index($page = 1){

        //$itens_per_page = 5; //MAKE CONST

        //$total_users = $this->userModel->countUsers();

        //$total_pages = ceil($total_users / $itens_per_page);

        //$current_start_index = ((($page - 1) * $itens_per_page) + 1); //Table index of first user of current page

        //var_dump($this->userModel->countUsers());

        if(loggedUserIsAdmin()){

            $total_users = $this->userModel->countUsers();

            $total_pages = get_total_pages($total_users->contagem);

            $current_start_index = get_current_start_index($page);//((($page - 1) * ITENS_PER_PAGE) + 1); //Table index of first user of current page


            if($page >= 1 && $page <= $total_pages){

                $users = [];

                if($users = $this->userModel->getUsersPaged($current_start_index)){

                    $data = [
                        "total" => $total_users,
                        "users" => $users,
                        "page" => $page,
                        "total_pages" => $total_pages,
                    ];
    
                    //TODO: ENHANCE PAGE
                    $this->view("users/index", $data);
                    //die($total_users);

                }else{

                    die(500);
                
                }


            }else{

                //TODO: 404
                throw_error_404();
                //die("404");

            }

        }else{
            redirect("pages/index");
        }
        //var_dump($this->userModel->getAllUsers());
    }

    public function login(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "email_usr" => trim($_POST["email_usr"]),
                "senha_usr" => trim($_POST["senha_usr"])
            ];

            $logged_in_user = $this->userModel->login($data);

            if($logged_in_user){

                $this->createUserSession($logged_in_user);

                

                redirect("users/profile");

            }else{

                //TODO: FLASH

                $this->view("users/login", []);

            }

        } else {


            $this->view("users/login", []);
        }
    }

    public function createUserSession($user){

        $_SESSION["id_usr"] = $user->idUsuario;
        $_SESSION["nome_usr"] = $user->nome;
        $_SESSION["email_usr"] = $user->email;
        $_SESSION["is_admin_usr"] = $user->is_admin;


    }

    public function updateUserSession($id){

        $user = $this->userModel->getUserById($id);

        $this->createUserSession($user);

    }

    public function logout(){

        if(userIsLoggedIn()){ //Only destroys if user is currently logged
            $this->destroyUserSession();
        }
        
        redirect("users/login");


    }

    public function destroyUserSession(){

        unset($_SESSION["id_usr"]);
        unset($_SESSION["nome_usr"]);
        unset($_SESSION["email_usr"]);
        unset($_SESSION["is_admin_usr"]);


    }

    public function profile(){

        if(userIsLoggedIn()){

            $this->view("users/profile", []);
        }else{
            redirect('users/login');
        }
    }

    public function register(){

        //TODO: IF USER IS LOGGED

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //var_dump(["POST REGISTER DATA", $_POST]);//TESTE

            $data = [
                "nome_usr" => trim($_POST["nome_usr"]),
                "data_nasc_usr" => trim($_POST["data_nasc_usr"]),
                "email_usr" => trim($_POST["email_usr"]),
                "senha_usr" => trim($_POST["senha_usr"]),
                "conf_senha_usr" => trim($_POST["conf_senha_usr"]),
                "nome_err" => "",
                "data_nasc_err" => "",
                "email_err" => "",
                "senha_err" => "",
                "conf_senha_err" => ""
            ];

            if (empty($data["nome_usr"])) {

                $data["nome_err"] = "Insira um nome válido para cadastro.";
            }

            if (empty($data["data_nasc_usr"])) {

                $data["data_nasc_err"] = "Data de nascimento inválida.";
            }

            if (empty($data["email_usr"])) {

                $data["email_err"] = "Insira um email válido para cadastro.";
            }else if($this->userModel->emailExists($data["email_usr"])){
                
                $data["email_err"] = "Email já cadastrado.";
            } 
            

            if (strlen($data["senha_usr"]) < 6) {

                $data["senha_err"] = "Senha inválida. Favor inserir uma senha com 6 ou mais caracteres.";
            }

            if (strcmp($data["conf_senha_usr"], $data["senha_usr"]) != 0) {
                $data["conf_senha_err"] = "Senha e confirmação não correspondem.";
            }

            if (empty($data["nome_err"]) && empty($data["data_nasc_err"]) && empty($data["email_err"]) && empty($data["senha_err"]) && empty($data["conf_senha_err"])) {


                $data["senha_usr"] = password_hash($data["senha_usr"], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {

                    //$_SESSION["times_called"] = 0;

                    flash("user_created_msg", "Novo usuário registrado.");

                    //Updates user session before proceeding
                    
                    redirect('users/login');
                } else {

                    //TODO: 500???
                    die("Algum erro aconteceu! Manutenção reportada!");
                }
            } else {

                $this->view("users/register", $data);
            }
        } else {

            $data = [];

            $this->view("users/register", $data);
        }
    }

    public function edit($id){
        //$id = 1;

        if($_SESSION["id_usr"] == $id){
            //Each user can only edit itself
            //Already guaranteed that user exists
            $currentUser = $this->userModel->getUserById($id);

            if($_SERVER["REQUEST_METHOD"] == "POST"){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "id_usr" => filter_var($id, FILTER_SANITIZE_STRING),
                    "nome_usr" => trim($_POST["nome_usr"]),
                    "data_nasc_usr" => trim($_POST["data_nasc_usr"]),
                    "email_usr" => trim($_POST["email_usr"]),
                    "senha_usr" => trim($_POST["senha_usr"]),
                    "nome_err" => "",
                    "data_nasc_err" => "",
                    "email_err" => "",
                    "senha_err" => "",
                ];

                if (empty($data["nome_usr"])) {

                    $data["nome_err"] = "Insira um nome válido para cadastro.";
                }
    
                if (empty($data["data_nasc_usr"])) {
    
                    $data["data_nasc_err"] = "Data de nascimento inválida.";
                }
    
                if (empty($data["email_usr"])) {
    
                    $data["email_err"] = "Insira um email válido para cadastro.";
                }else if(($this->userModel->emailExists($data["email_usr"])) && !$this->userModel->isUserEmail($data["email_usr"], $data["id_usr"])){
                    
                    $data["email_err"] = "Email já cadastrado.";
                }

                if (strlen($data["senha_usr"]) < 6) {

                    $data["senha_err"] = "Senha inválida. Favor inserir uma senha com 6 ou mais caracteres.";
                }

                if (empty($data["nome_err"]) && empty($data["data_nasc_err"]) && empty($data["email_err"]) && empty($data["senha_err"]) && empty($data["conf_senha_err"])) {

                    $data["senha_usr"] = password_hash($data["senha_usr"], PASSWORD_DEFAULT);
                    
                    if($this->userModel->updateUser($data)){

                        $this->updateUserSession($data["id_usr"]);

                        redirect("users/profile");

                        //var_dump($data);
                    }else{

                        //TODO: 500
                        die("Algum erro aconteceu! Manutenção reportada!");
                    }
                
                }else{

                    $this->view("users/edit", $data);

                }    

            }else{

                $data = [
                    "id_usr" => $currentUser->idUsuario,
                    "nome_usr" => $currentUser->nome,
                    "email_usr" => $currentUser->email,
                    "data_nasc_usr" => $currentUser->dataNasc,
                ];

                $this->view("users/edit", $data);
                
            }

        }else{

            redirect("pages/index");
        
        }

    }

    public function delete($id){

        if(loggedUserIsAdmin()){

            //Check existence then delete
            if($this->userModel->getUserById($id)){
                $this->userModel->delete($id);

                redirect('users/index');
            }else{

                die("Erro de recurso");
            }

        }else{

            die("Erro de permissão");
        
        }

    }
    

}
