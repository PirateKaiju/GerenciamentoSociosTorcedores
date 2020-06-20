<nav class="navbar has-background-grey-lighter is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="#">
      
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu is-active">
    <div class="navbar-start">
      
      <a class="navbar-item" href="<?php echo URLROOT;?>">
        Home
      </a>

      <a class="navbar-item" href="<?php echo URLROOT?>/games/">
        Jogos
      </a>

      <a class="navbar-item" href="<?php echo URLROOT?>/posts/1">
        Novidades
      </a>
      
      <a class="navbar-item" href="<?php echo URLROOT?>/caravans/">
        Caravanas
      </a>

      <a class="navbar-item" href="<?php echo URLROOT?>/pages/about">
        Sobre
      </a>


      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="<?php echo URLROOT;?>/users/profile">
          Perfil
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            Eventos
          </a>
          <a class="navbar-item">
            Mensalidades
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="<?php echo URLROOT;?>/users/register">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light" href="<?php echo URLROOT;?>/users/login">
            Log in
          </a>
          <?php if(userIsLoggedIn()):?>
          <a class="button is-light" href="<?php echo URLROOT;?>/users/logout">
            Logout
          </a>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
</nav>