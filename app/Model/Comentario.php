<?php

class Comentario{

  public static function selecionaComentarios($idPost){
     
     $con = Connection::getConn();

     $sql = "SELECT * FROM comentario WHERE id_postagem = :id";
     $sql = $con->prepare($sql);
     $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
     $sql->execute();

     $resultado = array();

     while($row = $sql->fetchObject('Comentario')){

        $resultado[] = $row;

     }

     return $resultado;

  }

  public static function inserir($reqPost){

   
  $con = Connection::getConn();
  
  $sql = $con->prepare('INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nome, :msg, :id)');
  $sql->bindValue(':nome', $reqPost['nome']);
  $sql->bindValue(':msg', $reqPost['msg']);
  $sql->bindValue(':id', $reqPost['id']);
  $res = $sql->execute();
  
 // var_dump($sql);

  if($sql->rowCount()){
     return true;
   }

   throw new Exception("Falha na inserção!");

}
  

}

?>