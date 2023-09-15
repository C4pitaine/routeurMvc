<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>  <!-- on démarre "l'aspirateur" pour tout mettre dans un "sac" car on ne peut pas tout mettre comme ça dans une variable il faut passer par ob_start qui agira comme un aspirateur-->

<h1>Mon super blog! </h1>
<p>Les derniers sujets</p>

<?php
    foreach($posts as $sujet) : // : ouvre les accolades 
?>
    <div class="news">
        <h3>
            <a href="index.php?action=post&id=<?=$sujet['id']?>"><?= $sujet['title'] ?></a>
            <em>le <?= $sujet['creation_date_fr'] ?></em>
        </h3>
        <div>
            <?= nl2br($sujet['content']) ?>
        </div>
    </div>
<?php
    endforeach; // ferme les accolades 
?>

<?php $content = ob_get_clean(); ?>  <!-- on met tout dans le "sac ( $content )" -->

<?php require "template.php" ?> 
