<!DOCTYPE html>
<html>
<?php include("./Views/Partials/Meta.php") ?>
<body class="home">
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
            <a class="button" href="/blogs"><strong>Moji blogovi</strong></a>
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
<section class="landing hero is-halfheight">
  <div class="overlay"></div>
  <div class="hero-body">
    <div class="px-6">
      <h1>
        Bloge<span style="color: #f59425">.rs</span> - prva srpska blog platforma
      </h1>
      <h2>
        Čitaj, deli, stvaraj
      </h2>
      <img src="assets/image/intro.png" alt="landing image">
    </div>
  </div>
</section>
<section class="section">
  <div class="container is-max-widescreen">
    <h3 class="mb-4 is-size-5 has-text-weight-semibold is-uppercase">Najpopularnije na Bloge.rs</h3>
    <div class="tile mb-4">
      <div class="tile is-4 is-flex">
        <div class="ordinal">01</div>
        <article>
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <p class="is-size-7">26.03.2021</p>
        </article>
      </div>
      <div class="tile is-4 is-flex">
        <div class="ordinal">02</div>
        <article>
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <p class="is-size-7">26.03.2021</p>
        </article>
      </div>
      <div class="tile is-4 is-flex">
        <div class="ordinal">03</div>
        <article>
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <p class="is-size-7">26.03.2021</p>
        </article>
      </div>
    </div>
    <div class="tile">
      <div class="tile is-4 is-flex">
        <div class="ordinal">04</div>
        <article>
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <p class="is-size-7">26.03.2021</p>
        </article>
      </div>
      <div class="tile is-4 is-flex">
        <div class="ordinal">05</div>
        <article>
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <p class="is-size-7">26.03.2021</p>
        </article>
      </div>
      <div class="tile is-4 is-flex">
        <div class="ordinal">06</div>
        <article>
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          <p class="is-size-7">26.03.2021</p>
        </article>
      </div>
    </div>
  </div>
</section>
<section class="section articles">
  <div class="columns is-align-items-flex-start">
    <div class="column is-two-thirds px-6">
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
      <div class="article is-flex">
        <div class="is-flex-grow-1">
          <div class="is-flex is-align-items-center">
            <img class="avatar" src="assets/image/avatar.png" alt="user avatar">
            <span class="is-size-7">Milan Milanov</span>
          </div>
          <p class="mb-2 is-size-5 has-text-weight-bold">7 mejlova koje treba da šaljete svake nedelje</p>
          <p class="is-size-6 mb-4">
            Sakrivena moć vašeg inboksa
          </p>
          <div class="is-flex is-justify-content-space-between">
            <p class="is-size-7">26.03.2021</p>
            <span class="material-icons-outlined is-clickable">bookmark_border</span>
          </div>
        </div>
        <figure class="image ml-6">
          <img src="assets/image/article.jpg" alt="article preview">
        </figure>
      </div>
    </div>
    <div class="column categories">
      <p class="mb-4 has-text-weight-bold is-uppercase">Otkrijte šta vas interesuje</p>
      <div class="tags are-medium mb-5">
        <span class="tag is-clickable">Veze</span>
        <span class="tag is-clickable">Produktivnost</span>
        <span class="tag is-clickable">Politika</span>
        <span class="tag is-clickable">Poznati</span>
        <span class="tag is-clickable">Zdravlje</span>
        <span class="tag is-clickable">Programiranje</span>
        <span class="tag is-clickable">Meditacija</span>
        <span class="tag is-clickable">Moda</span>
        <span class="tag is-clickable">Veštačka inteligencija</span>
      </div>
    </div>
  </div>
</section>
<div class="login-modal modal" id="login-modal">
  <div id="login-modal-background" class="modal-background"></div>
  <button id="login-modal-close" class="modal-close is-large" aria-label="close"></button>
  <div class="modal-card">
    <header class="modal-card-head py-6">
      <p class="modal-card-title has-text-centered">Dobrodošli nazad</p>
    </header>
    <section class="modal-card-body py-6">
      <form id="login-form" method="POST" action="/login">
        <div class="field">
          <p class="control has-icons-left has-icons-right">
            <input class="input" type="email" placeholder="Email" name="email">
            <span class="icon is-small is-left">
              <i class="material-icons-outlined">mail_outline</i>
            </span>
            <span class="icon is-small is-right">
              <i class="material-icons-outlined">done</i>
            </span>
          </p>
        </div>
        <div class="field">
          <p class="control has-icons-left">
            <input class="input" type="password" placeholder="Šifra" name="password">
            <span class="icon is-small is-left">
              <i class="material-icons-outlined">lock</i>
            </span>
          </p>
        </div>
      </form>
    </section>
    <footer class="modal-card-foot is-block">
      <button class="button is-success is-fullwidth" type="submit" form="login-form">
        Uloguj me
      </button>
      <p class="has-text-centered mt-5">Nemate nalog?
        <a id="register-redirect" style="color: #f59425">Napravite ga</a>
      </p>
    </footer>
  </div>
</div>

<div id="register-modal" class="login-modal modal">
  <div id="register-modal-background" class="modal-background"></div>
  <button id="register-modal-close" class="modal-close is-large" aria-label="close"></button>
  <div class="modal-card">
    <header class="modal-card-head py-6">
      <p class="modal-card-title has-text-centered">Napravite nalog</p>
    </header>
    <section class="modal-card-body py-6">
      <div class="field">
        <p class="control has-icons-left has-icons-right">
          <input class="input" type="email" placeholder="Email">
          <span class="icon is-small is-left">
            <i class="material-icons-outlined">mail_outline</i>
          </span>
          <span class="icon is-small is-right">
            <i class="material-icons-outlined">done</i>
          </span>
        </p>
      </div>
      <div class="field">
        <p class="control has-icons-left">
          <input class="input" type="password" placeholder="Password">
          <span class="icon is-small is-left">
            <i class="material-icons-outlined">lock</i>
          </span>
        </p>
      </div>
    </section>
    <footer class="modal-card-foot is-block">
      <button class="button is-success is-fullwidth">
        Register
      </button>
    </footer>
  </div>
</div>
</body>

<script>
  const closeLoginModal = () => {
    $("#login-modal").removeClass("is-active");
  };
  const closeRegisterModal = () => {
    $("#register-modal").removeClass("is-active");
  };

  $(document).ready(() => {

    // Check if we have any modals we need to open
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('action')) {
      const action = urlParams.get('action');

      // For now this is the only action allowed
      if (action === 'login') {
        $("#login-modal").addClass("is-active");
      } else {
        console.error("Acton not allowed.")
      }
    }

    // Login modal triggers
    $("#login-button").click(() => {
      $("#login-modal").addClass("is-active");
    });
    $("#login-modal-close").click(closeLoginModal);
    $("#login-modal-background").click(closeLoginModal);

    // Register modal triggers
    $("#register-button").click(() => {
      $("#register-modal").addClass("is-active");
    });
    $("#register-redirect").click(() => {
      $("#login-modal").removeClass("is-active");
      $("#register-modal").addClass("is-active");
    });
    $("#register-modal-close").click(closeRegisterModal);
    $("#register-modal-background").click(closeRegisterModal);
  });
</script>

</html>

