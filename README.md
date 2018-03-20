# Array-Interface-Helper
Array Interface for PHP

Create an interface for control.
```php
$PostInterface = array(
  'title' => array(
    'type'       => 'string', //  "string|integer|boolean|array|double"
    'required'   => true,
    'max_length' => 15,
    'min_length' => 2
  ),
  'content' => array(
    'type'       => 'string',
    'required'   => true,
    'min_length' => 3
  ),
  'categoryId' => false // required?
);
```


For example, the array from POST request.
```php
$_POST = array(
  'title'      => 'Example',
  'content'    => '',
  'categoryId' => '3',
  'author'     => 'John Doe'
);
```

Let's use the array interface.
```php
$controlledPost = array_interface($PostInterface, $_POST);

if($controlledPost['error']) {
  // error code here
} else {
  // success code here
}
```

Output $controlledPost;

```php
print_r($controlledPost);
```
```html
Array
(
    [error] => Array
        (
            [content] => Array
                (
                    [min_length] => This field can be at least '3' long!
                )

        )

    [data] => Array
        (
            [title] => Example
            [content] => 
            [categoryId] => 3
        )

)
```

## Use with CodeIgniter

Copy the file into the "application/helpers/**array_interface_helper.php**" directory.

Call in the controller and use.

```php
class Posts extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helpers('array_interface');
  }
  
  // ...
  
  public AddPost()
  {
    $PostInterface = array(
      'title' => array(
        'type'       => 'string',
        'required'   => true,
        'max_length' => 15,
        'min_length' => 2
      ),
      'content' => array(
        'type'       => 'string',
        'required'   => true,
        'min_length' => 3
      ),
      'categoryId' => false // required?
    );

   
   if($this->input->post()){
    $controlledPost = array_interface($PostInterface, $this->input->post());
    
    if($controlledPost['error']) {
      // error code here
    } else {
      // success code here
    }
   }
   
  }

}
```
