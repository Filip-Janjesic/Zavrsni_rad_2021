<?php 


class CartController extends AuthorizationController
{

    private $path = 'public'. DIRECTORY_SEPARATOR ;
    private $error ="";

    public function index(array $parameters=[])
    {
        if(!empty($_SESSION['Cart']))
        {
        $this -> view -> render($this->path.'cart');
        }else{
            Request::redirect(App::config('url'));
        }
    }

    public function addProductToCart(array $parameters=[])
    {
        if($parameters[0] < 0 || !is_numeric($parameters[0]))
        {
            Request::redirect(App::config('url'));
            exit;
        }
        $productsClass = new Products;
        $productsClass -> where = $parameters[0];
        $product = $productsClass-> select('id')[0];
        if(empty($_SESSION['Cart'][$product-> id]))
        {
            $_SESSION['Cart'][$product-> id] = [
                'id' => $product-> id,
                'image' => $product-> image,
                'brand_name' => $product-> brand_name,
                'manufacturer' => $product-> manufacturer,
                'discount' => $product-> discount,
                'price' => $product->price * (1-producthelper::floatDiscount($product->discount))
            ];
        }
        Request::redirect(App::config('url').'Cart/index');
    }

    public function destroyCart()
    {
        unset($_SESSION['Cart']);
        $_SESSION['Cart'] = [];
        Request::redirect(App::config('url').'Cart/index');
    }

    public function removeProduct($parameters=[])
    {
        foreach ($_SESSION['Cart'] as $key => $value) {
            if($value['id'] == $parameters[0])
            {
                unset($_SESSION['Cart'][$key]);
            }
        }
        Request::redirect(App::config('url').'Cart/index');
    }

    public function thankyou()
    {
        if(isset($_GET['tx']))
        {
            $amount = $_GET['amt'];
            $transaction = $_GET['tx'];
            $status = $_GET['st'];
            $ordersController = new AdminOrdersController;
            $ordersController -> create($status,$transaction,$amount); 
            $order = userhelper::shortSelect('Orders','transaction_id',$transaction);
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
                'bought.orders' => $order->id
                ],999,0
            );
            $msg = Util::ordersList($orderInner);
            mailerhelper::sendMail($_SESSION['User']->email,'Transaction: '.$transaction,'Transaction: '.$transaction,$msg);
            Request::redirect(App::config('url').'cart/thankyou');
        }else{
            $_SESSION['thankyou'] = 'Thank you for buying our product. See You soon!';
            Request::redirect(App::config('url').'index/myproducts');
        }

    }
}