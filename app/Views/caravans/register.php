<?php require_once APPROOT . "/Views/inc/header.php" ?>

<div class="hero is-primary has-background-white-bis has-text-grey-dark">
    <div class="hero-body">
        <h1 class="title has-text-black">Registro de Caravana</h1>
        <h3 class="subtitle has-text-black">Descrição.... indicar jogo aqui talvez?</h3>

        <form class="box" action="<?php echo URLROOT;?>/Caravans/register/<?php echo $data["id_jogo"];?>" method="post">

            <div class="field">
                <label class="label">Nome da caravana</label>
                <div class="control">
                    <input name="nome_caravana" class="input" type="text" value="<?php echo $data["nome_caravana"];?>">
                </div>
                <span class="is-danger has-text-danger"><?php echo $data["nome_caravana_err"];?></span>
            </div>

            <div class="field">
                <div class="control">
                    <input class="button is-primary" type="submit" value="Registrar">
                </div>
            </div>

        </form>
    </div>
</div>


<?php require_once APPROOT . "/Views/inc/footer.php" ?>