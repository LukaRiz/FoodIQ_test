<?php

require_once "app/helpers/ViewHelper.php";
require_once "app/forms/UserForm.php";
require_once "app/forms/FoodForm.php";
require_once "app/views/components/Session.php";
require_once "app/views/components/db/UserDB.php";

class DashboardController {
    private static string $pagePrefix = "app/views/pages/";

    /**
     * Display the dashboard page with a specified subpage.
     * Validates the subpage and determines the appropriate file and form to load.
     *
     * @param  string $page Subpage to display (e.g., "/history" or "/menu").
     * @return void
     */
    public static function dashboard(string $page): void {
        if (preg_match("/^(\/[a-zA-Z0-9_-]+)?$/", $page)) {
            $subpage = substr($page, 1); // Remove the leading slash
            $fileName = self::getFileName($subpage);

            if (empty($fileName)) {
                echo ViewHelper::error404();
                return;
            }

            $renderData = [
                "fileName" => $fileName,
                "form"     => self::getForm($subpage),
            ];

            echo ViewHelper::render(self::$pagePrefix . "dashboard.php", $renderData);
        } else {
            echo ViewHelper::error404();
        }
    }

    /**
     * Retrieve the file name associated with a given subpage.
     *
     * @param  string $path Subpage path (e.g., "history" or "").
     * @return string File name for the subpage or an empty string if not found.
     */
    public static function getFileName(string $path): string {
        $fileNames = [
            "history" => "history.php",
            ""        => "menu/menu.php",
        ];

        return $fileNames[$path] ?? "";
    }

    /**
     * Retrieve the form object for a given subpage.
     *
     * @param  string $path Subpage path (e.g., "menu").
     * @return FoodForm|null Form object for the subpage, or null if not applicable.
     */
    public static function getForm(string $path): ?FoodForm {
        $forms = [
            "" => fn(): FoodForm => new FoodForm("food_form"),
        ];

        if (isset($forms[$path])) {
            return $forms[$path]();
        }

        return null;
    }
}
