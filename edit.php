<?php
$servername="localhost";
$username="root";
$password="";
$database="lista_convidados";

//Criando conexão
$connection = new mysqli($servername,$username,$password,$database);


$id ="";
$nome ="";
$telefone ="";

$errorMessage = "";
$successMessage ="";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    //método get motra os dados do cliente

    if ( !isset($_GET["id"]) ) {
        header("location: /teste crud/index.php");
        exit;
    }

    $id = $_GET["id"];

    //Lendo a linha do convidado selecionado da table do banco
    $sql = "SELECT * FROM convidados WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row) {
        header("location: /teste crud/index.php");
        exit;
    }
    $nome = $row["nome"];
    $telefone = $row["telefone"];
}
else {
    //método post atualiza os dados do cliente
    
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];

    do {
        if ( empty($id) || empty($nome) || empty($telefone) ) {
            $errorMessage = "Todos os Campos são obrigatórios";
            break;
        }

        $sql = "UPDATE convidados " . 
            "SET nome = '$nome', telefone = '$telefone' " . "WHERE id = $id";

            $result = $connection->query($sql);
            
            if (!$result) {
                $errorMessage = "Consulta Inválida: " . $connection->error;
                break;
            }

            $successMessage = "Convidado atualizado com sucesso!";

            header("location: /teste crud/index.php");
            exit;

    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TESTE CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Novo convidado</h2>
        <?php
        if(!empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefone</label>
                <div class="col-sm-6">
                    <input type="tel" class="form-control" name="telefone" value="<?php echo $telefone; ?>" required>
                </div>
            </div>
            <?php
                if ( !empty($successMessage) ){
                    echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                     </div>
                </div>
            ";
                }

            ?>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="/teste crud/index.php" role="button">Cancel</a>
                    </div>
                </div>
            
        </form>
    </div>
</body>
</html>