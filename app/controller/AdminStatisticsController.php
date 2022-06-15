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
                    if(!empty($productsPrice[$key->title])){
                        $productsPrice[$key->title] = $key->price + $productsPrice[$key->title];
                    }else{
                        $productsPrice[$key->title] = $key->price;
                        $productNames = $productNames. $key -> title. ',';
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