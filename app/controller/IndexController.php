<?php 


class IndexController extends Controller
{

    private $path = 'public'. DIRECTORY_SEPARATOR ;
    private $error ="";

    public function index(array $parameters=[])
    {   
        $limit = 6;
        $offset = 0;
        $bigTitle = 'PRODUCTS';
        $ProductsInCategory=[];
        $categoriesClass = new Categories;
        $Categories = $categoriesClass -> selectAll();
        $ProductsClass = new Products;
        $displayCategory=null;
        
        if(!empty($_GET['page']) && $_GET['page'] >0 && is_numeric($_GET['page'])){
            $offset = ($limit * $_GET['page']) - $limit;
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        $productCount= ceil(count($ProductsClass -> selectAll()) / $limit);
        if(!empty($_GET['page']) && $_GET['page'] > $productCount)
        {
            $offset = $limit * $productCount - $limit;
            $page = $productCount;
        }
        foreach($Categories as $key){
            if(isset($parameters[0]) && $key -> id === $parameters[0]){
                $bigTitle=$key->name;
            }
            $ProductsClass->where = $key->id;
            $ProductsInCategory[$key->name] = count($ProductsClass->select('category'));
        }
        $ProductsClass = new Products;
        if(isset($parameters[0]))
        {
            $ProductsClass->where = $parameters[0];
            $ProductsNumber = count($ProductsClass -> select('category'));
            $Products = $ProductsClass-> selectLimit('category',$limit,$offset);
            $pathForPager = 'index/index/'.$parameters[0].'?page=';
        }elseif(!empty($_GET['search'])){
            $bigTitle = 'Search result - ' . $_GET['search'];
            $ProductsNumber = count($ProductsClass -> selectAllLike('%'.trim($_GET['search']).'%','title'));
            $Products = $ProductsClass-> selectAllLikeLimit('%'.trim($_GET['search']).'%','title',$limit,$offset);
            $pathForPager = 'index?search='.$_GET['search'].'&page=';
            if(count($Products) == 0){
                $bigTitle = 'No result';
            }
        }else{
            $ProductsNumber = count($ProductsClass -> selectAll());
            $Products = $ProductsClass-> selectAllLimit($limit,$offset);
            $pathForPager = 'index/index?page=';
        }
        $Product=[];
        foreach ($Products as $key) {
            $rating =$this->getRating($key -> id);
            $key-> rating = $rating; 
            if($key->visible == 'visible')
            {
                $Product[$key->id] = $key;
            }
        }
        $slideshowClass = new Slideshow;
        $slideshowClass -> where = '1';
        $visible = $slideshowClass -> select('visible'); 

        $this -> view -> render($this->path.'index',[
            'purchased' =>  $this -> buyedProducts(),
            'ProductsInCategory' => $ProductsInCategory,
            'categories' => $Categories,
            'products' => $Product,
            'displayCategory' => $displayCategory,
            'bigTitle' => $bigTitle,
            'visible' => $visible,
            'pagination' =>[
                'itemsNumber' => ceil($ProductsNumber/$limit),
                'maxPage' => ceil($ProductsNumber/$limit) - (ceil($ProductsNumber/$limit)-$page) + 2,
                'path' => $pathForPager,
                'page' => $page
            ]
        ]);
        unset($_SESSION['confirmMsg']);
    }

    public function productpage(array $parameters=[])
    {
        $limit = 6;
        $offset = 0;
        if(!empty($_GET['page']) && $_GET['page'] >0 && is_numeric($_GET['page'])){
            $page = $_GET['page'];
            $offset = ($limit * $_GET['page']) - $limit;
        }else{
            $page = 1;
        }
        $CommentCount= ceil(count((array)userhelper::shortSelect('Comments','product',$parameters[0])) / $limit);
        if(!empty($_GET['page']) && $_GET['page'] > $CommentCount)
        {
            $offset = $limit * $CommentCount - $limit;
            $page = $CommentCount;
        }
        $commentsClass= new Comments;
        $commentsClass->where = $parameters[0];
        $commentsClass = count($commentsClass -> select('product'));
        $pathForPager = 'index/productpage/'.$parameters[0].'?page=';

        if(isset($_GET['deleteComment']))
        {
            $this -> deleteComment();
            Request::redirect(App::config('url').'index/productpage/'.$parameters[0]);
        }
        
        if(isset($_POST['submit']))
        {
            $this->insertComment($parameters[0]);
        }
        if(!empty($parameters[0]))
        {
            $productClass= new Products;
            $productClass -> where = $parameters[0];
            $product=$productClass -> select('id')[0];
            $comments = $this->getComments($parameters[0]);
        }
        if(empty($parameters[0]) || empty($product) || $product->visible != 'visible'){
            Request::redirect(App::config('url'));
            return;
        }
        if(isset($_SESSION['User']->id)){
            $commentClass = New Comments;
            $myComments = $commentClass -> innerSelectLimit(
                [
                    'comments' => 'id'
                ],
                'comments',
                [
                    'comments-user'
                ],
                [
                    'comments.user' => $_SESSION['User'] -> id
                ],999,0
            );
            for ($i=0; $i < count($myComments) ; $i++) { 
                $myComments[$i] = $myComments[$i]->id; 
            }
        }else
        {
            $myComments=[];
        }

        $this -> view -> render($this->path.'productpage',[
            'myComments' => $myComments,
            'purchased' =>  $this -> buyedProducts(),
            'checkrating' => $this-> checkRating($parameters[0]),
            'countrating' => $this-> countRating($parameters[0]),
            'rating' => $this-> getRating($parameters[0]),
            'commentError' => $this->error,
            'product' => $product,
            'comments' => $comments,
            'pagination' =>[
                'itemsNumber' => ceil($commentsClass/10),
                'maxPage' => ceil($commentsClass/10) - (ceil($commentsClass/10)-$page) + 2,
                'path' => $pathForPager,
                'page' => $page
            ]
        ]
    );
    }
    public function myproducts($parameters=[])
    {
        if(isset($parameters[0]))
        {
            $local_file = PDF_PATH . $parameters[0];
            $download_file = $parameters[0];

            // set the download rate limit (=> 20,5 kb/s)
            $download_rate = 20.5;
            if(file_exists($local_file) && is_file($local_file))
            {
                header('Cache-control: private');
                header('Content-Type: application/octet-stream');
                header('Content-Length: '.filesize($local_file));
                header('Content-Disposition: filename='.$download_file);

                flush();
                $file = fopen($local_file, "r");
                while(!feof($file))
                {
                    print fread($file, round($download_rate * 1024));
                    flush();
                    sleep(1);
                }
                fclose($file);}
            else {
                die('Error: The file '.$local_file.' does not exist!');
            }
        }

        if(request::isLogin()){
            $ordersClass = New Orders;
            $products = $ordersClass -> innerSelectLimit(
                [
                    'orders' => 'id',
                    'products' => 'pdf',
                    'products1' => 'image',
                    'products2' => 'title',
                    'products3' => 'author'
                ],
                'orders',
                [
                    'orders-bought',
                    'bought-products',
                    'orders-users'
                ],
                [
                    'orders.user' => $_SESSION['User'] -> id
                ],999,0
            );
            $this -> view -> render($this->path.'myproducts',[
                'products' => $products
            ]);
            unset($_SESSION['thankyou']);
        }else{
            Request::redirect(App::config('url'));
        }
        
    }

    public function insertComment($parameters)
    {
        $commentsClass= new Comments;
        $this -> error= commenthelper::commentError(trim($_POST['content']));
        if(empty($this -> error)){
        $commentsClass -> user = trim($_SESSION['User'] -> id);
        $commentsClass -> product = trim($parameters);
        $commentsClass -> comment = trim($_POST['content']);
        $commentsClass -> comment_date= date("Ymd"); 
        $commentsClass -> approved = 1;
        $commentsClass -> create();
        Request::redirect(App::config('url').'index/productpage/'.$parameters);
        }
    }

    public function deleteComment()
    {
        if(!empty($_SESSION['User'])){
            $search = userhelper::shortSelect('Comments','id',$_GET['deleteComment']);
            if($search->user == $_SESSION['User']->id)
            {
                $commentsClass= new Comments;
                $commentsClass -> where = $_GET['deleteComment'];
                $commentsClass -> delete('id');
            }
        }
    }

    public function getComments($id)
    {
        $limit = 10;
        $offset = 0;
        
        $CommentCount= ceil(count((array)userhelper::shortSelect('Comments','product',$id)) / $limit);
        if(!empty($_GET['page']) && $_GET['page'] >0 && is_numeric($_GET['page'])){
            $offset = ($limit * $_GET['page']) - $limit;
        }
        if(!empty($_GET['page']) && $_GET['page'] > $CommentCount)
        {
            $offset = $limit * $CommentCount - $limit;
        }
        $commentsClass = new Comments;
        $commentsInner =  $commentsClass -> innerSelectLimit([
            'comments1' => 'id',
            'comments2' => 'product',
            'users' => 'name',
            'comments3' => 'comment',
            'comments4' => 'comment_date',
            'comments5' => 'approved'
            ],
            'comments',
            ['comments-users'],
            [
            'comments.product' => $id
            ],$limit,$offset
        );
        $comments=[];
        foreach ($commentsInner as $key => $value)
        {
            if($value-> approved == 1)
            {
                $comments[$key] = $value;
            }
        }
        return $comments;

    }

    public function getRating($product)
    {
        $ratingClass= new Ratings;
        $ratingClass -> where = $product;
        $result= $ratingClass -> select('product');
        for ($i=0; $i < count($result); $i++) { 
            $allRatings[$i] = $result[$i] ->rating;
        }
        if(isset($allRatings)){
        $result = array_sum($allRatings) / count($result);
        return $result;
        }else{
            return 'no rating';
        }
    }

    public function setRating($param=[])
    {

        if($param[1] <= 0 || $param[1] >= 6)
        {
            Request::redirect(App::config('url').'index/error');
            return;
        }
  
        if(isset($_SESSION['User']) && $this -> checkRating($param[0]) == true)
        {
            
                $ratingClass= new Ratings;
                $ratingClass -> user = $_SESSION['User'] -> id;
                $ratingClass -> product = (int)$param[0];
                $ratingClass -> rating = (int)$param[1];
                $ratingClass -> create();
        }
        Request::redirect(App::config('url').'index/productpage/'. $param[0]);
    }

    public function checkRating($product)
    {
        $ratingClass= new Ratings;
        $ratingClass -> where = $product;
        $result= $ratingClass -> select('product');
        if(isset($_SESSION['User']))
        {
            foreach ($result as $key) {
                if($key -> user == $_SESSION['User']->id)
                {
                    return $key -> rating;
                }
            }
        } 
        return true;
    }

    public function countRating($product)
    {
        $ratingClass= new Ratings;
        $ratingClass -> where = $product;
        $result= $ratingClass -> select('product');
        return count($result);
    }
    
    public function contact()
    {
        $msg = '';
        if(isset($_SESSION['contactMsg'])){
            $msg = $_SESSION['contactMsg'];
            unset($_SESSION['contactMsg']);
        }
        $error=[];
        if($_POST)
        {
            $error['name'] = producthelper::emailError(trim($_POST['name']));
            $error['message'] = producthelper::emailError(trim($_POST['message']));
            $error['msg'] = producthelper::basicError(trim($_POST['message']));
            print_r($error);
            if(empty($error['name']) || empty($error['message']) || empty($error['msg']))
            {
                echo "test";
                mailerhelper::sendMail('Ante.filipovic72@gmail.com',$_POST['email'],$_POST['name'],$_POST['message']);
                if(mailerhelper::sendMail('Ante.filipovic72@gmail.com',$_POST['email'],$_POST['name'],$_POST['message']))
                {
                    $msg=$_SESSION['contactMsg'] = 'Message sent';
                }else
                {
                    $msg=$_SESSION['contactMsg'] = 'The message cannot be sent';
                }
                Request::redirect(App::config('url').'index/contact');
            }
            
            
        }
        $this -> view -> render($this->path.'contact',[
            'msg' => $msg,
            'error' => $error
        ]);
    }

    public function confirm($parameters= [])
    {   $user = userhelper::shortSelect('Users','confirm_email_token',$parameters[0]);
        if(!empty($user)){
            $usersClass = new Users;
            $usersClass -> confirm_email_token = 'confirmed';
            $usersClass -> where = $parameters[0];
            $usersClass-> update('confirm_email_token');
            $_SESSION['confirmMsg'] = 'Your email is confirmed';
        }else{
            Request::redirect(App::config('url').'index');
        }
        Request::redirect(App::config('url').'index');
    }

    public function erdiagram()
    {
        $this -> view -> render($this->path.'erdiagram');
    }

    public function error(array $parameters=[])
    {
        $this -> view -> render($this->path.'error');
    }

    public function buyedProducts(array $parameters=[])
    {
        $purchased=[];
        if(isset($_SESSION['User']->id)){
            $ordersClass = New Orders;
            $purchased = $ordersClass -> innerSelectLimit(
                [
                    'products' => 'id'
                ],
                'orders',
                [
                    'orders-bought',
                    'bought-products'
                ],
                [
                    'orders.user' => $_SESSION['User'] -> id
                ],999,0
            );
            for ($i=0; $i < count($purchased) ; $i++) { 
                $purchased[$i] = $purchased[$i]->id; 
            }
            return $purchased;
    }
}
}