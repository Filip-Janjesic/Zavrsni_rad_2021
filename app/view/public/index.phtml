1<?php if(isset($_SESSION['confirmMsg'])):?>
  <h3 style="color:green"><?=$_SESSION['confirmMsg'];?></h3>
<?php endif;?>

<?php if(!isset($_SERVER['REDIRECT_PATH_INFO'])): ?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  <?php for ($i=0; $i < count($visible) ; $i++):?>
    <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i ?>" class="<?php if($i == 0) echo 'active'?>"></li>
    <?php endfor?>
  </ol>
  <div class="carousel-inner">
  <?php for ($i=0; $i < count($visible) ; $i++):?>
    <div class="carousel-item <?php if($i == 0) echo 'active'; ?>">
      <img alt="slideshow-image" class="d-block w-100" src="../../public/images/<?= $visible[$i]->photo?>"></div>
    <?php endfor?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php endif ?>
<hr><br>
<div class="container">
   <div class="row">
       <div class="col-md-3">  
       <div id="list-example" class="list-group">
        <h3 class="text-center">Categories</h3>
            <hr>
            <a class="list-group-item list-group-item-action" href="<?= App::config('url')?>">See all</a>
            <?php foreach($categories as $category): ?>
            <a class="list-group-item list-group-item-action" href="<?= App::config('url'); ?>Index/index/<?= $category->id ?>"><?= $category->name; ?>(<?= $ProductsInCategory[$category->name] ?>)</a>
            <?php endforeach;?>
        </div>
       </div>
       <div class="col-md-9">
        <h2 class="text-center"><?= $bigTitle ?></h2>
        <?php if(isset($displayCategory)):?>
          <hr>
          <h3 class="text-center"><?=$displayCategory ?></h3>
        <?php endif ?>
        <hr>
            <div class="container">
                <div class="row">
                    <?php foreach($products as $product): ?>
                    <div class="col-md-4 mt-5">  
                        <div class="card" style="width: 14rem;">
                        <?php if(isset($product->discount) && $product->discount != '%') :?>
                        <h2 style="background-color:green" class="card-text text-center">Special offer</h2>
                        <?php endif?>
                            <img style ="max-height:200px" class="card-img-top" src="../../public/images/<?= $product->image ?>" alt="Product-image">
                            <div class="card-body">
                                <a href="<?=App::config('url')?>Index/productpage/<?= $product->id ?>"><h4 class="card-title text-center"><?= $product->title?></h4></a>
                                <p class="card-text text-center"><?php Request::LimitString($product->content,95) ?></p>
                                <p class="card-text text-center"> Author: <?= $product->author ?></p>
                                <?php if(isset($product->discount) && $product->discount != '%') :?>
                                <h5 style="color:red" class="card-text text-center"> <s>Price: <?= $product->price ?>$</s></h5>
                                <h5 class="card-text text-center"> Discount: <?= $product->discount ?>%</h5>
                                <h5 style="color:green" class="card-text text-center"> Price: <?= $product->price * (1-(producthelper::floatDiscount($product->discount))) ?>$</h5>
                                <?php else:?>
                                <h5 class="card-text text-center"> Price: <?= $product->price ?>$</h5>
                                <?php endif?>
                                <p class="card-text text-center"> Rating: <?=Util::stars($product->rating,'')?></p>
                            </div>
                            <?php if(in_array($product->id,(array)$purchased)): ?>
                              <a href="<?=App::config('url')?>Index/productpage/<?= $product->id ?>" class="btn btn-success btn-lg btn-block">Purchased</a>
                              <?php else:?>
                                <a href="<?=App::config('url')?>Index/productpage/<?= $product->id ?>" class="btn btn-primary btn-lg btn-block">Buy</a>
                                <?php endif ?>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
                <br>
                <?=Util::Pagination($pagination)?>
            </div>
       </div>
    </div>
</div>