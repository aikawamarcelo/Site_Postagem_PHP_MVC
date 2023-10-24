<?php
require_once("app/Model/Postagem.php");
require_once 'lib/Database/Conexao.php';
// pag 5
// Teste var_dump: http://localhost/xampp/Site_MVC_PHP/?pagina=home
class HomeController{
  
    public function index(){

       // echo "Teste";
       try{

        $colectPostagens = Postagem::selecionaTodos();

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html');

        $parametros = array();
       // $parametros['nome'] = 'Marcelo';
       $parametros['postagens'] = $colectPostagens;
       $conteudo = $template->render($parametros);
        echo($conteudo);

      
       // var_dump($colectPostagens);

        }catch (Exception $ex){
              echo ("Não foi encontrado nenhum registro do banco");
             }

     //  var_dump($colectPostagens);
    
    } 
  
}



?>