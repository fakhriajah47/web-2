<?php
require_once ("function/callpage.php");

callpage("header");
callpage("navbar");
if (isset($_GET['page'])) {
    # code...
    callpage($_GET['page']);
} else{
    callpage("home");
}
callpage("footer");
?>
