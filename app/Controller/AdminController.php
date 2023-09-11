<?php
    class AdminController
    {
        public function index()
        {       
            $loader = new \Twig\Loader\FilesystemLoader('app/View'); #carrega as Views;
            $twig = new \Twig\Environment($loader); #carrega o objeto $loader;
            $template = $twig->load('admin.html');#carrega a View apontada que no caso é a sobre.html
            
            $objPostagens = Postagem::selecionaTodos();

            $parametros = array();
            $parametros['postagens'] = $objPostagens;

            $conteudo = $template->render($parametros); #renderizar a view com os parametros
            echo $conteudo;  
        }

        public function create()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View'); #carrega as Views;
            $twig = new \Twig\Environment($loader); #carrega o objeto $loader;
            $template = $twig->load('create.html');#carrega a View apontada que no caso é a create.html
            
            $parametros = array();

            $conteudo = $template->render($parametros); #renderizar a view com os parametros
            echo $conteudo;
        }

        public function insert()
        {
            try 
            {
                Postagem::insert($_POST);

                echo '<script>alert("Publicação inserida com sucesso!");</script>';
                echo '<script>location.href="http://localhost/SITE/index.php/?pagina=admin&metodo=index";</script>';
            } 
            catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/SITE/index.php/?pagina=admin&metodo=create";</script>';
            }
        }

        public function change($paramId)
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View'); #carrega as Views;
            $twig = new \Twig\Environment($loader); #carrega o objeto $loader;
            $template = $twig->load('update.html');#carrega a View apontada que no caso é a update.html

            $post = Postagem::selecionarPorId($paramId);

            $parametros = array();
            $parametros['id'] =  $post->id;
            $parametros['titulo'] =  $post->titulo;
            $parametros['conteudo'] = $post->conteudo;

            $conteudo = $template->render($parametros); #renderizar a view com os parametros
            echo $conteudo;
        }

        public function update()
        {
            try 
            {
                Postagem::update($_POST);
                echo '<script>alert("Publicação alterada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/SITE/index.php/?pagina=admin&metodo=index";</script>';
            } 
            catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/SITE/index.php/?pagina=admin&metodo=change&id='.$_POST['id'].'";</script>';
            }
        }

        public function delete()
        {
            try 
            {
                // var_dump($_GET);
                Postagem::delete($_GET);
                echo '<script>alert("Publicação deletada com sucesso!");</script>';
                 echo '<script>location.href="http://localhost/SITE/index.php/?pagina=admin&metodo=index";</script>';
            } 
            catch (Exception $e) {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/SITE/index.php/?pagina=admin&metodo=change&id='.$_POST['id'].'";</script>';
            }
        }
    }
?>