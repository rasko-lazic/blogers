<?php
// Initialize view variables
$users = [
    [
        'id' => 1,
        'firstname' => 'Rasko',
        'lastname' => 'Lazic',
        'username' => 'rasko_lazic',
        'email' => 'rasko@test.com',
        'created_at' => '2022-04-21',
    ],
    [
        'id' => 2,
        'firstname' => 'Jelena',
        'lastname' => 'Stefanovic',
        'username' => 'test_nalog',
        'email' => 'jelena@gmail.com',
        'created_at' => '2022-05-18',
    ],
    [
        'id' => 3,
        'firstname' => 'Zeljko',
        'lastname' => 'Jovanovic',
        'username' => 'zeljko_jovanovic',
        'email' => 'zeljko@test.com',
        'created_at' => '2022-03-12',
    ],
    [
        'id' => 4,
        'firstname' => 'Milan',
        'lastname' => 'Milanovic',
        'username' => 'milan_90',
        'email' => 'milan@test.com',
        'created_at' => '2022-02-18',
    ],
    [
        'id' => 5,
        'firstname' => 'Marija',
        'lastname' => 'Stulic',
        'username' => 'marija_beograd',
        'email' => 'marija@test.com',
        'created_at' => '2022-03-19',
    ],
    [
        'id' => 6,
        'firstname' => 'Dejan',
        'lastname' => 'Taranovic',
        'username' => 'taran',
        'email' => 'dejan@test.com',
        'created_at' => '2022-01-07',
    ],
];
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
          <a id="user-panel" class="panel-block is-active">
            <i class="panel-icon material-icons-outlined">group</i> Korisnici
          </a>
          <a id="blog-panel" class="panel-block">
            <i class="panel-icon material-icons-outlined">menu_book</i> Blogovi
          </a>
          <a id="post-panel" class="panel-block">
            <i class="panel-icon material-icons-outlined">post_add</i> Blog unosi
          </a>
          <a id="comment-panel" class="panel-block">
            <i class="panel-icon material-icons-outlined">forum</i> Komentari
          </a>
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
              <th><?= $user['id'] ?></th>
              <td><?= $user['firstname'] ?></td>
              <td><?= $user['lastname'] ?></td>
              <td><?= $user['username'] ?></td>
              <td><?= $user['email'] ?></td>
              <td><?= $user['created_at'] ?></td>
              <td>
                <button class="material-icons-outlined is-clickable mr-4">
                  edit
                </button>
                <button class="material-icons-outlined is-clickable">
                  delete_outline
                </button>
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
          <tr>
            <th>1</th>
            <td>Test Blog</td>
            <td>This is a test description for test blog</td>
            <td>
              <div class="tags are-small">
                <span class="tag">Veze</span>
                <span class="tag">Produktivnost</span>
                <span class="tag">Politika</span>
                <span class="tag">Poznati</span>
              </div>
            </td>
            <td>Rasko Lazic</td>
            <td>2022-05-22</td>
            <td>
              <button class="material-icons-outlined is-clickable">
                delete_outline
              </button>
            </td>
          </tr>
          </tbody>
        </table>

        <table id="post-table" class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" style="display: none">
          <thead>
          <tr>
            <th>ID</th>
            <th>Blog</th>
            <th>Title</th>
            <th>Comments enabled</th>
            <th>Draft</th>
            <th>Hidden</th>
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
            <th>Comments enabled</th>
            <th>Draft</th>
            <th>Hidden</th>
            <th>Owned by</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
          </tfoot>
          <tbody>
          <tr>
            <th>76</th>
            <td>Test blog</td>
            <td>Test post</td>
            <td>1</td>
            <td>0</td>
            <td>0</td>
            <td>Rasko Lazic</td>
            <td>2022-05-14</td>
            <td>
              <button class="material-icons-outlined is-clickable">
                delete_outline
              </button>
            </td>
          </tr>
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
          <tr>
            <th>27</th>
            <td>Test post</td>
            <td>This is a test comment</td>
            <td>42</td>
            <td>Rasko Lazic</td>
            <td>2022-05-14</td>
            <td>
              <button class="material-icons-outlined is-clickable">
                delete_outline
              </button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
</body>

<script>
  $(document).ready(() => {
    const panelBlocks = $('.panel-block');
    const tables = $('.table');

    const setPanel = (panel) => {
      panelBlocks.removeClass('is-active');
      tables.hide();
      $(`#${panel}-panel`).addClass('is-active');
      $(`#${panel}-table`).show();
      return true;
    };

    $('#user-panel').click(() => setPanel('user'));
    $('#blog-panel').click(() => setPanel('blog'));
    $('#post-panel').click(() => setPanel('post'));
    $('#comment-panel').click(() => setPanel('comment'));
  });
</script>

</html>

