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

    .material-icons-outlined {
        opacity: 0.6;
        transition: transform 0.2s linear;
    }
    .material-icons-outlined:hover {
        opacity: 1;
        transform: scale(1.2);
    }

    .tab-body {
        display: none;
    }
    .tab-body.is-active {
        display: block;
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
    <h1 class="title is-flex is-justify-content-space-between">
      Tvoje priče
      <button class="button is-success is-rounded is-outlined">Napiši priču</button>
    </h1>
    <div class="tabs is-large">
      <ul>
        <li id="draft-tab" class="tab is-active" data-toggle="draft-section">
          <a>U pripremi <span class="tag is-rounded is-info ml-6">7</span></a>
        </li>
        <li id="published-tab" class="tab" data-toggle="published-section">
          <a>Objavljene <span class="tag is-rounded is-info ml-6">492</span></a>
        </li>
      </ul>
    </div>
    <section id="draft-section" class="section tab-body is-active">
      <ul class="post-list mb-6">
        <li>
          <div class="is-flex-grow-1">
            <h3 class="title is-5">Prvi test</h3>
            <h4 class="subtitle is-6">Ovo je podnaslov, malo duzi, prva recenica teksta</h4>
            <p class="is-size-7">Poslednji put izmenjeno pre 14 minuta. 124 reči do sad.</p>
          </div>
          <div>
            <span class="material-icons-outlined mr-2 is-clickable">published_with_changes</span>
            <span class="material-icons-outlined mr-2 is-clickable">edit</span>
            <span class="material-icons-outlined mr-2 is-clickable">delete_outline</span>
          </div>
        </li>
        <li>
          <div class="is-flex-grow-1">
            <h3 class="title is-5">Drugi tekst</h3>
            <h4 class="subtitle is-6">Ovo je podnaslov, malo duzi, prva recenica teksta</h4>
            <p class="is-size-7">Poslednji put izmenjeno pre 26 minuta. 130 reči do sad.</p>
          </div>
          <div>
            <span class="material-icons-outlined mr-2 is-clickable">published_with_changes</span>
            <span class="material-icons-outlined mr-2 is-clickable">edit</span>
            <span class="material-icons-outlined mr-2 is-clickable">delete_outline</span>
          </div>
        </li>
      </ul>
      <div class="pagination is-centered" role="navigation" aria-label="pagination">
        <a class="pagination-previous">Previous</a>
        <a class="pagination-next">Next page</a>
        <ul class="pagination-list">
          <li><a class="pagination-link" aria-label="Goto page 1">1</a></li>
          <li><span class="pagination-ellipsis">&hellip;</span></li>
          <li><a class="pagination-link" aria-label="Goto page 45">45</a></li>
          <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page">46</a></li>
          <li><a class="pagination-link" aria-label="Goto page 47">47</a></li>
          <li><span class="pagination-ellipsis">&hellip;</span></li>
          <li><a class="pagination-link" aria-label="Goto page 86">86</a></li>
        </ul>
      </div>
    </section>
    <section id="published-section" class="section tab-body">
      <div class="pagination is-centered" role="navigation" aria-label="pagination">
        <a class="pagination-previous">Previous</a>
        <a class="pagination-next">Next page</a>
        <ul class="pagination-list">
          <li><a class="pagination-link" aria-label="Goto page 1">1</a></li>
          <li><span class="pagination-ellipsis">&hellip;</span></li>
          <li><a class="pagination-link" aria-label="Goto page 45">45</a></li>
          <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page">46</a></li>
          <li><a class="pagination-link" aria-label="Goto page 47">47</a></li>
          <li><span class="pagination-ellipsis">&hellip;</span></li>
          <li><a class="pagination-link" aria-label="Goto page 86">86</a></li>
        </ul>
      </div>
    </section>
  </div>
</section>

</body>

<script>
  $(document).ready(() => {
    for (const tab of $(".tab")) {
      $(tab).click(event => {
        $(".tab").removeClass("is-active");
        $(event.currentTarget).addClass("is-active");
        $(".tab-body").removeClass("is-active");
        $(`#${$(event.currentTarget).data('toggle')}`).addClass("is-active");
      })
    }
  });
</script>

</html>

