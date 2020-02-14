<?php

/**
 * Class Renderer
 */
class Renderer {

    public $router;

    public function __construct($router = null) {
        $this->router = $router;
    }

    public function render($router = null)
    {
        $request = parse_url($_SERVER["REQUEST_URI"]);
        //$scriptdir = dirname($_SERVER['SCRIPT_NAME']);

        $reqPath = str_replace("\\", "", $request['path']);

        if($router != null){
            $file = $router->getRoute($reqPath);
        }
        else if($this->router != null){
            $router = $this->router;
            $file = $router->getRoute($reqPath);
        }
        else{
            echo "ERROR! code: 3003";
        }

        //$file_path = getcwd().$file;
        $file_path = realpath($file);
        if(file_exists($file_path)) {
            $mime_type = mime_content_type($file_path);

            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            header('Cache-Control: post-check=0, pre-check=0', false);
            header('Pragma: no-cache');
            header("Content-type: $mime_type");
            header('Content-Length: ' .filesize($file_path));
            header('Content-Disposition: filename="' . basename($file) . '"');
            header('Content-Transfer-Encoding: binary');


            if(pathinfo($file_path, PATHINFO_EXTENSION) === "php") {
                include(realpath($file));
            } else {
                if(IDEA_WED_SERVER === "apache")
                    header("X-Sendfile: $file");
                else if(IDEA_WED_SERVER === "nginx")
                    header("X-Accel-Redirect: ".str_replace("/var/www/ideaencode.com/","/ideafs/",$file_path));
            }
        } else
            include(getcwd()."/public/html/404.html");
    }
}