<?php
//teste id: http://localhost/xampp/Site_MVC_PHP/?pagina=post?id=3
class PostController{
  
    public function index($params){

       // var_dump($params);

       // echo "Teste";
       try{

        $postagem = Postagem::selecionaPorId($params);
       
      //  var_dump($postagem);

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('single.html');
      //  var_dump($postagem);
        $parametros = array();
       // $parametros['nome'] = 'Marcelo';
       $parametros['id'] = $postagem->id;
       $parametros['titulo'] = $postagem->titulo;
       $parametros['conteudo'] = $postagem->conteudo;
       $parametros['comentarios'] = $postagem->comentarios;
       //var_dump($postagem);
       $conteudo = $template->render($parametros);
        echo($conteudo);

        
    } 
        catch (Exception $ex){
              echo $ex->getMessage();
             }

     //  var_dump($colectPostagens);
    
    
  
}

public function addComent(){

try{

  Comentario::inserir($_POST);

    header('Location: https://localhost/xampp/Site_MVC_PHP/?pagina=post&id='.$_POST['id']);
   }catch(Exception $ex){
    echo '<script>alert("Falha ao adicionar comentário!");</script>';
    echo '<script>location.href="https://localhost/xampp/Site_MVC_PHP/?pagina=post&id='.$_POST['id'].'"</script>';
}


//
}

}


?>