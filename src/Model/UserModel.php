<?php

class UserModel
{

      
    /**
     * @var mysqli
    //  */
    private $db;


    public function __construct()
    {
        // $this->db= $GLOBALS['db'];
        // echo 'here';die;
        // echo '<pre>';
        // print_r($this->db);die;
        
    }
    // public function get_current_uploads()
    // {

    //     $res = false;
    //     $query =  "SELECT u.id "
    //         . "FROM userdetails u";
    //     $result = $this->db->query($query);
    //     echo $query;
    //     die;
    //     if ($result && !empty($res)) {  
    //         // Cycle through results
    //         $result->close();
    //         $res= false;
            
    //     } else {
    //         $res= true;
            
    //     }
    //     return $res;

     
    // }

    // public function insert_uploads($post_value=array()){
        // if(!empty($post_value)){
        //     $query = "INSERT INTO post (
        //       `name`, `image`, `ip_address`, `description`, `date_created`
        //   )
        //   VALUES (
        //       '%s', '%s', %s, '%s', NOW()
        //   )";
        //     $query = \sprintf($query, $this->db->real_escape_string($post_value['name']), $this->db->real_escape_string($post_value['image']), , $this->db->real_escape_string($post_value['ip_address']), $this->db->real_escape_string($post_value['description']));
        //     echo $query;
        //     die;
        //     // if ($result = $this->db->query($query)) {
        //     //     return true;
        //     // } else {
        //     //     die($this->db->error);
        //     // }  
        // }
       
    // }


}