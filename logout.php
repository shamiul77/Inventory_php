<?php

require 'config/function.php';

if(isset($_SESSION['loggedIn'])){
    logout();
    redirect('login.php', Log Out Successfully);
}

?>