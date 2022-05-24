<?php
class Bought extends Model
{
    protected static $db_parameters = (['orders','product','price','where']);
    protected static $db_table ='bought';
    public $orders;
    public $product;
    public $price;
    public $where;

    public static function selectAllPrices()
    {
        $connection= DB::getInstance();
        $sql = 
        '
            select 
            b.price,a.title
            from bought b 
            left join products a on b.product = a.id;
        ';
        $result = $connection -> prepare($sql);
        $result -> execute();
        return $result -> fetchAll();
    }
}