<?php 


class Util
{ 

    public static function Pagination($pagination)
    {?>
        <?php if($pagination['itemsNumber'] >= 1):?>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="<?= App::config('url').$pagination['path']. '1' ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php for ($i=$pagination['page']-2; $i <= $pagination['maxPage']; $i++): ?>
                <?php if($i > 0 && $i <= $pagination['itemsNumber']): ?>
                    <?php if($pagination['page'] == $i): ?>
                    <li class='page-item active'><a class='page-link' href='<?= App::config('url').$pagination['path']. $i ?>'><?= $i ?></a></li>
                    <?php else:?>
                    <li class='page-item'><a class='page-link' href='<?= App::config('url').$pagination['path']. $i ?>'><?= $i ?></a></li>
                    <?php endif ?> 
                <?php endif ?>
            <?php endfor ?>

            <li class="page-item">
                <a class="page-link" href="<?= App::config('url').$pagination['path']. $pagination['itemsNumber'] ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
                </a>
            </li>
            </ul>
        </nav>
        <?php endif?>
<?php
    }
    public static function stars($rating, $size){
            if (is_numeric($rating)){
        ?>
            <?php for ($i=0; $i < floor($rating); $i++):?>
              <i class="fas <?=$size?> fa-star"></i>
            <?php endfor?>
            <?php if($rating - floor($rating) <= 0.2  && $rating - floor($rating) > 0.0 ): ?>
                <i class="far <?=$size?> fa-star"></i>
            <?php elseif($rating - floor($rating) > 0.2 && $rating - floor($rating) < 0.8 ): ?>
                <i class="fas <?=$size?> fa-star-half-alt"></i>
            <?php elseif($rating - floor($rating) <= 0.8  && $rating - floor($rating) > 1 ): ?>
                <i class="fas <?=$size?> fa-star"></i>
            <?php endif?>     
            <?php for ($i=0; $i < 5-ceil($rating); $i++):?>
              <i class="far <?=$size?> fa-star"></i>
            <?php endfor?>
<?php
            }else{
                echo "no rating";
            }
    }
    public static function ordersList($orderInner)
    {
        ?>
        <h3 style ="color:green">Transaction -<?= $orderInner[0] -> transaction_id;?></h3>
    <br>
    <!-- Shopping Cart-->
    <div class="table-responsive shopping-cart">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-center">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderInner as $key):?>
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="<?= App::config('url');?>/public/images/<?=$key->image?>" alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="<?= App::config('url');?>index/productpage/<?=$key->id ?>"><?= $key->brand_name?></a></h4><span><em>Manufacturer:</em> <?= $key->manufacturer ?></span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">$<?= $key->price?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php }
}
?>