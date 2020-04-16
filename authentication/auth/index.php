<?php

namespace auth;

require dirname(__dir__).'/config.php';

if(isset($_SESSION['user'])){
    header('location: /profile.php');
}
?>
<a href="/login.php">login.php</a>