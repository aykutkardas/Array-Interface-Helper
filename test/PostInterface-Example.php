<?php

// include helper.
include '../array_interface_helper.php';

// Create post interface.
$PostInterface = array(
    'name' => array(
        'type'       => 'string',
        'required'   => true,
        'min_length' => 5,
        'max_length' => 100,
    ),
    
    'surname' => array(
        'type'       => 'string',
        'required'   => true,
        'min_length' => 5,
        'max_length' => 100,
    ),

    'age' => array(
        'type'      => 'integer',
        'required'  => false
    )
);


if(isset($_POST) && !empty($_POST)) {

    // Type transform
    $_POST['age'] =  !empty($_POST['age']) ? (int)$_POST['age'] : null;  // <---- Toggle Comment

    echo '<pre>';
    print_r(array_interface($PostInterface, $_POST));
    echo '</pre>';
}

?>

<form action="" method="post">

    <p>Type: String, Min length: 5, Max length: 100, Required</p>
    <br>
    <input type="text" name="name" placeholder="name">

    <p>Type: String, Min length: 5, Max length: 100, Required</p>
    <br>
    <input type="text" name="surname" placeholder="surname">

    <p>Type: Integer</p>
    <br>
    <input type="number" name="age" placeholder="age">

    <br>
    <br>
    <button type="submit">Send</button>

</form>