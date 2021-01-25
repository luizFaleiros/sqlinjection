<?php
session_start();

$login = $_SESSION['login'];
echo $_SESSION['query'];
echo '<br />';
foreach ($login as $key ) {
    echo $key;
    echo '<br />';
}

?>