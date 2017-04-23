<?php

if(!$_POST) {

    require_once('view/default.html');

} else {

    require_once('model/PrintDocumentFactory.php');
    (empty($_POST['status'])) ? $status = 'IS NULL' : $status = $_POST['status'];
    PrintDocumentFactory::build($_POST['request'], $status);

}