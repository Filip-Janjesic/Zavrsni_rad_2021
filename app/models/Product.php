<?php
class Products extends Model
{
    protected static $db_parameters = (['id','brand_name', 'manufacturer', 'image', 'price', 'category','content','visible', 'pdf','date_of_manufacture','discount','where']);
    protected static $db_table ='products';
    public $id;
    public $brand_name;
    public $manufacturer;
    public $image;
    public $price;
    public $category;
    public $content;
    public $visible;
    public $pdf;
    public $date_of_manufacture;
    public $discount;
    public $where;
}