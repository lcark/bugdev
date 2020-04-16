<?php


require dirname(__dir__).'/config.php';

echo $TWIG->render('profile.html.twig', ['user' => $_SESSION['user']]);
?>