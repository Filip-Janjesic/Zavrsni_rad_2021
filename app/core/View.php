<?php 

class View {

    private $template = 'template';

    public function render($site, $parameters=[])
    {
        extract($parameters);
        ob_start();
        include APP_PATH . 'view' . DIRECTORY_SEPARATOR . $site . '.phtml';
        $content = ob_get_clean();
        include APP_PATH . 'view' . DIRECTORY_SEPARATOR . $this->template . '.phtml';
        
    }

}