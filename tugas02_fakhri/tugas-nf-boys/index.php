<?php
require 'components/header.php'; 

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

$allowed_pages = ['home', 'resume', 'projects', 'contact'];

if (in_array($page, $allowed_pages)) {
    require "pages/$page.php";
} else {
    echo "<div class='container px-5 my-5'><h1>404 - Page Not Found</h1></div>";
}

require 'components/footer.php'; 
?>
