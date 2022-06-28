<?php 


class AdminOrdersController extends AuthorizationController
{
    private $path = 'admin'. DIRECTORY_SEPARATOR . 'orders'. DIRECTORY_SEPARATOR ;

    public function __construct()
    {
        parent::__construct();
        if(!Request::isAdmin())
        {
            Request::redirect(App::config('url'));
        }
    }

    public function index()
    {
        $limit = 10;
        $offset = 0;
        if(!empty($_GET['page'])&& $_GET['page'] >0 && is_numeric($_GET['page']) ){
            $offset = ($limit * $_GET['page']) - $limit;
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        $ordersClass = New Orders;
        $OrdersNumber = count($ordersClass -> selectAll());
        $ordersInner =  $ordersClass -> innerSelectLimit([
            'orders1' => 'id',
            'orders2' => 'status',
            'orders3' => 'transaction_id',
            'orders4' => 'amount',
            'orders5' => 'order_date',
            'orders6' => 'user',
            'users' => 'name'
            ],
            'orders',
            [
            'orders-users'
            ],
            [
            'orders.status' => 'success'
            ],$limit,$offset
        );
        $pathForPager = 'AdminOrders?page=';
        $this -> view -> render($this->path.'adminOrders',[
            'ordersInner' => $ordersInner,
            'pagination' =>[
                'itemsNumber' => ceil($OrdersNumber/$limit),
                'maxPage' => ceil($OrdersNumber/$limit) - (ceil($OrdersNumber/$limit)-$page) + 2,
                'path' => $pathForPager,
                'page' => $page
            ]
        ]);
    }

    public function create($status,$transaction,$amount)
    {
        $amount = 0;
        foreach ($_SESSION['Cart'] as $key) {
            $amount = $amount + $key['price'];
        }

        $ordersClass = new Orders;
        if(!empty($_SESSION['Cart']) &&
            $ordersClass -> createOrder([
                'status' => 'success',
                'amount' => $amount,
                'transaction_id' => '16519814196896',
                'order_date' => date("Ymd"),
                'user' => $_SESSION['User']->id
            ]) 
        ){
        unset($_SESSION['Cart']);
        $_SESSION['Cart'] = [];
        }
    }


    public function details($parameters=[])
    {
        $orderClass = New Orders;
        $orderInner =  $orderClass -> innerSelectLimit([
            'orders1' => 'id',
            'products1' => 'brand_name',
            'products2' => 'manufacturer',
            'products3' => 'image',
            'bought' => 'price',
            'orders4' => 'amount',
            'orders5' => 'transaction_id',
            ],
            'products',
            [
            'products-bought',
            'bought-orders',
            'orders-users'
            ],
            [
            'bought.orders' => $parameters[0]
            ],999,0
        );
        if(!empty($orderInner))
        {
            $this -> view -> render($this->path.'adminOrdersDetails',[
                'orderInner' => $orderInner
            ]);
        }else
        {
            Request::redirect(App::config('url'). 'AdminOrders');
        }
        
    }
}
