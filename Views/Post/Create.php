<?php
// Initialize view variables
$blogId = $blogId ?? 0;
$images = $images ?? [];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bloger</title>
  <link rel="shortcut icon" type="image/png" href="/assets/image/logo.png"/>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@creativebulma/bulma-tagsinput@1.0.3/dist/css/bulma-tagsinput.min.css">
  <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@creativebulma/bulma-tagsinput@1.0.3/dist/js/bulma-tagsinput.min.js"></script>
  <style>

      html {
          overflow-y: auto;
      }

    body, button, input, optgroup, select, textarea {
      font-family: 'Lexend', 'Segoe UI', Roboto, 'Fira Sans', Helvetica, Arial, sans-serif;
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

    .tabs li.is-active a {
        border-bottom-color: #f59425;
        color: #f59425;
    }

    .post-list li {
        display: flex;
        align-items: center;
        min-height: 100px;
        padding: 2em 4em;
        border-bottom: 1px solid #e6e6e6;
    }

    .tab-body {
        display: none;
    }
    .tab-body.is-active {
        display: block;
    }

    .post-form input,
    .post-form textarea {
        border: 0;
        box-shadow: none;
    }

    .post-form input:focus,
    .post-form textarea:focus {
        box-shadow: none;
    }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: -41vw;
        z-index: 1000;
        width: 40vw;
        overflow: auto;
        padding: 2vw 2vw 2vw 4vw;
        box-shadow: 5px 8px 20px 0 rgba(0, 0, 0, 0.05);
        background-color: white;
        transition: all 0.8s cubic-bezier(.47,1.64,.41,.8);
    }

    .sidebar_active {
        left: -2vw;
    }

    .sidebar__open {
        color: #f59425;
        font-size: 2em;
        cursor: pointer;
    }

    .sidebar__close {
        position: absolute;
        top: 5px;
        right: 5px;
        cursor: pointer;
    }

    .sidebar blockquote {
        background: #f9f9f9;
        border-left: 10px solid #ccc;
        padding: 1em;
    }

    .sidebar ul {
        padding: revert;
        list-style-type: disc;
    }

    .sidebar ul ul {
        padding: revert;
        list-style-type: circle;
    }

    #image-modal .modal-card-body {
        display: flex;
        flex-wrap: wrap;
        max-height: 60vh;
    }

    .image-card {
        position: relative;
        flex-basis: calc((100% - 3em) / 3);
        margin: 0.5em;
        padding: 0.5em;
        border: 1px solid #e6e6e6;
        text-align: center;
    }

    .image-card .image-card-delete {
        display: none;
        position: absolute;
        right: 0.5rem;
        top: 0.5rem;
        cursor: pointer;
    }

    .image-card:hover .image-card-delete {
        display: block;
    }

    .image-card .image-copy-icon {
        color: initial;
    }

    .image-card .file {
        height: 100%;
        align-items: center;
    }
    .image-card .file.is-boxed .file-cta {
        padding: 1rem;
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
  <div class="container is-flex is-justify-content-space-between">
    <div>
      <span id="sidebar-open" class="material-icons-outlined sidebar__open">
        help_outline
      </span>
    </div>
    <div>
      <button id="image-button" class="button is-info is-rounded is-outlined mr-2">
        Dodaj sliku
      </button>
      <button class="button is-info is-rounded is-outlined mr-2" type="submit" form="post-form">
        Sačuvaj nacrt
      </button>
      <button class="button is-success is-rounded is-outlined" type="submit" form="post-form">
        Objavi
      </button>
    </div>
  </div>
  <div class="container">
    <section class="section">
      <form class="post-form" id="post-form" method="POST" action="/blogs/<?= $blogId ?>/posts">
        <div class="field is-horizontal">
<!--          <div class="field-label is-large">-->
<!--            <label class="label" for="title">Naslov</label>-->
<!--          </div>-->
          <div class="field-body">
            <div class="field">
              <p class="control">
                <input
                  class="input is-large"
                  id="title"
                  type="text"
                  name="title"
                  placeholder="Naslov"
                  autofocus
                />
              </p>
            </div>
          </div>
        </div>
        <div class="field">
          <div class="control">
            <textarea
              class="textarea is-medium has-fixed-size"
              name="content"
              placeholder="Tvoja priča"
              rows="22"
            ></textarea>
          </div>
        </div>
      </form>
    </section>
  </div>
</section>

<section id="sidebar" class="sidebar">
  <span id="sidebar-close" class="material-icons-outlined sidebar__close">
    close
  </span>

  <p>Tekstove je moguće stilizovati uz pomoc Markdown sintakse.</p>

  <h6 class="title is-6 mt-4">Naslovi</h6>
  <pre>
    # Naslov veličine 1
    ## Naslov veličine 2
    ### Naslov veličine 3
    #### Naslov veličine 4</pre>
  <h1 class="title is-1">Naslov veličine 1</h1>
  <h2 class="title is-2">Naslov veličine 2</h2>
  <h3 class="title is-3">Naslov veličine 3</h3>
  <h4 class="title is-4">Naslov veličine 4</h4>

  <h6 class="title is-6 mt-4">Stilizovanje teksta</h6>
  <pre>
    **Podebljan tekst**
    *Kurzivni tekst*
    > I ovo je citat</pre>

  <p class="mt-4"><strong>Podebljan tekst</strong></p>
  <p><em>Kurzivni tekst</em></p>
  <blockquote>I ovo je citat</blockquote>

  <h6 class="title is-6 mt-4">Liste</h6>
  <pre>
    - Prva stavka
    - Druga stavka
    - Treća stavka
      - Uvučena stavka
      - Uvučena stavka
    - Četvrta stavka</pre>

  <ul>
    <li>Prva stavka</li>
    <li>Druga stavka</li>
    <li>Treća stavka
      <ul>
        <li>Uvučena stavka</li>
        <li>Uvučena stavka</li>
      </ul>
    </li>
    <li>Četvrta stavka</li>
  </ul>

  <h6 class="title is-6 mt-4">Ostalo</h6>
  <pre class="mb-4">
    [Link](https://blogers.rasko-dev.website)
    ![blog_logo](logo.png)</pre>

  <p><a href="https://blogers.rasko-dev.website" target="_blank">Link</a></p>
  <p><img alt="blog_logo" src="/assets/image/logo.png" height="50" width="50" /></p>
</section>

<div id="image-modal" class="modal">
  <div id="image-modal-background" class="modal-background"></div>
  <button id="image-modal-close" class="modal-close is-large" aria-label="close"></button>
  <div class="modal-card">
    <section class="modal-card-body py-6">
      <div class="image-card">
        <div class="file is-boxed is-centered">
          <form id="image-form" enctype="multipart/form-data" action="/images" method="POST">
            <!--Frontend validation for max image size, in bytes-->
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
            <input type="hidden" name="blog" value="<?= $blogId ?>">
            <label class="file-label">
              <input id="image-input" class="file-input" type="file" name="images[]" multiple accept="image/*">
              <span class="file-cta">
              <span class="file-icon">
                <span class="material-icons-outlined">photo_camera</span>
              </span>
              <span class="file-label">
                Dodaj sliku
              </span>
            </span>
            </label>
          </form>
        </div>
      </div>
      <?php foreach ($images as $image) :?>
        <div class="image-card">
          <span class="material-icons-outlined image-card-delete">close</span>
          <img src="/storage/images/<?= $image->storageUuid ?>" alt="slika_<?= $image->name ?>" />
          <p class="control has-icons-right">
            <input
              id="url-input-<?= $image->id ?>"
              class="input is-small"
              type="text"
              value="![slika_<?= $image->name ?>](/storage/images/<?= $image->storageUuid ?>)"
              readonly
            />
            <span class="icon is-small is-right">
              <span class="material-icons-outlined is-clickable image-copy-icon" title="Kopiraj" data-image="<?= $image->id ?>">
                content_copy
              </span>
            </span>
          </p>
        </div>
      <?php endforeach ?>
    </section>
  </div>
</div>

</body>

<script>
  $(document).ready(() => {
    $("#sidebar-open").click(() => {
      $("#sidebar").addClass("sidebar_active");
    });
    $("#sidebar-close").click(() => {
      $("#sidebar").removeClass("sidebar_active");
    });

    $("#image-button").click(() => {
      $("#image-modal").addClass("is-active");
    });

    const closeImageModal = () => {
      $("#image-modal").removeClass("is-active");
    };

    $(".image-copy-icon").click((event) => {
      const imageId = event.target.dataset.image;
      $(`#url-input-${imageId}`).select();
      document.execCommand("copy");
    });

    // Automatically submit image form once user selects the file
    $('#image-input').change(() => $('#image-form').submit());

    $("#image-modal-background").click(closeImageModal);
    $("#image-modal-close").click(closeImageModal);
  });
</script>

</html>

