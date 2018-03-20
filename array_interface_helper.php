<?php
/*
 * Array Interface Helper
 * Author: Aykut Kardaş
 * Github: http://github.com/aykutkardas
 * Email:  aykutkrds@gmail.com
 */


if(!function_exists('array_interface')) {

  function array_interface($interface, $array)
  {

    // Check Arguments
    if(!$interface || !$array)
      return false;
    
    // Create Report.
    $report = array();
    // Create Controlled Array.
    $controlledArray = array();
    // Error Switch.
    $error = false;

    foreach($interface as $key => $value) {

      // Rule type checking
      if(gettype($interface[$key]) == 'array') {

        // Interface Property Rules
        foreach($interface[$key] as $k => $v) {
          
          
          
          // Required control
          if($k === 'required') {
            if(!ai_check_required($v, @$array[$key])) {
              $report[$key][$k] = "This field can not be left blank!";
              $error = true;
            }
          }
          
          // Property Type Control
          if($k === 'type') {
            if(!ai_check_type($v, @$array[$key])){
              $report[$key][$k] = "This field can only be '$v!";
              $error = true;
            };
          }
          
          // Property Max Length Control
          if($k === 'max_length') {
            if(!ai_check_max_length($v, @$array[$key])){
                $report[$key][$k] = "This field can be up to '$v' lengths long!";
                $error = true;
            };
          }
          
          // Property Min Length 
          if($k === 'min_length') {
            if(!ai_check_min_length($v, @$array[$key])){
                $report[$key][$k] = "This field can be at least '$v' long!";
                $error = true;
            };
          }

          if(isset($array[$key]))
            $controlledArray[$key] = @$array[$key];

          

        }

      } else {
        if(!ai_check_required($interface[$key], @$array[$key])) {
          $report[$key]['required'] = "This field can not be left blank!";
          $error = true;
        }

        if(isset($array[$key]))
          $controlledArray[$key] = $array[$key];
      }

    }

    return array(
      'error' => $error ? $report : false,
      'data'  => $controlledArray
    );

  }


  // Type check.
  // $type = "string|integer|double|boolean|array"
  function ai_check_type($type, $data)
  {
    if(!isset($data)) return true;
    
    if($type === gettype($data))
      return true;
    
    return false;
  }

  // Check max length.
  // $len = integer
  function ai_check_max_length($len, $data)
  {
    if(!isset($data)) return true;

    if(gettype($data) === 'array')
      $data_length = count($data);
    else if(gettype($data) === 'string')
      $data_length = strlen($data);
    else
      return false;

    if($data_length < $len)
      return true;

    return false;
  }

  // Check min length.
  // $len = integer
  function ai_check_min_length($len, $data)
  {
    if(!isset($data)) return true;

    if(gettype($data) === 'array')
      $data_length = count($data);
    else if(gettype($data) === 'string')
      $data_length = strlen($data);
    else
      return false;

    if($data_length >= $len)
      return true;

    return false;
  }

  // Check required
  // $required = true|false
  function ai_check_required($required, $data)
  {
    if($required === true && isset($data)) {
      
      if(ai_check_type('integer', $data) || ai_check_type('double', $data))
        return true;
      else if(ai_check_type('boolean', $data))
        return true;
      else if(ai_check_min_length(1, $data))
        return true;
      else
        return false;
        
    } else if($required === false) {
      return true;
    }

    return false;
  }

}