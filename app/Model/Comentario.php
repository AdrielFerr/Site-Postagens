<?php

    class Comentario 
    {
        public static function selecionarComentarios($idPost)
        {
            $con = Connection::getConn();

            $sql = "SELECT * FROM comentario Where id_postagem = :id 
            ORDER BY id desc";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id',$idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('Comentario')) {
                $resultado[] = $row;
            }

            return $resultado;
        }
    }
    

?>