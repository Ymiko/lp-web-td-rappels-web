<?php

function getBlock($file, $data = [])
{
    require PATH . $file . '.php';
}

function getPost($name) {
    return htmlspecialchars($_POST[$name]);
}

function isAdmin() {
    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
        return true;
    }
    return false;
}