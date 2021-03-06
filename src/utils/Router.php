<?php
namespace App;

class Router {

    /**
     * @var string
     */
    private $viewPath;

    /**
     * @var AltoRouter
     */
    private $router;

    public $template = "templateMain";

    private $currentPage = null;

    private $componentsPath = null;

    private $layoutPath = null;

    private $templatesPath = null;

    public function __construct(string $viewPath, string $appName, string $componentsPath, string $layoutPath, string $templatesPath)
    {
        $this->viewPath = $viewPath;
        $this->appName = $appName;
        $this->router = new \AltoRouter();
        $this->componentsPath = $componentsPath;
        $this->layoutPath = $layoutPath;
        $this->templatesPath = $templatesPath;
    }

    public function get(string $url, string $view, ?string $name = null)
    {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }
    public function post(string $url, string $view, ?string $name = null)
    {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }
    public function match(string $url, string $view, ?string $name = null)
    {
        $this->router->map('POST|GET', $url, $view, $name);

        return $this;
    }

    public function url(string $name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }

    public function run()
    {
        $templatesPath = $this->templatesPath;
        $componentsPath = $this->componentsPath;
        $layoutPath = $this->layoutPath;
        $appName = $this->appName;
        $match = $this->router->match();
        $router = $this;
        $view = $match['target'];
        $params = $match['params'];
        if(is_array($match)){

            if(is_callable($match['target'])){

                $this->router->call_user_func_array($match['target'], $match['params']);

            }else{
                if(session_status() === PHP_SESSION_NONE){
                    session_start();
                }
                $params = $match['params'];
                ob_start();
                require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
                $pageContent = ob_get_clean();
            }
            

        }else{
            // ob_start();
            // require $this->viewPath . DIRECTORY_SEPARATOR . "404.php";
            http_response_code(404);
            header('Location: ' . $router->url('404'));
            // $pageContent = ob_get_clean();
        }
        require "../src/templates/{$this->template}.php";
            
            return $this;
        }
}