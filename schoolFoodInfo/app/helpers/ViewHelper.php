<?php

class ViewHelper {
    /**
     * Render a view file with variables.
     * This method extracts the provided variables into the view's scope and captures the rendered HTML.
     *
     * @param string $file The path to the view file to be rendered.
     * @param array $variables The variables to pass to the view, as an associative array.
     * @return string The rendered HTML content as a string.
     */
    public static function render(string $file, array $variables = []): string {
        extract($variables);

        ob_start();
        include($file);
        return ob_get_clean();
    }

    /**
     * Redirect to the given URL.
     * Immediately stops execution after setting the Location header.
     *
     * @param string $url The URL to redirect to.
     * @return void
     */
    public static function redirect(string $url): void {
        header("Location: " . $url);
        exit();
    }

    /**
     * Display a 404 error page.
     * Sends a 404 HTTP header and outputs an HTML error page.
     *
     * @return void
     */
    public static function error404(): void {
        header("HTTP/1.1 404 Not Found");

        $html404 = sprintf(
            "<!doctype html>\n" .
            "<html><head><title>Error 404: Page does not exist</title></head><body>\n" .
            "<h1>Error 404: Page does not exist</h1>\n" .
            "<p>The page <i>%s</i> does not exist.</p>\n" .
            "<a href='%s/dashboard'>Back to Dashboard</a>\n" .
            "</body></html>",
            htmlspecialchars($_SERVER["REQUEST_URI"], ENT_QUOTES, "UTF-8"),
            BASE_URL
        );

        echo $html404;
    }
}
