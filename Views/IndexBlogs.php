<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bloger</title>
  <link rel="shortcut icon" type="image/png" href="/assets/image/logo.png"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@creativebulma/bulma-tagsinput@1.0.3/dist/css/bulma-tagsinput.min.css">
  <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@creativebulma/bulma-tagsinput@1.0.3/dist/js/bulma-tagsinput.min.js"></script>
  <style>
    body, button, input, optgroup, select, textarea {
      font-family: 'Lexend', 'Segoe UI',Roboto,'Fira Sans',Helvetica,Arial,sans-serif;
    }

    .navbar {
        box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.05);
    }
    .navbar-item {
      color: #5533ff;
    }
    .sign-up {
      background: #f59425;
      border-color: #f59425;
      color: white;
    }
    .landing {
      position: relative;
      min-height: 65vh !important;
      margin-bottom: 1rem;
    }
    .landing h1 {
      max-width: 500px;
      margin-bottom: 2rem;
      font-size: 3rem;
      font-weight: bold;
      color: white;
    }
    .landing h2 {
      font-size: 1.5rem;
      color: white;
    }
    .landing img {
      position: absolute;
      top: 110px;
      right: 140px;
      width: 580px;
      height: auto;
    }
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #5533ff;
      background: linear-gradient(95deg, #5533ff 40%, #25ddf5 100%);
      transform: skewY(-12deg);
      transform-origin: 0;
      z-index: -10;
    }

    .tile article {
      flex: 1;
    }

    .avatar {
      width: 1rem;
      height: auto;
      margin-right: 1rem;
    }

    .ordinal {
      width: 4rem;
      font-size: 2rem;
      font-weight: bold;
      color: #f59425;
      opacity: 0.4;
    }

    .articles {
      border-top: 1px solid #e6e6e6;
    }

    .article {
      padding: 2rem;
      border-bottom: 1px solid #e6e6e6;
    }

    .categories {
      border-bottom: 1px solid #e6e6e6;
    }

    .login-modal .modal-card-head {
      border-bottom: none;
      background-color: white;
    }
    .login-modal .modal-card-foot {
      border-top: none;
      background-color: white;
    }

    .file-cta {
      padding: 2.2em 0.4em !important;
    }

    .blog-line {
        display: flex;
        align-items: center;
        min-height: 100px;
        padding: 2em 4em;
        border-bottom: 1px solid #e6e6e6;
    }

    .blog-line__logo {
        margin-right: 2em;
        border-radius: 2em;
    }

    .c-inherit {
        color: inherit;
    }
  </style>
</head>
<body>
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
            <?php
            if (\Core\Session::check()) {
                echo '
                    <a class="button sign-up" href="/logout">
                        <strong>Logout</strong>
                    </a>
                ';
            } else {
                echo '
                    <a id="register-button" class="button sign-up">
                      <strong>Sign up</strong>
                    </a>
                    <a id="login-button" class="button is-dark is-outlined">
                      Log in
                    </a>
                ';
            }
            ?>
        </div>
      </div>
    </div>
  </div>
</nav>

<section class="section">
  <div class="container">
    <div class="blog-line">
      <img class="blog-line__logo" src="https://picsum.photos/100?blur=2&random=1" alt="blog_logo" />
      <div class="is-flex is-align-content-center is-flex-grow-1">
        <div class="mr-6">
          <p class="is-size-4">Prvi blog</p>
          <p>Opis prvog bloga, malo je duzi da sve bude vidljivo</p>
        </div>
        <div class="tags are-small is-flex-grow-1 mr-4">
          <span class="tag">Veze</span>
          <span class="tag">Produktivnost</span>
          <span class="tag">Politika</span>
        </div>
      </div>
      <div>
        <a class="material-icons-outlined mr-2 is-clickable c-inherit" href="/blogs/5">add</a>
        <span class="material-icons-outlined mr-2 is-clickable">edit</span>
        <span class="material-icons-outlined mr-2 is-clickable">delete_outline</span>
      </div>
    </div>
    <div class="blog-line">
      <img class="blog-line__logo" src="https://picsum.photos/100?blur=2&random=2" alt="blog_logo" />
      <div class="is-flex is-align-content-center is-flex-grow-1">
        <div class="mr-6">
          <p class="is-size-4">Drugi blog</p>
          <p>Opis drugog bloga, malo je duzi da sve bude vidljivo</p>
        </div>
        <div class="tags are-small is-flex-grow-1 mr-4">
          <span class="tag is-clickable">Poznati</span>
          <span class="tag is-clickable">Zdravlje</span>
          <span class="tag is-clickable">Programiranje</span>
          <span class="tag is-clickable">Meditacija</span>
        </div>
      </div>
      <div>
        <a class="material-icons-outlined mr-2 is-clickable c-inherit" href="/blogs/5">add</a>
        <span class="material-icons-outlined mr-2 is-clickable">edit</span>
        <span class="material-icons-outlined mr-2 is-clickable">delete_outline</span>
      </div>
    </div>
    <div id="new-blog-button" class="py-4 has-text-centered">
      <span class="material-icons-outlined is-size-2 is-clickable">add_circle_outline</span>
    </div>
  </div>
</section>

<div id="new-blog-modal" class="modal">
  <div id="new-blog-modal-background" class="modal-background"></div>
  <button id="new-blog-modal-close" class="modal-close is-large" aria-label="close"></button>
  <div class="modal-card">
    <header class="modal-card-head py-6">
      <p class="modal-card-title has-text-centered">Novi blog</p>
    </header>
    <section class="modal-card-body py-6">
      <form id="login-form" method="post" action="/blog">
        <div class="file is-boxed is-centered mb-4">
          <label class="file-label">
            <input class="file-input" type="file" name="resume">
            <span class="file-cta">
          <span class="file-icon">
            <span class="material-icons-outlined">photo_camera</span>
          </span>
          <span class="file-label">
            Izaberite logo
          </span>
        </span>
          </label>
        </div>
        <div class="field">
          <div class="control">
            <input class="input is-large" type="text" name="name" placeholder="Naziv bloga" />
          </div>
        </div>
        <div class="field">
          <div class="control">
            <textarea class="textarea has-fixed-size" placeholder="Opis bloga"></textarea>
          </div>
        </div>
        <div class="field">
          <div class="control">
            <input class="input" type="text" data-type="tags" placeholder="Tagovi">
          </div>
        </div>
        <button class="button is-medium is-fullwidth is-primary mt-4">Napravi blog</button>
      </form>
    </section>
  </div>
</div>

</body>

<script>
  const closeNewModalBlog = () => {
    $("#new-blog-modal").removeClass("is-active");
  };

  $(document).ready(() => {
    BulmaTagsInput.attach();
    // Register modal triggers
    $("#new-blog-button").click(() => {
      $("#new-blog-modal").addClass("is-active");
    });
    $("#new-blog-modal-background").click(closeNewModalBlog);
    $("#new-blog-modal-close").click(closeNewModalBlog);
  });
</script>

</html>

