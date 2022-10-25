<?php
// Initialize view variables
$post = $post ?? null;
$images = $images ?? [];
?>

<!DOCTYPE html>
<html>
<?php include("./Views/Partials/Meta.php") ?>
<body class="post-create">
<?php include("./Views/Partials/Navigation.php") ?>
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
      <button class="button is-success is-rounded is-outlined mr-2" type="submit" form="post-form">
        Sačuvaj
      </button>
    </div>
  </div>
  <div class="container">
    <section class="section">
      <form class="post-form" id="post-form" method="POST" action="/posts/<?= $post->id ?>">
        <input type="hidden" name="_method" value="PUT" />
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
                  value="<?= $post->title ?>"
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
            ><?= $post->text ?></textarea>
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
  <pre class="mb-4">
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
            <input type="hidden" name="blog" value="<?= $post->blogId ?>">
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

