<?php

namespace App\Controllers;

class Posts extends \App\Libraries\Controller{

    public function __construct(){
        $this->postModel = $this->model("Post");
    }

    public function index($page = 1){

        $total_posts = $this->postModel->countPosts();

        $total_pages = get_total_pages($total_posts->contagem);

        $current_start_index = get_current_start_index($page);

        if($page >= 1 && $page <= $total_pages){

            $posts = [];

            if($posts = $this->postModel->getPostsPaged($current_start_index)){

                $data = [

                    "total" => $total_pages,
                    "posts" => $posts,
                    "page" => $page,
                    "total_pages" => $total_pages,

                ];

                $this->view("posts/index", $data);

            }else{
                //var_dump("404");
                die(500);
            }

        }else{

            //var_dump("404");
            die(404);

        }

    }

    public function register(){

        if(loggedUserIsAdmin()){

            if($_SERVER["REQUEST_METHOD"] == "POST"){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "titulo" => trim($_POST["titulo"]),
                    "descricao" => trim($_POST["descricao"]),
                    "id_usuario" => $_SESSION["id_usr"],
                    "titulo_err" => "",
                    "descricao_err" => "",
                ];

                if(empty($data["titulo"])){
                    $data["titulo_err"] = "Favor inserir um título válido";
                }

                if(empty($data["descricao"])){
                    $data["descricao_err"] = "Favor inserir uma postagem válida";
                }

                if(empty($data["descricao_err"]) && empty($data["titulo_err"])){

                    if($this->postModel->register($data)){

                        redirect("posts/index");

                    }else{

                        die("An error during insertion has happened");

                    }

                }else{

                    $this->view("posts/register", $data);

                }

                

            }else{

                $data = [

                ];

                $this->view("posts/register", $data);

            }

        }else{
            redirect("users/login");
        }

    }

    public function edit($id){

        if(loggedUserIsAdmin()){

            $currentPost = null;

            $id = filter_var($id, FILTER_SANITIZE_STRING);
            
            if($currentPost = $this->postModel->getPostById($id)){
                if($_SERVER["REQUEST_METHOD"] == "POST"){

                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    $data = [
                        "id_post" => $id,
                        "titulo" => trim($_POST["titulo"]),
                        "descricao" => trim($_POST["descricao"]),
                        "titulo_err" => "",
                        "descricao_err" => "",
                    ];

                    if(empty($data["titulo"])){
                        $data["titulo_err"] = "Favor inserir um título válido";
                    }

                    if(empty($data["descricao"])){
                        $data["descricao_err"] = "Favor inserir uma postagem válida";
                    }

                    if(empty($data["titulo_err"] && empty($data["descricao_err"]))){

                        //var_dump($data);
                        if($this->postModel->updatePost($data)){

                            //TODO: FLASH MESSAGE

                            redirect("posts/index");

                        }else{

                            die("Error while updating post");

                        }

                    }else{

                        $this->view("posts/edit", $data);
                    
                    }

                }else{

                    $data = [

                        "id_post" => $id,
                        "titulo" => $currentPost->titulo,
                        "descricao" => $currentPost->descricao,


                    ];

                    $this->view("posts/edit", $data);

                }
            }
        }else{
            redirect("posts/index", []);
        }

    }

    public function delete($id){

        if(loggedUserIsAdmin()){
            //echo "Req.:" . $id;

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                

                $id = filter_var($id, FILTER_SANITIZE_STRING);
                
                if($this->postModel->deletePost($id)){

                    redirect("posts/index");

                }else{

                    die("An error occurred");

                }


            }

        }

    }

    public function show($id){
        
        $id = filter_var($id, FILTER_SANITIZE_STRING);

        $post = $this->postModel->getPostById($id);

        $data = [
            "post" => $post,
        ];

        $this->view("posts/show", $data);

    }

    //TODO: INTEGRATE WYSIWYG

}



?>