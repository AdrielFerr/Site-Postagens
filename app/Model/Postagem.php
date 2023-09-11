<?php

    class Postagem
    {
        public static function selecionaTodos()
        {
            $con = Connection::getConn(); 
            
            $sql = "SELECT * FROM postagem ORDER BY id DESC";
            $sql = $con->prepare($sql);
            $sql->execute();
            
            $resultado = array();

            while ($row = $sql->fetchObject('Postagem')) {
                $resultado[] = $row;
            }        
            
            if (!$resultado) {
                throw new Exception("Não foi encontrado nenhum registro no banco de dados!");
            }

            return $resultado;
        }

        public static function selecionarPorId($idPost)
        {
            $con = Connection::getConn();

            $sql = "SELECT * FROM postagem WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetchObject('Postagem');

            if (!$resultado) {
                throw new Exception("Não foi encontrado nenhum registro no banco de dados!");
            }
            else {
                $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
            }

            return $resultado;
        }

        public static function insert($dadosPost)
        {
            if (empty($dadosPost['titulo']) OR empty($dadosPost['conteudo']) ) {
                throw new Exception("Preencha todos os campos");
                return false;
            }
            $con = Connection::getConn();
            $sql = $con->prepare("INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)");
            $sql->bindValue(':tit',$dadosPost['titulo']);
            $sql->bindValue(':cont', $dadosPost['conteudo']);
            $result = $sql->execute();
            
            if ($result == 0) {
                throw new Exception("Falha ao publicar sua postagem");
                return false;
            }
            return true;
        }

        public static function update($dadosPost)
        {
            $con = Connection::getConn();
            $sql = $con->prepare("UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id = :id ");
            $sql->bindValue(':tit',$dadosPost['titulo']);
            $sql->bindValue(':cont', $dadosPost['conteudo']);
            $sql->bindValue(':id', $dadosPost['id']);
            $result = $sql->execute();

            if ($result == 0) {
                throw new Exception("Falha ao alterar sua postagem");
                return false;
            }
            return true;
        }

        public static function delete($params)
        {
            // var_dump($params['id']);
            $con = Connection::getConn();
            $sql = $con->prepare("DELETE FROM postagem WHERE id = :id");
            $sql->bindValue(':id', $params['id']);
            $result = $sql->execute();
            // var_dump($result);

            if (!$result) {
               throw new Exception("Falha ao tentar excluir sua postagem");
               return false;
            }
            return true;
        }
    }