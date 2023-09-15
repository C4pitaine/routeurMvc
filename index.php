<!--MVC => model,view,controller-->
<!-- router -->
<!-- router => controller => model => controller => view-->
<?php
    require "controller/frontend.php"; // on appelle le controller
    try{
        if(isset($_GET['action']))
        {
            // sélection des pages
            if($_GET['action'] == 'listPost')
            {
                listPost(); 
            }elseif($_GET['action'] == 'post'){
                if(isset($_GET['id']) && $_GET['id'] >0 )
                {
                    post($_GET['id']);
                }else{
                    throw new Exception('Aucun identifiant de billet envoyé'); // crée une exception qui génèrera une erreur avec comme paramètre notre message
                }
            }elseif($_GET['action'] == 'addComment')
            {
                if(isset($_GET['id']))
                {
                    if(isset($_POST['author']))
                    {
                        $err = 0;
                        if(empty($_POST['author']))
                        {
                            $err = 1;
                        }
                        if(empty($_POST['comment']))
                        {
                            $err = 2;
                        }
                        if($err==0)
                        {
                            newComment($_GET['id'],$_POST['author'],$_POST['comment']);
                        }else{
                            throw new Exception('Formulaire mal rempli');
                        }
                    }else{
                        throw new Exception('Pas d\'envois de formulaire');
                    }
                }else{
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            }
        }else{
            // page home
            listPost();
        }
    }catch(Exception $e){ // on type $e en objet de type Exception
        $errorMessage = $e->getMessage();
        echo $errorMessage;
    }
    
?>