<?php
    include ('databaseData.php');

    $db = new mysqli($data['host'], $data['user'], $data['password'], $data['database']);

    
    if($db->connect_error)
    {
        die("Connection failed: " . $db->connect_error);
    }

    $result = array();
    $sender = isset($_POST['sender']) ? $_POST['sender'] : null;
    $message = isset($_POST['message']) ? $_POST['message'] : null;

    if(!empty($message) && !empty($sender))
    {
        $sql = "INSERT INTO chat (message, sender) VALUE ('". $message."','". $sender ."')"; 
        echo $sql;
        $result['send_status'] = $db->query($sql);
    }

    //print message
    $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
    $sql = "SELECT * FROM chat WHERE id >=" .$start;
    $r = $db->query($sql);
    if($r == false)
    {
        die('error');
    }
    while($row = $r->fetch_assoc()){
        array_push($result, new Message($row['message'], $row['sender']));
    }

    $db->close();

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    //header('status-code : 200');

    echo json_encode($result);

    class Message
    {
        public $message;
        public $sender;

        function __construct($mess, $send)
        {
            $this->message = $mess;
            $this->sender = $send;
        }



    }

?>