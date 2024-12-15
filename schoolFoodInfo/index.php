<?php
// Display all errors for debugging purposes
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Include necessary controllers
require_once "app/controllers/Controller.php";
require_once "app/controllers/DashboardController.php";

// Define constants for URLs
define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "public/assets/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "public/assets/css/");
define("SCRIPT_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "public/assets/script/");

// Get the requested path or default to an empty string
$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// Define routing map: path => function
$urls = [
    "home" => function() {
        Controller::home();
    },
    "login" => function() {
        Controller::login();
    },
    "logout" => function() {
        Controller::logout();
    },
    "register" => function() {
        Controller::register();
    },
    "users" => function() {
        Controller::users();
    },
    "profile" => function() {
        Controller::profile();
    },
    "view-profile" => function() {
        Controller::view_profile();
    },
    "change-password" => function() {
        Controller::changePassword();
    },
    "" => function() {
        ViewHelper::redirect(BASE_URL . "home"); // Redirect to home if no path is specified
    }
];

try {
    // Check if the requested path exists in the routing map
    if (isset($urls[$path])) {
        $urls[$path](); // Call the corresponding function
    }
    // Handle dashboard subpages
    else if (strpos($path, "dashboard") === 0) {
        $subpage = substr($path, strlen("dashboard")); // Extract subpage from path
        DashboardController::dashboard($subpage);
    }
    // No matching controller found
    else {
        echo "No controller for \"" . htmlspecialchars($path) . "\"";
    }
}
// Handle invalid arguments (e.g., missing parameters)
catch (InvalidArgumentException $e) {
    ViewHelper::error404();
    var_dump($e->getMessage()); // Debugging information
}
// Handle any other exceptions
catch (Exception $e) {
    echo "An error occurred: <pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
