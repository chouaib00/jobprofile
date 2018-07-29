<?php
namespace Sys\Security;
class Encryption{

  private $_hashkey = '';
  private $_hash_algo = 'sha256';
  //hash_algos()

  public function encypt($string){
    return hash($this->_hash_algo, $string);
  }
}
