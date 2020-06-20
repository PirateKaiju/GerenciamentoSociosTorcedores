<?php require_once APPROOT . "/Views/inc/header.php" ?>


<div class="hero is-primary has-background-white-bis has-text-grey-dark">
    <div class="hero-body">

        <p class="has-text-dark">Olá <?php echo $_SESSION["nome_usr"]; ?></p>

        <?php if(loggedUserIsAdmin()): ?>
            <p>Você é Administrador!</p>
        <?php endif;?>

        <?php echo "QUICK DEBUG: "; var_dump($_SESSION);?>

    </div>
</div>

<?php require_once APPROOT . "/Views/inc/footer.php" ?>