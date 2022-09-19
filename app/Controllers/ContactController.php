<?php

namespace Controllers;

use Core\Controller;


class ContactController extends Controller
{
   private $address, $message, $link;
   protected static string $layout = 'app';
   

    public function __construct()
        {
            
            parent::__construct();
            $this->address = conf('contacts');
            $this->messages = [];

            $this->link = mysqli_connect("localhost", "root", "", "shopaholic");

            if($this->link === false) {
                die("Error: Could not connect ". mysqli_connect_error());
            }
        }
        public function index()
        {
            if ($_POST) {
                $name = mysqli_real_escape_string($this->link, $_POST['name']);
                $email = mysqli_real_escape_string($this->link, $_POST['email']);
                $subject = mysqli_real_escape_string($this->link, $_POST['subject']);
                $message = mysqli_real_escape_string($this->link, $_POST['message']);
                
   
                $sql = "INSERT INTO feedback (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
                mysqli_query($this->link, $sql);
            }

            $sql = "SELECT name, subject, message, created_at FROM feedback";

            $result = mysqli_query($this->link, $sql);

            if($result){
                $this->messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }else{
                echo "ERROR: Could not able to execute $sql. ".mysqli_error($this->link);
            }


            $this->response->render('contact/index', ['messages' => $this->messages, 'address'=>$this->address]);
        }   
}


