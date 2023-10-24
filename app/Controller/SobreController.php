<?php
//teste id: http://localhost/xampp/Site_MVC_PHP/?pagina=post?id=3
class SobreController{
  
    public function index($params){

       // var_dump($params);

       // echo "Teste";
  


       
      

        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('sobre.html');
      
        $parametros = array();
       
        $conteudo = $template->render($parametros);
        echo($conteudo);

     
    
  
}


}
?>