<?php

class AdminStatisticsController extends AuthorizationController
{
    private $path = 'admin'. DIRECTORY_SEPARATOR ;

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
        $productTotalprice=[];
            $productsCount= Bought::selectAllPrices();
            $productNames = '';
            foreach ($productsCount as $key) {
                    if(!empty($productsPrice[$key->brand_name])){
                        $productsPrice[$key->brand_name] = $key->price + $productsPrice[$key->brand_name];
                    }else{
                        $productsPrice[$key->brand_name] = $key->price;
                        $productNames = $productNames. $key -> brand_name. ',';
                    }
                    
            }
            if(!empty($productsPrice)){
                $productNames =explode(',',$productNames);
                for ($i=0; $i < count($productsPrice) ; $i++) { 
                    $productTotalprice[$i] = [
                        'label' => $productNames[$i],
                        'y' => $productsPrice[$productNames[$i]]
                    ];
                }
            }
            

        $this -> view -> render($this->path.'statistics',[
            'productTotalprice' => $productTotalprice
        ]);
    }
}