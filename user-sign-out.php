
<?php

require 'include/connectdb.php';

    session_start();
    session_destroy();
    header("location: index.php");
?>
