<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">نظام إدارة الطلاب</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">القائمة الرئيسية</a>
        </li>
      </ul>
      <span class="navbar-text">
        اهلا بك <?= $_SESSION['user_name'] ?>
      </span>
      <a class="btn btn-sm btn-danger ms-2" href="index.php?logout">Logout</a>
    </div>
  </div>
</nav>