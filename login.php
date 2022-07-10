<?php
require_once 'usuarios.php';
$usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/styles-login.css">

    <!-- ===== BOX ICONES ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>Login | Fabio Cezar</title>
</head>

<body>
    <div class="login">
        <div class="login__content">
            <div class="login__img">
            </div>

            <div class="login__forms">
                <form method='POST' class="login__registre" id="login-in">
                    <h1 class="login__title">FAÇA O SEU LOGIN</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="email" name="email" placeholder="Usuário" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="senha" placeholder="Senha" class="login__input">
                    </div>

                    <input type="submit" value="CONECTAR" class="login__button">

                    <div class="login__social">
                        <?php
                        if (isset($_POST['email'])) {
                            $email = addslashes($_POST['email']);
                            $senha = addslashes($_POST['senha']);

                            if (!empty($email) && !empty($senha)) {
                                $usuario->conectar("website-fabio", "localhost", "root", "");
                                if ($usuario->msgErro == "") {
                                    if ($usuario->logar($email, $senha)) {
                                        header("location: dashboard.php");
                                    } else {
                        ?>
                                        <div id="msg-insucesso">
                                            CAMPOS NÃO CONFEREM!
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div id="msg-insucesso">
                                        <?php echo "Erro de Conexão com o banco: " . $usuario->msgErro ?>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div id="msg-insucesso">
                                    PREENCHA TODOS OS CAMPOS!
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <span class="login__account">Não tem uma conta?</span>
                        <a href="cadastro.php" class="login__signin">Criar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>