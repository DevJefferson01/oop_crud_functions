<?php 

/**
 * separate session class
 */
class Session
{

	function __construct()
	{
		// code...
	}

	 private function start_session()
   {

   	 if(!isset($_SESSION)){
   	 	session_start();
   	 }

   }

	public function flush()
	{
        $this->start_session();
		session_destroy();
	}

	public function set($mykey, $myvalue = '')
	{
		 $this->start_session();
		if(is_string($mykey))
		{
			$_SESSION[$mykey] = $myvalue; 
		}elseif (is_array($mykey)) 
		{
			foreach ($mykey as $key => $value) {

			   $_SESSION[$key] = $value;
				// code...
			}
			// code...
		}

	}

	public function get($key)
	{
		 $this->start_session();
		 if (isset($_SESSION[$key])) {
		 	   return $_SESSION[$key];
		  	// code...
		  } 


	}

	public function remove($key)
	{
		 $this->start_session();
		 if (isset($_SESSION[$key])) {
		 	  unset( $_SESSION[$key]);
		 	  return true; 
		  	// code...
		  } 

       return false;
	}

	 public function exists($key)
	{
		 $this->start_session();
		 if (isset($_SESSION[$key])) {
		 	  return true;
		  	// code...
		  } 

       return false;
	}

	public function regenerate()
	{
		session_regenerate_id();

	}




}