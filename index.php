<?php


// see access_keys.txt for sample
require("./dbaccess.php");
require("./includes/get_hostname.php");

// test locally: $ php -S localhost:8000

/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

// GET route
$app->get(
    '/',
    function () {
        $template = require('index_page.php');
        echo $template;
    }
);


// GET route
$app->get(
    '/template',
    function () {
        $template = require('template.php');
        echo $template;
    }
);


$app->get('/banner-image','getBannerImage');



function getBannerImage() {
// $sql = "SELECT user_id,username,name,profile_pic FROM users ORDER BY user_id DESC";

try {
  # MySQL with PDO_MYSQL
  $db = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8", $db_username, $db_password);
}
catch(PDOException $e) {
    echo "<p>PDO ERROR: ".$e->getMessage()."</p>";
}

    // prepare PDO
    // return the object with lowest hits as first result
    $get_objects=$db->prepare("SELECT * FROM `banner_image`;");
    // $get_objects=$db->prepare("SELECT * FROM `banner_image` ORDER BY `hits` ASC;");
    // execute
    $get_objects->execute();
    // fetch results as array
    $json_results=$get_objects->fetchAll(PDO::FETCH_ASSOC);

}







// POST route
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);

// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
