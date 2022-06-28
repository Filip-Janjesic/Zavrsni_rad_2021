<?php 


class AdminUsersController extends AuthorizationController
{
    private $path = 'admin'. DIRECTORY_SEPARATOR . 'users'. DIRECTORY_SEPARATOR ;

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
        $limit =10;
        $offset = 0;

        if(!empty($_GET['page']) && $_GET['page'] >0 && is_numeric($_GET['page'])){
            $offset = ($limit * $_GET['page']) - $limit;
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        $usersClass = New Users;
        if(isset($_POST['submit']) && !empty($_POST['email']))
        {
            $ProductsNumber = count($usersClass -> selectAllLike("%".trim($_POST['email'])."%",'email'));
            $users= Users::readLikeLimit(trim($_POST['email']),$limit,$offset);
            $pathForPager = 'AdminUsers/search='. $_POST['email'].'?page=';
        }else
        {
            $ProductsNumber = count($usersClass -> selectAll());
            $users = Users::readLimit($limit,$offset);
            $pathForPager = 'AdminUsers?page=';
        }
        $this -> view -> render($this->path.'adminUsers',[
            'users' => $users,
            'pagination' =>[
                'itemsNumber' => ceil($ProductsNumber/$limit),
                'maxPage' => ceil($ProductsNumber/$limit) - (ceil($ProductsNumber/$limit)-$page) + 2,
                'path' => $pathForPager,
                'page' => $page
            ],
        ]);
    }

    public function createUsers()
    {
        $SuccessMsg='';
        $errors= [
            'name' => '',
            'lastname'=> '',
            'role' => '',
            'email' => '',
            'password' => ''
        ];
        $name = Request::issetTrim('name');
        $lastname = Request::issetTrim('lastname');
        $email = strtolower(Request::issetTrim('email'));
        $password = Request::issetTrim('password');
        $confirmPassword = Request::issetTrim('confirmPassword');
        $role = Request::issetTrim('role');

        if(isset($_POST['submit'])){
            
            $errors['name'] = userhelper::nameError($name);
            $errors['lastname'] = userhelper::nameError($lastname);
            $errors['email'] = userhelper::emailError($email);            
            $errors['password'] = userhelper::passwordError($password,$confirmPassword);
            $errors['role'] = userhelper::emptyError($role); 
            //Create user
    
            if(empty($errors['name']) && empty($errors['lastname']) && empty($errors['email']) && empty($errors['password'])){
                $UsersClass = new Users;
                $UsersClass -> name = $name;
                $UsersClass -> lastname = $lastname;
                $UsersClass -> password =  password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $UsersClass -> email = strtolower($email);
                $UsersClass -> register_time = time();
                $UsersClass -> role = $role;
                $UsersClass -> confirm_email_token = 'confirmed';
                $UsersClass -> Create();
                $SuccessMsg= 'Account has been successfully created';
            }
        }
        $this -> view -> render($this->path.'adminUsersAdd',[
            'errors' => $errors,
            'succesMsg' => $SuccessMsg,
            'returnField' => [
              'name' => $name, 
              'lastname' => $lastname,
              'email' => $email, 
              'role' => $role,
              'password' => $password, 
              'confirmPassword' => $confirmPassword, 
            ]
        ]);
    }


    public function updateUsers(array $parameters=[])
    { 
        $UsersClass = new Users;
        $UsersClass -> where= $parameters[0];
        $Fields = $UsersClass-> select('id')[0];
        if(empty($Fields)){
            Request::redirect(App::config('url'). 'AdminUsers');
            return;
        }
        $errors= [
            'name' => '',
            'lastname'=> '',
            'role' => '',
            'email' => '',
            'password' => ''
        ];
        $name = Request::issetTrim('name');
        $lastname = Request::issetTrim('lastname');
        $email = strtolower(Request::issetTrim('email'));
        $password = Request::issetTrim('password');
        $role = Request::issetTrim('role');

        if(isset($_POST['submit'])){

        $errors['name'] = userhelper::nameError($name);
        $errors['lastname'] = userhelper::nameError($lastname);
        $errors['email'] = userhelper::emailUpdateError($email,$Fields-> email);            
        $errors['password'] = userhelper::passwordError($password,$password);    
        $errors['role'] = userhelper::emptyError($role); 

        if(empty($errors['name']) && empty($errors['lastname']) && empty($errors['email']) && empty($errors['password']) && empty($errors['role'])){
        $UsersClass -> name = $name;
        $UsersClass -> lastname = $lastname;
        $UsersClass -> password =  password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $UsersClass -> email = strtolower($email);
        $UsersClass -> role = $role;
        $UsersClass -> where = $parameters[0];
        $UsersClass -> update('id');
        Request::redirect(App::config('url'). 'AdminUsers/updateUsers/'. $parameters[0]);
        }
    }
        $this -> view -> render($this->path.'adminUsersUpdate',[
            'errors' => $errors,
            'returnField' => [
              'id' => $Fields -> id,
              'name' => $Fields -> name, 
              'lastname' => $Fields ->lastname,
              'role' => $Fields ->role,
              'email' => $Fields ->email, 
              'password' => $Fields ->password, 
            ]
        ]);
    }



    public function deleteUsers(array $parameters=[])
    {
        $commentClass = New Comments;
        $commentClass -> where = $parameters[0];
        $commentClass -> delete('user');
        $ratingClass = New Ratings;
        $ratingClass -> where = $parameters[0];
        $ratingClass -> delete('user');
        $usersClass = New Users;
        $usersClass -> where = $parameters[0];
        $usersClass -> delete('id');
        Request::redirect(App::config('url'). 'AdminUsers');
    }

    public function setUser(array $parameters=[])
    {
        $usersClass = New Users;
        $usersClass -> role = 'user';
        $usersClass -> where = $parameters[0];
        $usersClass -> Update('id');
        Request::redirect(App::config('url'). 'AdminUsers');
    }

    public function setAdmin(array $parameters=[])
    {
        $usersClass = New Users;
        $usersClass -> role = 'admin';
        $usersClass -> where = $parameters[0];
        $usersClass -> Update('id');
        Request::redirect(App::config('url'). 'AdminUsers');
    }
}
