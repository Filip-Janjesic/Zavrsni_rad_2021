<?php
class Comments extends Model
{

    protected static $db_parameters = (['id','user','product','comment','comment_date','approved','where']);
    protected static $db_table ='comments';
    public $id;
    public $user;
    public $product;
    public $comment;
    public $comment_date;
    public $approved;
    public $where;

}