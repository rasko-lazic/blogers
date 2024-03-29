<?php
// Initialize view variables
$blog = $blog ?? null;
$post = $post ?? null;
$comments = $comments ?? [];
?>

<!DOCTYPE html>
<html>
<?php include("./Views/Partials/Meta.php") ?>
<body>
<?php include("./Views/Partials/Navigation.php") ?>
<section class="section">
  <div class="post-container">
    <div class="wrapper">
      <h1 class="title size-1 mt-0"><?= $post->title ?? '' ?></h1>
      <div class="action-container has-text-right">
        <?php if (\Core\Session::check()) :?>
          <form class="is-inline-block mr-4" action="/posts/favorite/<?= $post->id ?>" method="POST">
            <span class="is-inline-flex is-align-items-center">
              <button class="material-icons-outlined is-clickable is-size-3 mr-2 <?= $post->isFavorite ? 'is-favorite' : '' ?>">
                  <?= $post->isFavorite ? 'bookmark_added' : 'bookmark_border' ?>
              </button><?= $post->favoriteCount ?>
            </span>
          </form>
        <?php else :?>
          <span class="is-inline-flex is-align-items-center mr-4">
            <span class="material-icons-outlined is-size-3 mr-2">bookmark_border</span><?= $post->favoriteCount ?>
          </span>
        <?php endif ?>
        <span class="is-inline-flex is-align-items-center mr-4">
          <span id="sidebar-open" class="material-icons-outlined is-size-3 mr-2 is-clickable">forum</span><?= count($comments) ?>
        </span>
      </div>
      <?= $post->htmlText ?? 'Post is missing' ?>
      <div class="action-container">
          <?php if (\Core\Session::check()) :?>
            <form class="is-inline-block mr-4" action="/posts/favorite/<?= $post->id ?>" method="POST">
            <span class="is-inline-flex is-align-items-center">
              <button class="material-icons-outlined is-clickable is-size-3 mr-2 <?= $post->isFavorite ? 'is-favorite' : '' ?>">
                  <?= $post->isFavorite ? 'bookmark_added' : 'bookmark_border' ?>
              </button><?= $post->favoriteCount ?>
            </span>
            </form>
          <?php else :?>
            <span class="is-inline-flex is-align-items-center mr-4">
            <span class="material-icons-outlined is-size-3 mr-2">bookmark_border</span><?= $post->favoriteCount ?>
          </span>
          <?php endif ?>
        <span class="is-inline-flex is-align-items-center mr-4">
          <span id="sidebar-open" class="material-icons-outlined is-size-3 is-clickable">forum</span><?= count($comments) ?>
        </span>
      </div>
    </div>
  </div>

  <div id="fast-access" class="fast-access">
    <h3 class="subtitle is-6"><?= $blog->name ?? '' ?></h3>
    <p class="is-size-7"><?= $blog->description ?? '' ?></p>
    <div class="action-container">
        <?php if (\Core\Session::check()) :?>
          <form class="is-inline-block mr-4" action="/posts/favorite/<?= $post->id ?>" method="POST">
            <span class="is-inline-flex is-align-items-center">
              <button class="material-icons-outlined is-clickable is-size-3 mr-2 <?= $post->isFavorite ? 'is-favorite' : '' ?>">
                  <?= $post->isFavorite ? 'bookmark_added' : 'bookmark_border' ?>
              </button><?= $post->favoriteCount ?>
            </span>
          </form>
        <?php else :?>
          <span class="is-inline-flex is-align-items-center mr-4">
            <span class="material-icons-outlined is-size-3 mr-2">bookmark_border</span><?= $post->favoriteCount ?>
          </span>
        <?php endif ?>
      <span class="is-inline-flex is-align-items-center mr-4">
        <span id="sidebar-open-fast" class="material-icons-outlined is-size-3 is-clickable mr-2">forum</span><?= count($comments) ?>
      </span>
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
        <?= \Core\Session::getUser()->firstName ?>
      </div>
      <form class="is-flex is-flex-direction-column is-flex-grow-1" action="/posts/<?= $post->id ?>/comments" method="POST" >
        <textarea class="comment-input__textarea" placeholder="Podeli svoje mišljenje sa ostalima" name="text"></textarea>
        <div class="comment-input__actions has-text-right">
          <button id="comment-cancel" type="reset" class="button is-small is-rounded is-danger is-inverted mr-2">
            Poništi
          </button>
          <button type="submit" class="button is-small is-success is-rounded is-outlined">
            Podeli
          </button>
        </div>
      </form>
    </div>
  <?php else: ?>
    <a class="sidebar__login-link" href="/?action=login">Podeli svoje mišljenje sa ostalima</a>
  <?php endif; ?>

  <ul class="comment-list">
    <?php foreach ($comments as $comment) :?>
      <li class="comment-list__card">
        <div class="is-flex is-align-items-center mb-4">
          <img class="comment-list__avatar" src="https://picsum.photos/seed/<?= $comment->user->id ?>/100?random=<?= $comment->user->id ?>" alt="user avatar">
          <div class="is-flex-grow-1">
            <p><?= "{$comment->user->firstName} {$comment->user->lastName}" ?></p>
            <p class="has-text-grey-light"><?= $comment->createdAt ?></p>
          </div>
        </div>
        <p class="mb-2"><?= $comment->text ?></p>
        <span class="is-inline-flex is-align-items-center mb-2">
          <?php if (\Core\Session::check()) :?>
            <form action="/comments/favorite/<?= $comment->id ?>" method="POST">
              <button class="material-icons-outlined is-size-3 mr-2 is-clickable <?= $comment->isFavorite ? 'is-favorite' : '' ?>">
                <?= $comment->isFavorite ? 'favorite' : 'favorite_border' ?>
              </button>
            </form>
            <span><?= $comment->favoriteCount ?></span>
          <?php endif ?>
        </span>
      </li>
    <?php endforeach ?>
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

  // Restore scroll position after favorite toggle
  document.addEventListener("DOMContentLoaded", () => {
    let scrollPosition = localStorage.getItem('scrollPositionPost');
    if (scrollPosition) {
      window.scrollTo(0, +scrollPosition);
    }
  });

  window.onbeforeunload = function() {
    localStorage.setItem('scrollPositionPost', String(window.scrollY));
  };

  $(document).ready(() => {

    // If we are redirected after comment store, open comment sidebar
    if (window.location.hash && window.location.hash === '#comments') {
      $("#sidebar").addClass("disable-transition");
      $("#sidebar").addClass("sidebar_active");
      setTimeout(() => $("#sidebar").toggleClass("disable-transition"), 100);
    }

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

