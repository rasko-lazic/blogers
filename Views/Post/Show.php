<?php
// Initialize view variables
$post = $post ?? null;
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

    .post-container {
        display: flex;
        justify-content: center;
        padding: 2em;
    }

    .post-container .wrapper {
        min-width: 30em;
        max-width: 42em;
    }

    .post-container h1,
    .post-container h2,
    .post-container h3,
    .post-container h4,
    .post-container h5,
    .post-container h6 {
        margin-top: 1.25em;
        font-size: revert;
    }

    .post-container p {
        margin-top: 0.75em;
        font-size: 1.125em;
    }

    .post-container ul {
        list-style: inside;
        margin: 0.5em 1em;
    }

    .action-container {
        margin-top: 2em;
        padding-top: 2em;
        border-top: 1px solid #e6e6e6;
    }

    .fast-access {
        visibility: hidden;
        position: fixed;
        top: 15em;
        left: 5em;
        width: 10em;
        opacity: 0;
        transition: visibility 0s, opacity 0.5s linear;
    }

    .fast-access_active {
        visibility: visible;
        opacity: 1;
    }

      @media (max-width: 1250px) {
          .fast-access {
              display: none;
          }
      }

      .sidebar {
          position: fixed;
          top: 0;
          bottom: 0;
          right: -37vw;
          z-index: 1000;
          display: flex;
          flex-direction: column;
          width: 35vw;
          overflow: auto;
          padding: 2vw 4vw 2vw 2vw;
          box-shadow: -10px 8px 20px 0 rgba(0, 0, 0, 0.05);
          background-color: white;
          transition: all 0.8s cubic-bezier(.47,1.64,.41,.8);
      }

      .sidebar_active {
          right: -2vw;
      }

      .sidebar__close {
          position: absolute;
          top: 25px;
          right: 2.5vw;
          cursor: pointer;
      }

      .sidebar__overlay {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 70%;
          opacity: 0.8;
      }

      .sidebar__login-link {
          display: block;
          padding: 1em;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
          color: initial;
          opacity: 0.6;
      }

      .comment-input {
          display: flex;
          flex-direction: column;
          height: 3.5em;
          margin-bottom: 2em;
          padding: 1em;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
          transition: height 0.3s linear;
      }

      .comment-input__user,
      .comment-input__actions {
          height: 0;
          overflow: hidden;
          opacity: 0;
          transition: all 0.3s linear;
      }

      .comment-input_expanded {
          height: 10em;
      }

      .comment-input_expanded .comment-input__user,
      .comment-input_expanded .comment-input__actions{
          height: 2em;
          opacity: 1;
      }

      .comment-input__textarea {
          flex: 1;
          font-size: 1em;
          border: 0;
          outline: none;
          resize: none;
      }

      .comment-list {
          flex: 1;
          padding: 1em;
          overflow: auto;
          border-top: 1px solid #e6e6e6;
      }

      .comment-list__card {
          margin: 2em 0;
          border-bottom: 1px solid #e6e6e6;
          font-size: 0.875em;
      }

      .comment-list__avatar {
          width: 2rem;
          height: 2rem;
          margin-right: 1em;
          border-radius: 50%;
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
  <div class="post-container">
    <div class="wrapper">
      <h1 class="title size-1 mt-0"><?php echo $post->title ?? '' ?></h1>
      <?php echo $post->htmlText ?? 'Post is missing' ?>
      <div class="action-container">
        <span class="is-inline-flex is-align-items-center mr-4">
          <span class="material-icons-outlined is-size-3 is-clickable mr-2">favorite_border</span> 12
        </span>
        <span id="sidebar-open" class="material-icons-outlined is-size-3 is-clickable">forum</span>
      </div>
    </div>
  </div>

  <div id="fast-access" class="fast-access">
    <h3 class="subtitle is-6">Test Nalog</h3>
    <p class="is-size-7">
      Ovo je opis za ovaj test nalog. Ne bi trebalo da je previše dugačak
    </p>
    <div class="action-container">
        <span class="is-inline-flex is-align-items-center mr-4">
          <span class="material-icons-outlined is-size-3 is-clickable mr-2">favorite_border</span> 12
        </span>
      <span id="sidebar-open-fast" class="material-icons-outlined is-size-3 is-clickable">forum</span>
    </div>
  </div>
</section>

<section id="sidebar" class="sidebar">
  <h2 class="title is-size-4">Komentari</h2>
  <span id="sidebar-close" class="material-icons-outlined sidebar__close">
    close
  </span>

  <?php if (\Core\Session::check()): ?>
    <div id="comment-input" class="comment-input">
      <div class="comment-input__user">
        Test Account
      </div>
      <textarea
        class="comment-input__textarea"
        placeholder="Podeli svoje mišljenje sa ostalima"
      ></textarea>
      <div class="comment-input__actions has-text-right">
        <button id="comment-cancel" class="button is-small is-rounded is-danger is-inverted mr-2">
          Poništi
        </button>
        <button class="button is-small is-success is-rounded is-outlined">
          Podeli
        </button>
      </div>
    </div>
  <?php else: ?>
    <a class="sidebar__login-link" href="/?action=login">Podeli svoje mišljenje sa ostalima</a>
  <?php endif; ?>

  <ul class="comment-list">
    <li class="comment-list__card">
      <div class="is-flex is-align-items-center mb-4">
        <img class="comment-list__avatar" src="/assets/image/avatar.png" alt="user avatar">
        <div class="is-flex-grow-1">
          <p>Milan Milanov</p>
          <p class="has-text-grey-light">12:30</p>
        </div>
      </div>
      <p class="mb-2">
        Biće miholjska zima. Sve je sprženo. Kakva bre jesen, zima, to više ne postoji, kap kiše ne može da padne nedeljama. Ne razumem kako se ljudima to sviđa kada je evidentno da idemo u totalnu propast, biće nestašica i vode i struje, teške suše, totalni pakao
      </p>
      <span class="is-inline-flex is-align-items-center mb-2">
          <span class="material-icons-outlined is-size-3 is-clickable mr-2">favorite_border</span> 23
        </span>
    </li>
    <li class="comment-list__card">
      <div class="is-flex is-align-items-center mb-4">
        <img class="comment-list__avatar" src="/assets/image/avatar.png" alt="user avatar">
        <div class="is-flex-grow-1">
          <p>Milan Milanov</p>
          <p class="has-text-grey-light">12:30</p>
        </div>
      </div>
      <p class="mb-2">
        Biće miholjska zima. Sve je sprženo. Kakva bre jesen, zima, to više ne postoji, kap kiše ne može da padne nedeljama. Ne razumem kako se ljudima to sviđa kada je evidentno da idemo u totalnu propast, biće nestašica i vode i struje, teške suše, totalni pakao
      </p>
      <span class="is-inline-flex is-align-items-center mb-2">
          <span class="material-icons-outlined is-size-3 is-clickable mr-2">favorite_border</span> 23
        </span>
    </li>
    <li class="comment-list__card">
      <div class="is-flex is-align-items-center mb-4">
        <img class="comment-list__avatar" src="/assets/image/avatar.png" alt="user avatar">
        <div class="is-flex-grow-1">
          <p>Milan Milanov</p>
          <p class="has-text-grey-light">12:30</p>
        </div>
      </div>
      <p class="mb-2">
        Biće miholjska zima. Sve je sprženo. Kakva bre jesen, zima, to više ne postoji, kap kiše ne može da padne nedeljama. Ne razumem kako se ljudima to sviđa kada je evidentno da idemo u totalnu propast, biće nestašica i vode i struje, teške suše, totalni pakao
      </p>
      <span class="is-inline-flex is-align-items-center mb-2">
          <span class="material-icons-outlined is-size-3 is-clickable mr-2">favorite_border</span> 23
        </span>
    </li>
  </ul>
<!--  <div class="sidebar__overlay">-->
<!--    <div>-->
<!--      <p class="is-size-5 has-text-centered is-italic">Nema komentara za ovu priču.</p>-->
<!--      <p class="is-size-5 has-text-centered is-italic">Budi ti prvi!</p>-->
<!--    </div>-->
<!--  </div>-->

</section>

</body>

<script>
  $(document).ready(() => {

    let fastAccess = $("#fast-access");

    $(window).scroll(() => {
      if ($(window).scrollTop() > 800) {
        if (!fastAccess.hasClass("fast-access_active")) {
          fastAccess.addClass('fast-access_active');
        }
      } else if (fastAccess.hasClass("fast-access_active")) {
        fastAccess.removeClass('fast-access_active');
      }
    });

    $("#comment-input").click(() => {
      $("#comment-input").addClass('comment-input_expanded');
    });
    $("#comment-cancel").click(event => {
      event.stopPropagation();
      $("#comment-input").removeClass('comment-input_expanded');
    });

    $("#sidebar-open, #sidebar-open-fast").click(() => {
      $("#sidebar").addClass("sidebar_active");
    });

    $("#sidebar-close").click(() => {
      $("#sidebar").removeClass("sidebar_active");
    });
  });
</script>

</html>

