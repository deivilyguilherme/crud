<?php
$servername="localhost";
$username="root";
$password="";
$database="lista_convidados";

//Criando conexão
$connection = new mysqli($servername,$username,$password,$database);

//Declarando variáveis

$nome="";
$telefone="";

$errorMessage="";
$successMessage="";

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];

//Caso os campos forem nulos irá dar essa resposta

    do {
        if( empty($nome) || empty($telefone) ) {
            $errorMessage = "Todos os campos são obrigatórios";
            break;
        }
    

//adicionando novo convidado no banco de dados

        $sql = "INSERT INTO convidados (nome, telefone)" . "VALUES ('$nome', '$telefone')";
        $result = $connection->query($sql);

//Se houver erro então vai imprimir essa mensagem:

        if(!$result) {
            $errorMessage = "Consulta Inválida: " . $connection->error;
            break;
        }

    $nome="";
    $telefone="";

    $successMessage = "Convidado adicionado com sucesso!";

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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefone</label>
                <div class="col-sm-6">
                    <input type="tel" class="form-control" name="telefone" value="<?php echo $nome; ?>" require>
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