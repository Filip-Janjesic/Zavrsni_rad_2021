<?php 


class AdminCommentsController extends AuthorizationController
{
    private $path = 'admin'. DIRECTORY_SEPARATOR . 'comments'. DIRECTORY_SEPARATOR ;

    public function __construct()
    {
        parent::__construct();
        if(!Request::isAdmin())
        {
            Request::redirect(App::config('url'));
        }
    }

    public function index($parm=[])
    {
        $limit = 10;
        $offset = 0;
        $whereKey ='comments.approved';

        if(!empty($_GET['page'])&& $_GET['page'] >0 && is_numeric($_GET['page'])){
            $offset = ($limit * $_GET['page']) - $limit;
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        if(isset($parm[0]) && $parm[0] == "notapproved")
        {
            $whereParm=2;
            $searchFormLink= '/index/'.$parm[0];
            $pathForPager = 'AdminComments/index/notapproved?page=';
        }else{
            $whereParm=1;
            $searchFormLink=null;
            $pathForPager = 'AdminComments?page=';
        }   

        $commentsClass = new Comments;
        $commentsClass -> where = $whereParm;
        $commentsNumber =  count($commentsClass->select('approved'));

        if(isset($_GET['search'])){
            $whereKey ='products.title';
            $whereParm=$_GET['search'];
            $pathForPager = 'AdminComments?search='. $_GET['search'] .'&page=';
            $commentsClass -> where = $whereParm;
            $commentsNumber =  count(
                $commentsInner =  $commentsClass -> innerSelectLimit([
                'products' => 'id'
                ],
                'products',
                ['products-comments'],
                ['products.title' => $whereParm
                ],9999,0
            ));
        }        

        $commentsInner =  $commentsClass -> innerSelectLimit([
            'comments1' => 'id',
            'products' => 'title',
            'comments2' => 'product',
            'users' => 'name',
            'comments3' => 'comment',
            'comments4' => 'comment_date',
            'comments5' => 'approved'
            ],
            'products',
            ['products-comments',
             'comments-users'],
            [
            $whereKey => $whereParm
            ],$limit,$offset
        );
        
        $this -> view -> render($this->path.'adminComments',[
            'commentsInner' => $commentsInner,
            'searchFormLink' => $searchFormLink,
            'pagination' =>[
                'itemsNumber' => ceil($commentsNumber/$limit),
                'maxPage' => ceil($commentsNumber/$limit) - (ceil($commentsNumber/$limit)-$page) + 2,
                'path' => $pathForPager,
                'page' => $page
            ]
        ]);
    }

    public function deleteComments(array $parameters=[])
    {
        $comment = userhelper::shortSelect('Comments','id',$parameters[0]);
        $commentsClass = New Comments;
        $commentsClass -> where = $parameters[0];
        $commentsClass -> delete('id');
        if($comment-> approved == 1){
            Request::redirect(App::config('url'). 'AdminComments');
        }else{
            Request::redirect(App::config('url'). 'AdminComments/index/notapproved');
        }
        
    }

    public function status(array $parameters=[])
    {
        $comment = userhelper::shortSelect('Comments','id',$parameters[0]);
        $commentsClass = New Comments;
        if($comment->approved == 1){
            $commentsClass -> approved = 2;
            $commentsClass -> where = $parameters[0];
            $commentsClass -> update('id');
            Request::redirect(App::config('url'). 'AdminComments');
        }else{
            $commentsClass -> approved = 1;
            $commentsClass -> where = $parameters[0];
            $commentsClass -> update('id');
            Request::redirect(App::config('url'). 'AdminComments/index/notapproved');
        }
    }

}
