<?php
class DoneController {
    private $apis;

    public function __construct() { 
        $this->apis = new ApiController();
    }
    
    public function index() {
        $userModel = new HttpCurlModel();
        $user = 1;

        $data = [
            'apis' => $this->apis->get_info_by_ids()
        ];

        $this->loadView('done', $data);
    }

    private function loadView($viewName, $data = []) {
        if(is_array($data)) {
            extract($data); 
        }

        require_once "../app/views/{$viewName}.php";
    }
}
