<?php
// Initialize view variables
$blogs = $blogs ?? [];
?>

<!DOCTYPE html>
<html>
<?php include("./Views/Partials/Meta.php") ?>
<body>
<?php include("./Views/Partials/Navigation.php") ?>
<section class="section">
  <div class="container">
    <?php foreach ($blogs as $blog) :?>
      <div class="blog-line">
        <img id="blog-logo-<?= $blog->id ?>" class="blog-line__logo" src="https://picsum.photos/100?blur=2&random=<?= $blog->id ?>" alt="blog_logo" />
        <div class="is-flex is-align-content-center is-flex-grow-1">
          <div class="mr-6">
            <p id="blog-title-<?= $blog->id ?>" class="is-size-4"><?= $blog->name ?></p>
            <p id="blog-description-<?= $blog->id ?>"><?= $blog->description ?></p>
          </div>
          <div id="blog-tags-<?= $blog->id ?>" class="tags are-small is-flex-grow-1 mr-4">
            <?php foreach ($blog->tags as $tag) :?>
              <span class="tag"><?= $tag->name ?></span>
            <?php endforeach ?>
          </div>
        </div>
        <div style="white-space: nowrap">
          <a class="material-icons-outlined mr-2 is-clickable c-inherit" href="/blogs/<?= $blog->id ?>">add</a>
          <span class="edit-blog material-icons-outlined mr-2 is-clickable" data-blog="<?= $blog->id ?>">
            edit
          </span>
          <button class="material-icons-outlined is-clickable" type="submit" form="blog-delete-<?= $blog->id ?>">
            delete_outline
          </button>
        </div>
        <form id="blog-delete-<?= $blog->id ?>" action="/blogs/<?= $blog->id ?>" method="POST">
          <input type="hidden" name="_method" value="DELETE">
        </form>
      </div>
    <?php endforeach ?>
    <div id="new-blog-button" class="py-4 has-text-centered">
      <span class="material-icons-outlined is-size-2 is-clickable">add_circle_outline</span>
    </div>
  </div>
</section>

<div id="blog-modal" class="modal">
  <div id="blog-modal-background" class="modal-background"></div>
  <button id="blog-modal-close" class="modal-close is-large" aria-label="close"></button>
  <div class="modal-card">
    <header class="modal-card-head py-6">
      <p id="modal-title" class="modal-card-title has-text-centered">Novi blog</p>
    </header>
    <section class="modal-card-body py-6">
      <form id="blog-form" method="POST" action="/blogs">
        <div class="file is-boxed is-centered mb-4">
          <label class="file-label">
            <input class="file-input" type="file" name="logo">
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
            <input id="title" class="input is-large" type="text" name="name" placeholder="Naziv bloga" />
          </div>
        </div>
        <div class="field">
          <div class="control">
            <textarea id="description" class="textarea has-fixed-size" name="description" placeholder="Opis bloga"></textarea>
          </div>
        </div>
        <div class="field">
          <div class="control">
            <input id="tags" class="input" type="text" name="tags" data-type="tags" placeholder="Tagovi">
          </div>
        </div>
        <button class="button is-medium is-fullwidth is-primary mt-4">Sačuvaj</button>
      </form>
    </section>
  </div>
</div>

</body>

<script>
  $(document).ready(() => {
    const tagsInput = new BulmaTagsInput('#tags');
    const blogForm = $("#blog-form");
    const modalTitle = $("#modal-title");

    // Register modal triggers
    const blogModal = $("#blog-modal");
    const closeNewModalBlog = () => {
      blogForm.attr('method', 'POST');
      blogForm.attr('action', '/blogs');
      modalTitle.text('Novi blog')
      // If hidden method field exists, lets remove it
      $('#put-method').remove()

      blogModal.removeClass("is-active");
      $("#title").val('');
      $("#description").val('');
      tagsInput.flush();
    };

    $(".edit-blog").click(event => {
      const blogId = event.target.dataset.blog;
      // We need to dynamically add hidden method input to simulate PUT request
      $('<input>').attr({id: 'put-method', type: 'hidden', name: '_method', value: 'PUT'}).appendTo(blogForm);
      blogForm.attr('action', `/blogs/${blogId}`);
      modalTitle.text('Izmeni blog');

      // const logo = $(`#blog-logo-${blogId}`);
      const title = $(`#blog-title-${blogId}`).text();
      const description = $(`#blog-description-${blogId}`).text();
      const tags = $(`#blog-tags-${blogId}`).children().toArray().map(c => c.innerHTML);

      $("#title").val(title);
      $("#description").val(description);
      tags.forEach(t => tagsInput.add(t));

      blogModal.addClass("is-active");
    });

    $("#new-blog-button").click(() => {
      blogModal.addClass("is-active");
    });
    $("#blog-modal-background").click(closeNewModalBlog);
    $("#blog-modal-close").click(closeNewModalBlog);
  });
</script>

</html>

