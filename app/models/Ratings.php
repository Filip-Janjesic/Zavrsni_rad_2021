<?php
class Ratings extends Model
{

    protected static $db_parameters = (['user','product','rating','where']);
    protected static $db_table ='rating';
    public $user;
    public $product;
    public $rating;
    public $where;

}
