<?php

class customException extends Exception {
    
  public function errorMessage($error) {
   try {
if($error==true){
    //throw exception if email is not valid
    throw new customException("not found");
  
}
}

catch (customException $e) {
  //display custom message
  echo true;
}
  }
}


?>