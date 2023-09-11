<?php

    class Core
    {
        public function start($urlGet)
        {
            if (isset($urlGet['metodo'])) {
                $acao = $urlGet['metodo'];
            } else {
                $acao = 'index'; 
            }

            if (isset($urlGet['pagina'])) {
                $controller = ucfirst($urlGet['pagina'].'Controller');
            } else {
                $controller = 'HomeController'; #caso a $urlGet não seja 'pagina'!
            }

            if (!class_exists($controller)) { 
                $controller = 'ErroController';
            }

            if (isset($urlGet['id']) && $urlGet['id'] != null) {
                $id = $urlGet['id'];
            } else {
                $id = null;
            }
            
            #Chama a classe e o metodo de forma dinâmica! 
            call_user_func_array(array(new $controller, $acao), array($id));
        }
    }