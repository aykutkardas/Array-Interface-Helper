<?php

// include helper.
include '../array_interface_helper.php';

// Create item interface.
$ItemInterface = array(
    'title' => array(
        'type'         => 'string',
        'min_length'   => 5,
        'required'     => true
    ),

    'detail' => array(
        'type'        => 'string',
        'min_length'  => 20,
        'max_length'  => 200,
        'required'    => true
    ),

    'price' => array(
        'type'       => 'double',
        'required'   => true
    ),

    'favorite'  => array(
        'type'     => 'boolean',
        'required' => true
    ),

    'comments'  => array(
        'type' => 'array',
        'required' => false
    )
);

// Example Array

// pass
$Item0 = array( 
    'title' => 'Mousepad 0',
    'detail' => 'Reprehenderit quia a iste explicabo, quo tempora repellendus odio.',
    'price' => 29.90,
    'favorite' => true,
    'comments' => array(
        'Best!',
        'Great, pad!'
    )
);

// fail
$Item1 = array(
    'title' => 'Mousepad 1',
    'detail' => '',
    'price' => 120
);

// pass
$Item2 = array(
    'title' => 'Mousepad 2',
    'detail' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.',
    'price' => 19.30,
    'favorite' => false,
);

// fail
$Item3 = array(
    'title' => 'Mousepad 3',
    'detail' => 'Reprehenderit quia a iste explicabo, quo tempora repellendus odio.',
    'price' => 32,  // <- not double
    'favorite' => true,
);

$itemList = array($Item0, $Item1, $Item2, $Item3);


foreach ($itemList as $item) {

    $controlledItem = array_interface($ItemInterface, $item);

    if($controlledItem['error']) {
        // error code here
    } else {
        extract($controlledItem['data']);

        $style = 'border-left: 2px solid' . $favorite ? 'orange' : 'silver';

        echo "<div style='".$style."'>";
        echo "<h1>" . $title  . "</h1>";
        echo "<p>"  . $detail . "</p>";
        echo "<h3>" . $price  . "</h3>";
        if(isset($comments)){
            echo "<ul>";
                foreach ($comments as $comment) {
                    echo "<li>" . $comment . "</li>";
                }
            echo "</ul>";
        } 
        echo "</div>";

        unset($title, $detail, $price, $comments, $favorite);
    }

}
