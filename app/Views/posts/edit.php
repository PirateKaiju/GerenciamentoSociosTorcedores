<?php require_once APPROOT . "/Views/inc/header.php" ?>

<div class="hero is-primary has-background-white-bis has-text-grey-dark">
    <div class="hero-body">
        <h1 class="title has-text-black">Postagem</h1>
        <h3 class="subtitle has-text-black">postagem....</h3>

        <form class="box" action="<?php echo URLROOT;?>/Posts/edit/<?php echo $data["id_post"];?>" method="post">

            <div class="field">
                <label class="label">Título</label>
                <div class="control">
                    <input name="titulo" class="input" type="text" value="<?php echo $data["titulo"];?>">
                </div>
                <span class="is-danger has-text-danger"><?php echo $data["titulo_err"];?></span>
            </div>

            <div class="field">
                <label class="label">Texto</label>
                <div class="control">
                    <textarea name="descricao" class="textarea">
                    
                        <?php echo $data["descricao"];?>

                    </textarea>
                </div>
                <span class="is-danger has-text-danger"><?php echo $data["descricao_err"];?></span>
            </div>


            <div class="field">
                <div class="control">
                    <input class="button is-primary" type="submit" value="Atualizar">
                </div>
            </div>

        </form>
    </div>
</div>


<?php require_once APPROOT . "/Views/inc/footer.php" ?>