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

    <title>Cadastro | Fabio Cezar</title>
</head>

<body>
    <div class="register">
        <div class="register__content">
            <div class="register__img">
            </div>

            <div class="register__forms">
                <form method="POST" class="register__create" id="login-up">
                    <h1 class="login__title">Cadastro</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" name="nome" placeholder="Nome Completo" maxlength="40" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-phone login__icon'></i>
                        <input type="text" name="telefone" id="telefone" placeholder="Telefone com DDD" maxlength="15" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input type="email" name="email" placeholder="Email do Usuário" maxlength="50" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="senha" placeholder="Senha" maxlength="15" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15" class="login__input">
                    </div>

                    <input type="submit" value="CADASTRAR" class="login__button">

                    <div class="login__social">
                        <?php
                        if (isset($_POST['nome'])) {
                            $nome = addslashes($_POST['nome']);
                            $telefone = addslashes($_POST['telefone']);
                            $email = addslashes($_POST['email']);
                            $senha = addslashes($_POST['senha']);
                            $confirmarSenha = addslashes($_POST['confSenha']);

                            //Verificar se todos os campos estão preenchidos
                            if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {
                                $usuario->conectar("website-fabio", "localhost", "root", "");
                                if ($usuario->msgErro == "") //Tudo ok... Conectamos
                                {
                                    if ($senha == $confirmarSenha) {
                                        if ($usuario->cadastrar($nome, $telefone, $email, $senha)) {
                        ?>
                                            <div id="msg-sucesso">
                                                CADASTRADO COM SUCESSO!
                                            </div>

                                        <?php
                                        } else {
                                        ?>
                                            <div id="msg-insucesso">
                                                EMAIL JÁ CADASTRADO!
                                            </div>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div id="msg-insucesso">
                                            AS SENHAS NÃO SÃO IGUAIS!
                                        </div>

                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div id="msg-insucesso">
                                        <?php echo "Erro: " . $usuario->msgErro ?>
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
                        <span class="login__account">Já tem uma conta?</span>
                        <a href="login.php" class="login__signin">Entrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ============== MASCARA DO CADASTRO DE TELEFONE ==============  -->

    <script language="javascript">
        function mascara(o, f) {
            v_obj = o
            v_fun = f
            setTimeout("execmascara()", 1)
        }

        function execmascara() {
            v_obj.value = v_fun(v_obj.value)
        }

        function mtel(v) {
            v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
            v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }

        function id(el) {
            return document.getElementById(el);
        }
        window.onload = function() {
            id('telefone').onkeyup = function() {
                mascara(this, mtel);
            }
        }
    </script>
</body>

</html>