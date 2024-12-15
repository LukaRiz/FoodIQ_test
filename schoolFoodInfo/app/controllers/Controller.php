<?php

require_once "app/helpers/ViewHelper.php";
require_once "app/forms/UserForm.php";
require_once "app/views/components/Session.php";
require_once "HTML/QuickForm2/DataSource/Array.php";

class Controller {
    private static string $pagePrefix = "app/views/pages/";

    /**
     * Display the home page.
     *
     * @return void
     */
    public static function home(): void {
        echo ViewHelper::render(self::$pagePrefix . "home.php");
    }

    /**
     * Display the register page. Restricts access to admin users only.
     *
     * @return void
     */
    public static function register(): void {
        $session = new Session();

        if ($session->get("role_id") != 1) {
            header("Location: " . BASE_URL . "dashboard");
            exit();
        }

        echo ViewHelper::render(self::$pagePrefix . "register.php", [
            "form" => new RegisterForm("register_form")
        ]);
    }

    /**
     * Logout the user and destroy the session.
     *
     * @return void
     */
    public static function logout(): void {
        $session = new Session();
        $session->destroy();
    }

    /**
     * Display the login page with the login form.
     *
     * @return void
     */
    public static function login(): void {
        echo ViewHelper::render(self::$pagePrefix . "login.php", [
            "form" => new LoginForm("login_form")
        ]);
    }

    /**
     * Display the dashboard page.
     *
     * @return void
     */
    public static function dashboard(): void {
        echo ViewHelper::render(self::$pagePrefix . "dashboard.php");
    }

    /**
     * Display the users management page.
     *
     * @return void
     */
    public static function users(): void {
        echo ViewHelper::render(self::$pagePrefix . "users.php");
    }

    /**
     * Display the profile page.
     * Allows admin users to view any user's profile, otherwise shows the logged-in user's profile.
     *
     * @return void
     */
    public static function profile(): void {
        $session = new Session();

        if (isset($_GET["id"])) {
            if ($session->get("role_id") != 1) {
                header("Location: " . BASE_URL . "dashboard");
                exit();
            } else {
                $id = $_GET["id"];
            }
        } else {
            $id = $session->get("user_id");
        }

        $user = UserDB::getUserInfoById($id);

        $data = [
            "id" => $id,
            "name" => $user["ime"],
            "surname" => $user["priimek"],
            "phone" => $user["telefon"]
        ];

        $form = new EditForm("edit_form", $id);
        $dataSource = new HTML_QuickForm2_DataSource_Array($data);
        $form->addDataSource($dataSource);

        if (isset($_GET["id"])) {
            $form->setAttribute("action", BASE_URL . "profile?id=" . $_GET["id"]);
        }

        echo ViewHelper::render(self::$pagePrefix . "profile.php", [
            "id" => $id,
            "form" => $form
        ]);
    }

    public static function changePassword(): void {
        echo ViewHelper::render(self::$pagePrefix . "change-password.php", [
            "form" => new ChangePasswordForm("change_password")
        ]);
    }

    public static function view_profile(): void {
        $session = new Session();

        $id = isset($_GET["id"]) ? $_GET["id"]: $session->get("user_id");
        $user = UserDB::getUserInfoById($id);

        $data = [
            "id" => $id,
            "name" => $user["ime"],
            "surname" => $user["priimek"],
            "email" => $user["e_posta"],
            "phone" => $user["telefon"],
            "role" => $user["id_vloge"]
        ];

        echo ViewHelper::render(self::$pagePrefix . "view_profile.php", $data);
    }
}
