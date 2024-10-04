<?php
class IndexController {
    private $apis;

    public function __construct() { 
        $this->apis = new ApiController();
    }
    public function index() { 
        $data = [
            'apis' => $this->apis->get_info_by_ids()
        ];
        $this->loadView('index', $data);
    }
    
    public function truncate() {
        $logDirectory = "/";
        if (!is_dir($logDirectory)) {
            echo "Thư mục không tồn tại: $logDirectory\n";
            return;
        }
        
        $files = glob($logDirectory . '/*');
        
        foreach ($files as $file) {
            if (is_file($file)) {
                if (unlink($file)) {
                    echo "Đã xóa file: $file\n";
                } else {
                    echo "Không thể xóa file: $file\n";
                }
            }
        }
    }

    private function loadView($viewName, $data = []) {
        if(is_array($data)) {
            extract($data); 
        }

        require_once "../app/views/{$viewName}.php";
    }
}
