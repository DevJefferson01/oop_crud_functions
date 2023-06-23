<?php
 
 /**
  * 
  */
 class User
 {  
 	protected static $instance;
 	
 	function __construct()
 	{
 		// code...
 	}
 	public static function action()
 	{
 		if (!self::$instance) 
 		{
 			self::$instance = new self();
 		}
 		return self::$instance;
 	}


 	public function create($POST)
 	{
        $errors = array();

        $arr['username'] = ucwords(trim($POST['username']));
        $arr['email'] = trim($POST['email']);
        $arr['password'] = $POST['password'];
        $arr['gender'] = trim($POST['gender']);
        $arr['date'] = date("Y-m-d H:i:s");

        //validation
        
        if (empty($arr['username']) ||  !preg_match("/^[a-zA-Z ]+$/", $arr['username'])) 
        {

            // code...
            $errors[] = "username can only have letters and spaces";
        }

          if(!filter_var($arr['email'],FILTER_VALIDATE_EMAIL)) {

            // code...
            $errors[] = "stricktky use valid email addresses";
        }

         if(empty($arr["password"])) {

            // code...
            $errors[] = "sorry please enter your password";
        }

        if(strlen($arr["password"]) < 8) {

            // code...
            $errors[] = "password should be 8 characters or more";
        }


         if ( $arr['gender'] == "--select gender--" && ($arr['gender'] != "male" || $arr['gender'] != "female" )) {

            // code...
            $errors[] = "gender can only be male or female";
        }


        //save to database

       if (count($errors)== 0) {

           return DB::table('users')->insert($arr);
           // code...
       }

       return $errors;




      

 	}

    public function login($POST)
    {
        $errors = array();

        
        $arr['email'] = trim($POST['email']);
        $password = $POST['password'];
       

       


        //read from database
        $data =  DB::table('users')->select()->where("email = :email", $arr);
           // code...

       if (is_array($data))
        {
            $data = $data[0];
            if ($data->password == $password)
             {  
                
                $ses = new Session();
                $ses->regenerate();

               $arr['username'] = $data->username;
                $arr['email'] = $data->email;
                $arr['LOGGED_IN'] = 1;
                $ses->set('USER' , $arr);

                return true;
            }

           // code...
       }

       $errors[] = "wrong email or password";

       return $errors;




      

    }

 	public function update_by_id($values, $id)
 	{
 		return DB::table('users')->update($values)->where("id = :id", ["id"=>$id]);


 	}

    public function restrict()
    {  
        $ses = new Session();
        if ($ses->get('USER')) 
        {
            $data = $ses->get('USER');

            $email = $data['email'];

        //read from database
        $data =  $this->get_by_email($email);
           // code...

       if (is_array($data))
        {
            return true;

         }   
       }

       return false;

    }

 	public function get_all()
 	{
 		return  DB::table('users')->select()->all();
 	}

 /*	public function get_by_id($id)
 	{
 		return  DB::table('users')->select()->where("id = :id",["id"=>$id]);

 	}

 	public function get_by_email($email)
 	{
 		return  DB::table('users')->select()->where("email = :email",["email"=>$email]);

 	}*/


    /*
    * get data using provided column name
    */

 	public function __call($function, $params)
 	{
        $values =  $params[0];
        $column = str_replace("get_by_", "", $function);
        $column = addslashes($column);

       //check if column exists

        $check = DB::table('users')->query('show columns from users');
        echo "<pre>";
       $all_column = array_column($check, "Field");
       if (in_array($column, $all_column)) {
           // code...
        return DB::table('users')->select()->where($column . " = :" . $column, [$column =>$values]);
       }


        
        return false;


 	}

 }
