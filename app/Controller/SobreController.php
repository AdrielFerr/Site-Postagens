<?php
    class SobreController
    {
        public function index()
        {       
            $loader = new \Twig\Loader\FilesystemLoader('app/View'); #carrega as Views;
            $twig = new \Twig\Environment($loader); #carrega o objeto $loader;
            $template = $twig->load('sobre.html');#carrega a View apontada que no caso é a sobre.html
            
            $parametros = array();

            $conteudo = $template->render($parametros); #renderizar a view com os parametros
            echo $conteudo;  
        }
    }
?>