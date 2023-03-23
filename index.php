<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista_convidados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="corpo">

        <div id="title"> <h2>Lista de convidados</h2> </div>
       <div id="botao"> <a class="btn btn-primary" href="/TESTE CRUD/create.php" role="button">Novo Convidado</a> </div>  
        <br>
        <section>
        <table class="ta">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Criado Em</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <!--Começando o php -->
                <?php
                    $servername="localhost";
                    $username="root";
                    $password="";
                    $database="lista_convidados";

                    //Criando conexão
                    $connection = new mysqli($servername,$username,$password,$database);

                    //checando conexão
                    if($connection->connect_error) {
                        die("Falha da Conexão: " . $connection->connect_error);
                    }
                    //lendo todas as linhas da tabela database
                    $sql = "SELECT * FROM convidados";
                    $result = $connection->query($sql);

                    if(!$result) {
                        die("Invalid query: " . $connection->error);
                    }
                    //lendo o banco de cada linha
                    while ($row = $result->fetch_assoc()) {
                        echo " <tr>
                        <td>$row[nome]</td>
                        <td>$row[telefone]</td>
                        <td>$row[Criado_em]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/TESTE CRUD/edit.php?id=$row[id]'>Editar</a>
                            <a class='btn btn-danger btn-sm' href='/TESTE CRUD/delete.php?id=$row[id]'>Excluir</a>
                        </td>
                    </tr>
                        ";
                    }
                ?>
                
            </tbody>
        </table>
        </section>
</body>
</html>