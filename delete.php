<?php
if ( isset($_GET["id"]) ) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "lista_convidados";

    //criando conexão
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM convidados WHERE id=$id";
    $connection->query($sql);
}
header("location: /teste crud/index.php");
exit;
?>