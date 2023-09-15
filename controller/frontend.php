<?php
    require('model/frontend.php'); // on n'éxécuera le fichier dans l'index donc pas besoin de faire ../ pour sortir du dossier controller car on partira de l'index

    function listPost()
    {
        $posts = getPosts(); // on appelle une fonction du model
        require "view/frontend/listPostView.php"; // on vient appeller une vue
    }

    function post($id)
    {
        $safeId = htmlspecialchars($id);
        $post = getPost($safeId); // return $donReq => $post = $donReq on pourra donc utiliser $post['id'] etc dans postView
        // on va sur model pour faire la req à la bdd
        $comments = getComments($safeId);
        //on va sur model pour faire la req à la bdd
        //on appel la vue
        require "view/frontend/postView.php";
    }

    function newComment($id,$author,$comment)
    {       
        $safeId = htmlspecialchars($id);
        $safeAuthor = htmlspecialchars($author);
        $safeComment = htmlspecialchars($comment);
        $newComment = getNewComment($safeId,$safeAuthor,$safeComment);
        $send = "Formulaire Envoyé";
        
        $post = geTPost($safeId);
        $comments = getComments($safeId);

        require "view/frontend/postView.php";
    
    }
?>