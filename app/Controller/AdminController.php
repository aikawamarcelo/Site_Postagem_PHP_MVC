<?php
//teste id: http://localhost/xampp/Site_MVC_PHP/?pagina=post?id=3
class AdminController{
  
    public function index($params){

       // var_dump($params);

       // echo "Teste"; 

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin.html');
      
        $objPostagens = Postagem::selecionaTodos();

        $parametros = array();
        
        $parametros['postagens'] = $objPostagens;  
        
        $conteudo = $template->render($parametros);
        
        echo($conteudo);

    }

    public function create(){
       // echo '123';
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');
      
        $parametros = array();
        
       
        $conteudo = $template->render($parametros);
        echo($conteudo);

    }

    public function insert(){
       try{  
       Postagem::insert($_POST);
       
       echo '<script>alert("Publicação inserida com sucesso!");</script>';
       echo '<script>location.href="http://localhost/xampp/Site_MVC_PHP/?pagina=admin&metodo=index"</script>';
        }catch(Exception $ex){
           echo '<script>alert("'.$ex->getMessage().'");</script>';
           echo '<script>location.href="http://localhost/xampp/Site_MVC_PHP/?pagina=admin&metodo=create"</script>';

        }
    }

    public function change($paramId){
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');
      
        $post = Postagem::selecionaPorId($paramId);

        $parametros = array();
        $parametros['id'] = $post->id;
        $parametros['titulo'] = $post->titulo;
        $parametros['conteudo'] = $post->conteudo;
       
        $conteudo = $template->render($parametros);
        echo($conteudo);

    }

    public function update(){
        try{
            Postagem::update($_POST);
            echo '<script>alert("Publicação alterada com sucesso!");</script>';
            echo '<script>location.href="http://localhost/xampp/Site_MVC_PHP/?pagina=admin&metodo=index"</script>';
             }catch(Exception $ex){
                echo '<script>alert("Falha ao alterar publicação!");</script>';
                echo '<script>location.href="http://localhost/xampp/Site_MVC_PHP/?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
     
             }
        
    }

    public function delete($id){
        try{
        Postagem::delete($id);
        echo '<script>alert("Publicação excluída com sucesso!");</script>';
        echo '<script>location.href="http://localhost/xampp/Site_MVC_PHP/?pagina=admin&metodo=index"</script>';
        
        }catch(Exception $ex){
            echo '<script>alert("Falha ao excluir publicação!");</script>';
            echo '<script>location.href="http://localhost/xampp/Site_MVC_PHP/?pagina=admin&metodo=index"</script>';
 
         }
    }

}
?>