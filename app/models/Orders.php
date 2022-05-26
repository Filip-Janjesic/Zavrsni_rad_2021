<?php
class Orders extends Model
{
    protected static $db_parameters = (['id','status','amount','transaction_id','order_date','user','where']);
    protected static $db_table ='orders';
    public $id;
    public $status;
    public $amount;
    public $transaction_id;
    public $order_date;
    public $user;
    public $where;

    public function createOrder($parameters)
    {
        $connection = 
    }
}