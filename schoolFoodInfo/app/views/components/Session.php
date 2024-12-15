<?php

class Session {
    /**
     * Constructor to initialize the session.
     * Starts a new session if none exists.
     */
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a session key-value pair.
     *
     * @param string $key The session key.
     * @param mixed $val The value to store in the session.
     * @return void
     */
    public function set(string $key, $val): void {
        $_SESSION[$key] = $val;
    }

    /**
     * Get a session value by key.
     *
     * @param string $key The session key.
     * @return mixed The session value,.
     */
    public function get(string $key): mixed {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : null;
    }

    /**
     * Destroy the session and redirect to the login page.
     *
     * @return void
     */
    public function destroy(): void {
        session_unset();
        session_destroy();
        $this->redirect("login");
    }

    /**
      * Remove a session key-value pair.
      *
      * @param string $key The session key to remove.
      * @return void
      */
    public function remove(string $key): void {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Check if the session is active. Redirects based on session state and current page.
     *
     * @return void
     */
    public function checkSession(): void {
        $currentPage = basename($_SERVER["PHP_SELF"], ".php");
        $excludedPages = ["home", "login"];

        if (in_array($currentPage, $excludedPages)) {
            if ($currentPage === "login" && $this->get("login")) {
                $this->redirect("dashboard");
            }
            return;
        }

        if (!$this->get("login")) {
            $this->redirect("home");
        }
    }

    /**
     * Redirect to a given URL.
     *
     * @param string $url The URL to redirect to.
     * @return void
     */
    private function redirect(string $url): void {
        header("Location: " . $url);
        exit();
    }
}
