<?php require_once APPROOT . "/Views/inc/header.php" ?>


<div class="hero is-primary has-background-white-bis has-text-grey-dark">
    <div class="hero-body">

        <h1 class="title has-text-black">Registro de Usuário</h1>
        <h3 class="subtitle has-text-black">Descrição....</h3>

        <form class="box" action="<?php echo URLROOT;?>/Users/register" method="post">


            <div class="field">
                <label class="label">Nome</label>
                <div class="control">
                    <input name="nome_usr" class="input" type="text" value="<?php echo $data["nome_usr"];?>">
                </div>
                <span class="is-danger has-text-danger"><?php echo $data["nome_err"];?></span>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input name="email_usr" class="input" type="email" value="<?php echo $data["email_usr"];?>">
                </div>

                <span class="is-danger has-text-danger"><?php echo $data["email_err"];?></span>

            </div>

            <div class="field">
                <label class="label">Data de Nascimento</label>
                <div class="control">
                    <input name="data_nasc_usr" class="input" type="date">
                </div>

                <span class="is-danger has-text-danger"><?php echo $data["data_nasc_err"];?></span>
            </div>

            <div class="field">
                <label class="label">Senha</label>
                <div class="control">
                    <input name="senha_usr" class="input" type="password">
                </div>

                <span class="is-danger has-text-danger"><?php echo $data["senha_err"];?></span>
            </div>

            <div class="field">
                <label class="label">Confirmação de Senha</label>
                <div class="control">
                    <input name="conf_senha_usr" class="input" type="password">
                </div>

                <span class="is-danger has-text-danger"><?php echo $data["conf_senha_err"];?></span>
            </div>


            <!--<div class="field">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox">
                        Concordo com <a href="#">os termos e condições</a>
                    </label>
                </div>
            </div>-->

            <div class="field">
                <div class="control">
                    <input class="button is-primary" type="submit" value="Registrar">
                </div>
                <div class="control">
                    <br>
                    <p>
                        Já possui uma conta? <a href="<?php echo URLROOT;?>/Users/login" class="is-link">Efetuar Login</a>
                    </p>
                </div>
            </div>

        </form>


    </div>
</div>

<?php require_once APPROOT . "/Views/inc/footer.php" ?>