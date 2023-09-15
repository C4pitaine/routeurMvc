<?php  

    /**
     * Permet d'obtenir la liste de tous les posts
     *
     * @return array
     */
    function getPosts(): array
    {
        $db = dbConnect();
        $req = $db->query("SELECT id,title,content,DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0,5");
        $donReq = $req->fetchAll();
        $req->closeCursor();

        return $donReq;
    }

    /**
     * Permet de recup un post
     *
     * @param integer $id
     * @return array
     */
    function getPost(int $id): array 
    // on vient typer l'id en int , et le return de la fonction en tableau
    {
        $db = dbConnect();
        $req = $db->prepare("SELECT id,title,content,DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS creation_date_fr FROM posts WHERE id=?");
        $req->execute([$id]);  //$id est notre paramètre de fonction
        $donReq = $req->fetch();
        $req->closeCursor();

        return $donReq;
    }

    /**
     * Permet de recup tout les commentaires d'un post
     *
     * @param integer $id
     * @return array
     */
    function getComments(int $id): array
    {
        $db = dbConnect();
        $comments = $db->prepare("SELECT id,author,comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS comment_date_fr FROM comments WHERE post_id=? ORDER BY comment_date DESC");
        $comments->execute([$id]);
        $donCom = $comments->fetchAll();
        $comments->closeCursor();

        return $donCom;
    }

    /**
     * Insertion de nouveaux commentaires
     *
     * @param integer $id
     * @param string $author
     * @param string $comment
     * @return boolean
     */
    function getNewComment(int $id, string $author, string $comment): bool
    {
        $db = dbConnect();
        $newComment = $db->prepare("INSERT INTO comments(post_id,author,comment,comment_date) VALUES(:myid,:author,:comment,NOW())");
        $newComment->execute([
            ":author" => $author,
            ":comment" => $comment,
            ":myid" => $id
        ]);
        
        return true;
    }



    /**
     * Permet de réaliser une connexion PDO 
     *
     * @return PDO
     */
    function dbConnect(): PDO
    {
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=blog2;charset=utf8','root','',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            return $bdd;

        }catch(Exception $e) 
        {
            die('Erreur:'.$e->getMessage());
        }
    }

?>