<?php

/*

Core: vai fazer a leitura do que o usuário está acessando e irá carregar o controller que irá exibir a página em questão
//Teste do controller: http://localhost/xampp/Site_MVC_PHP/?pagina=sobre 
*/ 


 class Core{
   // pag 4
   public function Start($urlGet){
        
      //$pagina = ucfirst($urlGet['pagina']. 'Controller');

      //echo($pagina);

      if (isset($urlGet['metodo'])){
          $acao = $urlGet['metodo'];
       }else{
          $acao = 'index';
       }

     
     
      if (isset($urlGet['pagina'])){
         $controller = ucfirst($urlGet['pagina'].'Controller');
       
        }else{

           $controller = 'HomeController';
         
        }

          if (!class_exists($controller)){
              $controller = 'ErroController';
          }

          if(isset($urlGet['id']) && $urlGet['id'] != null ){
         
            $id= $urlGet['id'];
          }else{
            $id = null;
          }

         // var_dump($urlGet);

     // echo($controller);

          //call_user_func_array(array(new $controller, $acao), array('id'=> $urlGet['id']) ?? null;
          
          call_user_func_array(array(new $controller, $acao), array( $id ));
          
          /*  call_user_func_array = chama métodos e funções de forma dinâmica */
  }

}


?>