<?php

    class HomeController
    {
        public function index()
        {
            try 
            { 
                $retornaConteudoPostagem = Postagem::selecionaTodos();

                $loader = new \Twig\Loader\FilesystemLoader('app/View'); #carrega as Views;
                $twig = new \Twig\Environment($loader); #carrega o objeto $loader;
                $template = $twig->load('home.html');#carrega a View apontada que no caso é a home.html
                
                $parametros = array();
                $parametros['postagens'] = $retornaConteudoPostagem; #Passando os dados do banco para o paramentro especificado

                $conteudo = $template->render($parametros); #renderizar a view com os parametros
                echo $conteudo;
            } catch (Exception $e) {
                 echo $e->getMessage();
            }   
        }
    }
?>    
