<?php require_once APPROOT . "/Views/inc/header.php" ?>


<div class="hero is-primary has-background-white-bis has-text-grey-dark">
    <div class="hero-body">

        
        <?php if($flashed_message = flash("user_created_msg")):?>

            <div class="notification is-primary">
                <?php echo $flashed_message;?>
            </div>
        
        <?php endif;?>

        <!--<?php echo $_SESSION["times_called"];?>-->
        <form class="box" action="<?php echo URLROOT; ?>/Users/login" method="post">


            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input name="email_usr" class="input" type="email" value="<?php echo $data["email_usr"]; ?>">
                </div>

            </div>

            <div class="field">
                <label class="label">Senha</label>
                <div class="control">
                    <input name="senha_usr" class="input" type="password">
                </div>

            </div>

            <div class="field">
                <div class="control">
                    <input class="button is-primary" type="submit" value="Login">
                </div>
            </div>

        </form>
    </div>
</div>

<?php require_once APPROOT . "/Views/inc/footer.php" ?>