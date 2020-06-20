<?php require_once APPROOT . "/Views/inc/header.php" ?>

<div class="hero is-primary has-background-white-bis has-text-grey-dark">
    <div class="hero-body">
        <h1 class="title has-text-black">Edição de Jogo</h1>
        <h3 class="subtitle has-text-black">Descrição....</h3>

        <form class="box" action="<?php echo URLROOT;?>/Games/edit/<?php echo $data["id_game"];?>" method="post">

            <div class="field">
                <label class="label">Time da casa</label>
                <div class="control">
                    <input name="time_casa" class="input" type="text" value="<?php echo $data["time_casa"];?>">
                </div>
                <span class="is-danger has-text-danger"><?php echo $data["time_casa_err"];?></span>
            </div>

            <div class="field">
                <label class="label">Time adversário</label>
                <div class="control">
                    <input name="time_adv" class="input" type="text" value="<?php echo $data["time_adv"];?>">
                </div>
                <span class="is-danger has-text-danger"><?php echo $data["time_adv_err"];?></span>
            </div>

            <div class="field">
                <label class="label">Data da partida</label>
                <div class="control">
                    <input name="data_jogo" class="input" type="date">
                </div>

                <span class="is-danger has-text-danger"><?php echo $data["data_jogo_err"];?></span>
            </div>

            <div class="field">
                <label class="label">Descrição</label>
                <div class="control">
                    <textarea name="descricao" class="textarea"><?php echo $data["descricao"];?></textarea>
                </div>
                <span class="is-danger has-text-danger"><?php echo $data["time_adv_err"];?></span>
            </div>

            <div class="field">
                <div class="control">
                    <input class="button is-primary" type="submit" value="Salvar">
                </div>
            </div>

        </form>
    </div>
</div>


<?php require_once APPROOT . "/Views/inc/footer.php" ?>