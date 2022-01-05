<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/">
      <img class="mr-2" src="/assets/image/logo.png" height="28" width="28" alt="brand logo">
      <span class="is-size-4">BLOGE<span style="color: #f59425">.rs</span></span>
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
            <?php if (\Core\Session::check()) :?>
              <a class="button sign-up" href="/logout"><strong>Logout</strong></a>
            <?php else :?>
              <a id="register-button" class="button sign-up"><strong>Sign up</strong></a>
              <a id="login-button" class="button is-dark is-outlined">Log in</a>
            <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</nav>
