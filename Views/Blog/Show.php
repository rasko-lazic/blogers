<?php
// Initialize view variables
$blogId = $blogId ?? 0;
$draftPosts = $draftPosts ?? [];
$publishedPosts = $publishedPosts ?? [];
?>

<!DOCTYPE html>
<html>
<?php include("./Views/Partials/Meta.php") ?>
<body>
<?php include("./Views/Partials/Navigation.php") ?>
<section class="section">
  <div class="container">
    <h1 class="title is-flex is-justify-content-space-between">
      Tvoje priče
      <a class="button is-success is-rounded is-outlined" href="/blogs/<?= $blogId ?>/posts">
        Napiši priču
      </a>
    </h1>
    <div class="tabs is-large">
      <ul>
        <li id="draft-tab" class="tab is-active" data-toggle="draft-section">
          <a>U pripremi <span class="tag is-rounded is-info ml-6"><?= count($draftPosts) ?></span></a>
        </li>
        <li id="published-tab" class="tab" data-toggle="published-section">
          <a>Objavljene <span class="tag is-rounded is-info ml-6"><?= count($publishedPosts) ?></span></a>
        </li>
      </ul>
    </div>
    <section id="draft-section" class="section tab-body is-active">
      <ul class="post-list mb-6">
        <?php foreach ($draftPosts as $draftPost) :?>
          <li>
            <div class="is-flex-grow-1">
              <a class="title is-5 is-block" href="/<?= $draftPost->slug ?>" target="_blank">
                <?= $draftPost->title ?>
              </a>
              <h4 class="subtitle is-6">Ovo je podnaslov, malo duzi, prva recenica teksta</h4>
              <p class="is-size-7">Poslednji put izmenjeno pre 14 minuta. 124 reči do sad.</p>
            </div>
            <div>
              <span class="material-icons-outlined mr-2 is-clickable">published_with_changes</span>
              <span class="material-icons-outlined mr-2 is-clickable">edit</span>
              <button class="material-icons-outlined mr-2 is-clickable" type="submit" form="post-delete-<?= $draftPost->id ?>">
                delete_outline
              </button>
            </div>
            <form id="post-delete-<?= $draftPost->id ?>" action="/posts/<?= $draftPost->id ?>" method="POST">
              <input type="hidden" name="_method" value="DELETE">
            </form>
          </li>
        <?php endforeach ?>
      </ul>
<!--      <div class="pagination is-centered" role="navigation" aria-label="pagination">-->
<!--        <a class="pagination-previous">Previous</a>-->
<!--        <a class="pagination-next">Next page</a>-->
<!--        <ul class="pagination-list">-->
<!--          <li><a class="pagination-link" aria-label="Goto page 1">1</a></li>-->
<!--          <li><span class="pagination-ellipsis">&hellip;</span></li>-->
<!--          <li><a class="pagination-link" aria-label="Goto page 45">45</a></li>-->
<!--          <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page">46</a></li>-->
<!--          <li><a class="pagination-link" aria-label="Goto page 47">47</a></li>-->
<!--          <li><span class="pagination-ellipsis">&hellip;</span></li>-->
<!--          <li><a class="pagination-link" aria-label="Goto page 86">86</a></li>-->
<!--        </ul>-->
<!--      </div>-->
    </section>
    <section id="published-section" class="section tab-body">
      <ul class="post-list mb-6">
          <?php foreach ($publishedPosts as $publishedPost) :?>
            <li>
              <div class="is-flex-grow-1">
                <a class="title is-5 is-block" href="/<?= $publishedPost->slug ?>" target="_blank">
                    <?= $publishedPost->title ?>
                </a>
                <h4 class="subtitle is-6">Ovo je podnaslov, malo duzi, prva recenica teksta</h4>
                <p class="is-size-7">Poslednji put izmenjeno pre 14 minuta. 124 reči do sad.</p>
              </div>
              <div>
                <span class="material-icons-outlined mr-2 is-clickable">published_with_changes</span>
                <span class="material-icons-outlined mr-2 is-clickable">edit</span>
                <button class="material-icons-outlined mr-2 is-clickable" type="submit" form="post-delete-<?= $publishedPost->id ?>">
                  delete_outline
                </button>
              </div>
              <form id="post-delete-<?= $publishedPost->id ?>" action="/posts/<?= $publishedPost->id ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
              </form>
            </li>
          <?php endforeach ?>
      </ul>
<!--      <div class="pagination is-centered" role="navigation" aria-label="pagination">-->
<!--        <a class="pagination-previous">Previous</a>-->
<!--        <a class="pagination-next">Next page</a>-->
<!--        <ul class="pagination-list">-->
<!--          <li><a class="pagination-link" aria-label="Goto page 1">1</a></li>-->
<!--          <li><span class="pagination-ellipsis">&hellip;</span></li>-->
<!--          <li><a class="pagination-link" aria-label="Goto page 45">45</a></li>-->
<!--          <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page">46</a></li>-->
<!--          <li><a class="pagination-link" aria-label="Goto page 47">47</a></li>-->
<!--          <li><span class="pagination-ellipsis">&hellip;</span></li>-->
<!--          <li><a class="pagination-link" aria-label="Goto page 86">86</a></li>-->
<!--        </ul>-->
<!--      </div>-->
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

