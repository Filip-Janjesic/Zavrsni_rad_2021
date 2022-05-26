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
        $connection = DB::getInstance();
        $connection ->beginTransaction();

        $prepareOrders = $connection -> prepare("
        insert into orders (status,amount,transaction_id,order_date,user)
        VALUES (:status,:amount,:transaction_id,:order_date,:user)
        ");
        $prepareOrders->execute([
            'status' => $parameters['status'],
            'amount' => $parameters['amount'],
            'transaction_id' => $parameters['transaction_id'],
            'order_date' => $parameters['order_date'],
            'user' => $parameters['user']   
        ]);
        $orderId= $connection->lastInsertId();

        foreach ($_SESSION['Cart'] as $key) {
            
            $prepareBought = $connection -> prepare("

                insert into bought (orders,product,price)
                VALUES (:orders,:product,:price)

            ");
            $prepareBought->execute([
                'orders' => $orderId,
                'product' => $key['id'],
                'price' => $key['price']
            ]);
        }
        $connection->commit();
        return true;
    }
}