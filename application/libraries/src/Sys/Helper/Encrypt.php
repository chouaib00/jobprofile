<?php
if ( ! function_exists('encrypt')){
  function encrypt($string){
    $e = new Sys\Security\Encryption();
    return $e->encypt($string);
  }
}
