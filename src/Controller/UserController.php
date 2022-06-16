<?php

class UserController 
{
        var $vars = [];
        var $layout = "layout";
        private $db;
   
    public function __construct()
    {
        $this->db= $GLOBALS['db'];
    }

    public function index()
    {
        
        $this->render();
       
    }

    public function get_current_uploads($image_name, $ip_address='')
    {

        $res = false;
        if(empty($ip_address)){
            $ip_address= $_SERVER['REMOTE_ADDR'];
        }
        //
        $query = ""
            . "SELECT `u`.id "
            . "FROM userdetails u "
            . "WHERE u.ip_address = '%s' AND  u.name = '%s'";
        $query = \sprintf($query, $this->db->real_escape_string($ip_address), $this->db->real_escape_string($image_name));
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        $return_res =array();
        if(!empty($row)){
            $user_id= isset($row['id'])?$row['id']:'';
             $return_res['success']= true;
             $return_res['user_id']=1;
            //return $user_id;
        }else{
             $query1 = ""
            . "SELECT u.id "
            . "FROM userdetails u "
            . "WHERE  u.name = '%s'";
         
     
            $query1 = \sprintf($query1, $this->db->real_escape_string($image_name));
            $result1 = $this->db->query($query1);

            $row1 = $result1->fetch_assoc();
      
            if (!empty($row1)) {
                $return_res['success']= false;
                // return false;
            }else{
                  $return_res['success']= true;

            }

        }
         // print_r($return_res);die;
        return $return_res;


     
    }



    public function add(){
        $post_value= array();
        $image_name= isset($_POST['image_name'])? $_POST['image_name']:'';
        $description= isset($_POST['description'])? $_POST['description']:'';
        $ip_address= $_SERVER['REMOTE_ADDR'];
        $user_upload =array();
        $user_upload=$this->get_current_uploads($image_name, $ip_address);
            
        if($user_upload['success'] == false){

            // return 'Image or Name already exits';
            $_SESSION['message'] ='Image or Name already exits';
        }
        else{

              // echo $user_upload;die;
            $post_value['name'] =$image_name;
            $post_value['description'] =$description;
            // $post_value['image_upload'] =$image_name;
            $post_value['date_created'] =date('Y-m-d');
            $post_value['ip_address'] =$ip_address;
             if(isset($_FILES['image_upload'])){
              $errors= array();
              $file_name = $_FILES['image_upload']['name'];
              $file_size = $_FILES['image_upload']['size'];
              $file_tmp = $_FILES['image_upload']['tmp_name'];
              $file_type = $_FILES['image_upload']['type'];
              $file_ext=strtolower(end(explode('.',$_FILES['image_upload']['name'])));
              $unique=time().uniqid(rand());
              
              $expensions= array("jpeg","jpg","png");
              
              if(in_array($file_ext,$expensions)=== false){
                 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
              }
              
              if($file_size > 2097152) {
                 $errors[]='File size must be less than 2 MB';
              }
               // echo $unique.$file_name;die;
              if(empty($errors)==true) {
                $message= '';
                 move_uploaded_file($file_tmp, $unique.$file_name);
                 $post_value['image']= $unique.$file_name;
                 $user_id=(isset($user_upload['user_id']))?$user_upload['user_id']:'';
                    if($user_id>0){
                       $res=  $this->update_uploads($post_value, $user_id);
                        $message= 'Updated Successfully';

                    }else{
                       $res=  $this->insert_uploads($post_value);
                        $message= 'Inserted Successfully';
                    }
                   if($res== true){
                     $_SESSION['message']=$message;
                    
                   }else{
                      $_SESSION['message']='Something went wrong';
                   }
                 
              }
              else{
                      $_SESSION['message']='Error';
                   }
           }
           


        }
        $actual_link = "http://localhost/game-test/public/user/";//http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
        // $actual_link = "http://".$_SERVER[HTTP_HOST] .'/public/user';
        header('Location:'.  $actual_link);
        
    }

     public function update_uploads($post_value=array(), $user_id){

        if(!empty($post_value) && !empty($user_id)){
            $name= $post_value['name'];
            $image= $post_value['image'];
            $description= $post_value['description'];
            $ip_address=$_SERVER['REMOTE_ADDR'];


            $query = "UPDATE `userdetails` SET 
                        `name` = '".$this->db->real_escape_string($name)."', 
                        `image` = '".$this->db->real_escape_string($image)."', 
                        `ip_address` = '".$this->db->real_escape_string($ip_address)."', 
                        `description` = '".$this->db->real_escape_string($description)."'
                        WHERE `id` =".$user_id;
                        // echo $query;
                        // die;
            if ($result = $this->db->query($query)) {
                return true;
            } else {
                die($this->db->error);
            }

            }
            else{
                return false;
            }
       
    }


 public function insert_uploads($post_value=array()){

        if(!empty($post_value)){
            $name= $post_value['name'];
            $image= $post_value['image'];
            $description= $post_value['description'];
            $ip_address= $post_value['ip_address'];


              $query = "INSERT INTO userdetails (
              `name`, `image`, `ip_address`, `description`, `date_created`
          )
          VALUES (
              '%s', '%s', '%s', '%s', NOW()
          )";
        $query = \sprintf($query, $this->db->real_escape_string($name), $this->db->real_escape_string($image), $this->db->real_escape_string($ip_address),$this->db->real_escape_string($description));
        // echo $query;
        if ($result = $this->db->query($query)) {
            return true;
        } else {
            die($this->db->error);
        }

        }
        else{
            return false;
        }
       
    }



        public function set($d)
        {
            $this->vars = array_merge($this->vars, $d);
        }

       public function render($filename='')
        {

            $this->layout ='layout';
            require(__DIR__ . '/../../src/View/Layout/layout.php');
        }

        private function secure_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        protected function secure_form($form)
        {
            foreach ($form as $key => $value)
            {
                $form[$key] = $this->secure_input($value);
            }
        }


}