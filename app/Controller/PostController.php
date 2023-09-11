<?php
    class PostController
    {
        public function index($params)
        {
            try 
            {
                $postagem = Postagem::selecionarPorId($params);
                 
                $loader = new \Twig\Loader\FilesystemLoader('app/View'); #carrega as Views;
                $twig = new \Twig\Environment($loader); #carrega o objeto $loader;
                $template = $twig->load('single.html');#carrega a View apontada que no caso é a single.html
                
                $parametros = array();
                $parametros['titulo'] = $postagem->titulo; #Passando os dados do banco para o paramentro especificado
                $parametros['conteudo'] = $postagem->conteudo;
                $parametros['comentarios'] = $postagem->comentarios;
                
                $conteudo = $template->render($parametros); #renderizar a view com os parametros
                
                echo $conteudo;
            } catch (Exception $e) {
                 echo $e->getMessage();
            }   
        }
    }
?>