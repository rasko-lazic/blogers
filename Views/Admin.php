<?php
// Initialize view variables
$users = $users ?? [];
$blogs = $blogs ?? [];
$posts = $posts ?? [];
$comments = $comments ?? [];
?>

<!DOCTYPE html>
<html>
<?php include("./Views/Partials/Meta.php") ?>
<body>
<?php include("./Views/Partials/Navigation.php") ?>
<section class="section">
  <div class="container is-fluid">
    <div class="columns">
      <div class="column is-one-quarter">
        <article class="panel is-primary">
          <p class="panel-heading">
            Admin sekcija
          </p>
          <span id="user-panel" class="panel-block is-clickable is-active">
            <i class="panel-icon material-icons-outlined">group</i> Korisnici
          </span>
          <span id="blog-panel" class="panel-block is-clickable">
            <i class="panel-icon material-icons-outlined">menu_book</i> Blogovi
          </span>
          <span id="post-panel" class="panel-block is-clickable">
            <i class="panel-icon material-icons-outlined">post_add</i> Blog unosi
          </span>
          <span id="comment-panel" class="panel-block is-clickable">
            <i class="panel-icon material-icons-outlined">forum</i> Komentari
          </span>
        </article>
      </div>
      <div class="column">
        <table id="user-table" class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
          <thead>
          <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
          </tfoot>
          <tbody>
            <?php foreach ($users as $user) :?>
              <tr>
                <th><?= $user->id ?></th>
                <td><?= $user->firstName ?></td>
                <td><?= $user->lastName ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->createdAt ?></td>
                <td>
                  <button class="material-icons-outlined is-clickable mr-4">
                    edit
                  </button>
                  <form class="is-inline-block" action="/admin/user/<?= $user->id ?>" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="material-icons-outlined is-clickable">delete_outline</button>
                  </form>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

        <table id="blog-table" class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="display: none">
          <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Tags</th>
            <th>Owned by</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Tags</th>
            <th>Owned by</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
          </tfoot>
          <tbody>
            <?php foreach ($blogs as $blog) :?>
              <tr>
                <th><?= $blog->id ?></th>
                <td><?= $blog->name ?></td>
                <td><?= $blog->description ?></td>
                <td>
                  <div class="tags are-small">
                    <?php foreach ($blog->tags as $tag) :?>
                      <span class="tag"><?= $tag->name ?></span>
                    <?php endforeach ?>
                  </div>
                </td>
                <td><?= $blog->user->name ?></td>
                <td><?= $blog->createdAt ?></td>
                <td>
                  <form action="/admin/blog/<?= $blog->id ?>" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="material-icons-outlined is-clickable">delete_outline</button>
                  </form>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

        <table id="post-table" class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="display: none">
          <thead>
          <tr>
            <th>ID</th>
            <th>Blog</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Comments enabled</th>
            <th>Draft</th>
            <th>Owned by</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th>ID</th>
            <th>Blog</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Comments enabled</th>
            <th>Draft</th>
            <th>Owned by</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
          </tfoot>
          <tbody>
            <?php foreach ($posts as $post) :?>
              <tr>
                <th><?= $post->id ?></th>
                <td><?= $post->blog->name ?></td>
                <td><?= $post->title ?></td>
                <td><?= $post->slug ?></td>
                <td><?= $post->commentsEnabled ?></td>
                <td><?= $post->isDraft ?></td>
                <td><?= $post->user->name ?></td>
                <td><?= $post->createdAt ?></td>
                <td>
                  <form action="/admin/post/<?= $post->id ?>" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="material-icons-outlined is-clickable">delete_outline</button>
                  </form>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

        <table id="comment-table" class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="display: none">
          <thead>
          <tr>
            <th>ID</th>
            <th>Post title</th>
            <th>Text</th>
            <th>Like count</th>
            <th>Owned by</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th>ID</th>
            <th>Post title</th>
            <th>Text</th>
            <th>Like count</th>
            <th>Owned by</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
          </tfoot>
          <tbody>
            <?php foreach ($comments as $comment) :?>
              <tr>
                <th><?= $comment->id ?></th>
                <td><?= $comment->post->title ?></td>
                <td><?= $comment->text ?></td>
                <td><?= $comment->favoriteCount ?></td>
                <td><?= $comment->user->name ?></td>
                <td><?= $comment->createdAt ?></td>
                <td>
                  <form action="/admin/comment/<?= $comment->id ?>" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="material-icons-outlined is-clickable">delete_outline</button>
                  </form>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
</body>

<script>
  $(document).ready(() => {
    const panels = [
      'user',
      'blog',
      'post',
      'comment',
    ];

    const panelBlocks = $('.panel-block');
    const tables = $('.table');

    const setPanel = (panel) => {
      panelBlocks.removeClass('is-active');
      tables.hide();
      $(`#${panel}-panel`).addClass('is-active');
      $(`#${panel}-table`).show();
      return true;
    };

    // Check if we need to redirect user to a specific tab
    if (window.location.hash && panels.includes(window.location.hash.substring(1))) {
      setPanel(window.location.hash.substring(1))
    }

    $('#user-panel').click(() => setPanel('user'));
    $('#blog-panel').click(() => setPanel('blog'));
    $('#post-panel').click(() => setPanel('post'));
    $('#comment-panel').click(() => setPanel('comment'));
  });
</script>

</html>

