<?php
require_once 'app/Controller/HomeController.php';
// Padrão Singleton: impede que criamos várias instâncias de conexão sendo que precisamos apenas de uma.
class Postagem{
     //PDO: Faz a validação dos dados após enviar para o banco
    public static function selecionaTodos(){
       // $con = new PDO("mysql: host=localhost; dbname=site_postagens;", "root", "");
       // var_dump($con);
       // $res = Postagem:: selecionaTodos2();
       // var_dump($res);

       $con = Connection::getConn();
     
       $sql = "SELECT * FROM postagem ORDER BY id DESC";
       $sql = $con->prepare($sql);
       $sql->execute();

       $resultado = array();

       while($row = $sql->fetchObject('postagem')){
            $resultado[] = $row;
       }
      
       if(!$resultado){
       // echo("Não foi encontrado nenhum registro do banco");
       }

       return $resultado;

      

       //var_dump($sql->fetchAll());
       //  $con2 = Connection::getConn();

       // var_dump($con);
       //var_dump($con2);
   }

   public static function selecionaPorId($idPost){
   
     $con = Connection::getConn();

     $sql = "SELECT * FROM postagem WHERE id = :id";
     $sql = $con->prepare($sql);
     $sql->bindValue(":id", $idPost, PDO::PARAM_INT);
     $sql->execute();

     $resultado = $sql->fetchObject('Postagem');

     if(!$resultado){
          throw new Exception("Não foi encontrado nenhum registro do banco");
        }else{
            $resultado->comentarios = Comentario::selecionaComentarios($resultado->id);
            /*
            if(!$resultado->comentarios){
               $resultado->comentarios = "Não existe nenhum comentário para esta postagem!";
            }
            */
        }
 
  return $resultado;
 

   }


   public static function insert($dadosPost){

     // var_dump($_POST);

   if(empty($dadosPost['titulo']) OR empty($dadosPost['conteudo'])){
      //throw new Exception("Preencha todos os campos");
      echo ("Preencha todos os campos");
      return false;
  }

  $con = Connection::getConn();
  
  $sql = $con->prepare('INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)');
  $sql->bindValue(':tit', $dadosPost['titulo']);
  $sql->bindValue(':cont', $dadosPost['conteudo']);
  $res = $sql->execute();
  
 // var_dump($sql);

  if($res == 0){
     throw new Exception("Falha ao inserir publicação!");

     return false;

  }

  return true;

}

public static function update($params){
    
  $con = Connection::getConn();

  $sql = "UPDATE postagem SET titulo = :tit, conteudo= :cont WHERE id = :id ";
  $sql = $con->prepare($sql);
  $sql->bindValue(':tit', $params['titulo']);
  $sql->bindValue(':cont', $params['conteudo']);
  $sql->bindValue(':id', $params['id']);
  $resultado = $sql->execute();

  if($resultado == 0){
    throw new Exception("Falha ao alterar publicação!");
    return false;
  }
 
  return true;

}

   /*
   public static function selecionaTodos2(){
    $con = new PDO("mysql: host=localhost; dbname=site_postagens;", "root", "");
     var_dump($con);  
}
*/

public static function delete($id){

  $con = Connection::getConn();

  $sql = "DELETE FROM postagem WHERE id = :id";
  $sql = $con->prepare($sql);
  $sql->bindValue(':id', $id);
  $resultado = $sql->execute();

  if($resultado == 0){
    throw new Exception("Falha ao excluir publicação!");
    return false;
  }
 
  return true;

    
}

}

?>