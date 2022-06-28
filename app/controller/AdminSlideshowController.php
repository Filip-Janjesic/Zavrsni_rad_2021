<?php 


class AdminSlideshowController extends AuthorizationController
{
    private $path = 'admin'. DIRECTORY_SEPARATOR . 'slideshow'. DIRECTORY_SEPARATOR ;

    public function __construct()
    {
        parent::__construct();
        if(!Request::isAdmin())
        {
            Request::redirect(App::config('url'));
        }
    }

    public function index($parameters=[])
    {

        $slideshowClass = new Slideshow;
        $photos = $slideshowClass -> selectAll();
        $slideshowClass -> where = '1';
        $visible = $slideshowClass -> select('visible'); 
        $this -> view -> render($this->path.'adminSlideshow',[
            'photos' => $photos,
            'visiblePhotos' => $visible
        ]);
    }

    public function addPhoto()
    {
        $error = ""; $SuccessMsg="";
        $photo = isset($_FILES['image']) ? $_FILES['image'] : '';
        if($photo != ''){
            $photoName = uniqid().basename($photo['name']);
        }
        if(isset($_POST['submit'])){       
        $error = slideshowhelper::photoError($photo);
            if(empty($error))
            {
                $slideshowClass = new Slideshow;
                $slideshowClass -> photo = $photoName;
                $slideshowClass -> create();
                $SuccessMsg= 'Photo added';
                move_uploaded_file($photo['tmp_name'], IMAGE_PATH .$photoName);
            }
        }
        $this -> view -> render($this->path.'adminAddPhoto',[
            'error' => $error,
            'succesMsg' => $SuccessMsg  
        ]);
    }

    public function setPhoto($parameters=[])
    {
        $slideshowClass= new Slideshow;
        $slideshowClass -> where = $parameters[0];
        $photo = $slideshowClass -> select('id')[0];

        if($photo -> visible == 2)
        {
            $slideshowClass -> visible = 1;
            $slideshowClass -> update('id');        
        }else{
            $slideshowClass -> visible = 2;
            $slideshowClass -> update('id');        
        }
        Request::redirect(App::config('url'). 'AdminSlideshow');
    }

    public function deletePhoto($parameters=[])
    {
        $photo = userhelper::shortSelect('Slideshow','id',$parameters[0]);
        unlink(IMAGE_PATH . $photo-> photo);
        $slideshowClass= new Slideshow;
        $slideshowClass -> where = $parameters[0];
        $photo = $slideshowClass -> delete('id');
        Request::redirect(App::config('url'). 'AdminSlideshow');
    }
}
