<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?= App::config('url'); ?>"><?= App::config('siteTitle'); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= App::config('url'); ?>">Buy <span class="sr-only">(current)</span></a>
      </li>
      <?php if(request::isLogin()):?>
      <li class="nav-item">
        <a class="nav-link" href="<?= App::config('url'); ?>index/mybooks">My books</a>
      </li>
      <?php if(!empty($_SESSION['Cart'])):?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cart(<?=isset($_SESSION['Cart'])? count($_SESSION['Cart']):0 ?>)
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a style="padding:20px;" class="text-center" >Items (<?=isset($_SESSION['Cart'])? count($_SESSION['Cart']):0 ?>)</a>
          <hr>
          <a style="padding:20px;" class="text-center" >Price (<?=isset($_SESSION['Cart'])? producthelper::totalprice():0?>)</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= App::config('url'); ?>cart">Go to cart</a>
        </div>
      </li>
      <?php endif ?>
      <?php endif ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= App::config('url'); ?>index/contact">Contact</a>
      </li>