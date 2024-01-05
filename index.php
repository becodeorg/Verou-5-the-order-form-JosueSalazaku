<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Basile Variants' , 'description' => ' - Basile as Gandalf the Gray', 'price' => 50],
    ['name' => 'Basile Variants' , 'description' => ' - Basile as Edna Mode', 'price' => 35],
    ['name' => 'Basile Variants' , 'description' => ' - Basile as Spiderman', 'price' => 55],
    ['name' => 'Basile Variants' , 'description' => ' - Basile as Wednesday Addams', 'price' => 65],
    ['name' => 'Basile Variants' , 'description' => ' - Basile as Levi Ackerman', 'price' => 65],
    ['name' => 'Basile Variants' , 'description' => ' - Basile as Ellen Ripley', 'price' => 50],
    ['name' => 'Basile Variants' , 'description' => ' - Basile as Satoru Gojo', 'price' => 45],
    ['name' => 'Basile Variants' , 'description' => ' - Basile as Sarah Connor ', 'price' => 50],
    ['name' => 'Basile Variants' , 'description' => ' - Basile as Morpheus', 'price' => 35],
    ['name' => 'Basile Variants' , 'description' => ' - Basile as The Joker ', 'price' => 45], 
];

$totalValue = 0;

function validate()
{ 
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $invalidFields[] = "email";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $invalidFields[] = "email_invalid";
        }

        if (empty($_POST["street"])) {
            $invalidFields[] = "street";
        } 

        if (empty($_POST["streetnumber"]) || !ctype_digit($_POST["streetnumber"]) || $_POST["streetnumber"] <= 0) {
            $invalidFields[] = "streetnumber";
        }

        if (empty($_POST["city"])) {
            $invalidFields[] = "city";
        }
        
        if (empty($_POST["zipcode"])) {
            $invalidFields[] = "zipcode";
        }
    }

    // TODO: This function will send a list of invalid fields back
    return $invalidFields;
}

function handleForm()
{
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        $_SESSION['errors'] = $invalidFields;
        header("Location: form-view.php");
        exit;
    } else {
        // TODO: handle successful submission
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            $street = htmlspecialchars($_POST["street"]);
            $streetnumber = htmlspecialchars($_POST["streetnumber"]);
            $city = htmlspecialchars($_POST["city"]);
            $zipcode = htmlspecialchars($_POST["zipcode"]);
        } 
    }
}

// TODO: replace this if by an actual check for the form to be submitted
$formSubmitted = false;
if ($formSubmitted) {
    handleForm();
}
require 'form-view.php';