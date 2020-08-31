<?php

    $id = $_GET["id"];
    echo $id;

    $funcDAO = new FuncionarioDAO();
    $funcDAO->deleteFuncionario($id);

    header('Location:exibeFuncionarios');


?>