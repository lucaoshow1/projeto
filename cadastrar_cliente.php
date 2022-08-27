<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar cliente</title>
</head>
<body>
   
 


    <div class="container">
        <h3>formulario para Cadastro de Cliente</h3>
    <br> 
        <form action="" 
                method="post" 
                    class="formulario">

            <label for="#">Nome: </label>
            <input
                value="<?php if (isset($_POST['nome'])) echo $_POST['nome'];?>"
                type="text"
                name="nome"
                placeholder="José Pinheiros Santos"> <br><br>

            <label for="">E-mail: </label>
            <input
                value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>"
                type="text"
                name="email"
                placeholder="seu@email.com"> <br><br>

            <label for="">telefone: </label>
            <input
                value="<?php if (isset($_POST['telefone'])) echo $_POST['telefone'];?>"
                type="text"
                name="telefone"
                placeholder="(21) 98888-8888"> <br><br>
            
            <label for="">Data de Nascimento: </label>
            <input
                value="<?php if (isset($_POST['nascimento'])) echo $_POST['nascimento'];?>"
                type="text"
                name="nascimento"
                placeholder="DD/MM/AAAA"
                class="data"> <br><br>

            <button
                type="submit"
                name="envio"
                class="button"> Salvar Cliente</button>

            <br><br>


        </form>
        
    
        <?php


            function limpar_texto($str){ 
                return preg_replace("/[^0-9]/", "", $str); 
            }
            function validarData($nascimento){
                $valores = explode('/', $nascimento);
                if (count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])) {
                    return true;
                }
                return false;
            }

        $erro = false;
            if (count($_POST) > 0) {

                include ('conexao.php');

               $nome = $_POST['nome'];
               $email = $_POST['email'];
               $telefone = $_POST['telefone'];
               $nascimento = $_POST['nascimento'];
            }
            if(empty($nome)){
                $erro = "preencha o campo <b>Nome</b>";
            }
            if(empty($email)){
                $erro = "preencha o campo <b>Email</b>";
            }

            if(!empty($nascimento)){
                $nascimento = validarData($nascimento); 
            }else{
                echo "errado";
            }
            
            if (!empty($telefone)) {
                $telefone = limpar_texto($telefone);
                if(strlen($telefone) !=11){
                    $erro = "O telefone deve ser preenchido no padrão (21) 98888-8888";
                }
            
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erro = "Preencha o email corretamente";
            } 

            }        

            if($erro){
                echo "<p><b> $erro</b></p>";
            } else {
                $sql_code = "INSERT INTO clientes(nome, email, telefone, nascimento, data) VALUES('$nome', '$email', '$telefone', '$nascimento', NOW())";
                $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
                if($deu_certo){
                    echo "Cliente cadastrado com sucesso!";
                    unset($_POST);
                }
            }



     

        ?> 
        <a href="">Voltar para a lista</a> 
    </div>
    
</body>
</html>

