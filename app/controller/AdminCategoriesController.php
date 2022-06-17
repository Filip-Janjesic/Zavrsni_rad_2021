<?php 


class AdminCategoriesController extends AuthorizationController
{

    private $path = 'admin'. DIRECTORY_SEPARATOR . 'categories'. DIRECTORY_SEPARATOR ;

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
        $categoriesClass = New Categories;
        $categories = $categoriesClass -> selectAllCategories();
        $this -> view -> render($this->path.'adminCategories',[
            'categories' => $categories
        ]);
    }

    public function createCategories()
    {
        $categoriesClass = New Categories;
        $error="";
        if(isset($_POST['submit']))
        {
            $error = categoryhelper::addError(trim($_POST['name']));
            if(empty($error))
            {
                $categoriesClass -> name = trim($_POST['name']);
                $categoriesClass -> create();
                Request::redirect(App::config('url'). 'AdminCategories');
            }
        }
        $categories = $categoriesClass -> selectAll();
        $this -> view -> render($this->path.'adminCategories',[
            'error' => $error,
            'categories' => $categories
        ]);
    }

    public function updateCategories()
    {
        $categoriesClass = New Categories;
        $error="";
        if(isset($_POST['submitUpdate'])&& $_POST['selectCategories'] != "")
        {
            $error = categoryhelper ::addError(trim($_POST['nameUpdate']));
            if(empty($error))
            {
                $categoriesClass -> name = trim($_POST['nameUpdate']);
                $categoriesClass -> where = trim($_POST['selectCategories']);
                $categoriesClass -> update('id');
                Request::redirect(App::config('url'). 'AdminCategories');
            }
        }
        $categories = $categoriesClass -> selectAll();
        $this -> view -> render($this->path.'adminCategories',[
            'errorUpdate' => $error,
            'categories' => $categories
        ]);
    }

    public function deleteCategories(array $parameters=[])
    {
        $categoriesClass = New Categories;
        $categoriesClass -> where = $parameters[0];
        $categoriesClass -> delete('id');
        Request::redirect(App::config('url'). 'AdminCategories');
    }
}