<?php

require_once "HTML/QuickForm2.php";
require_once "HTML/QuickForm2/Element/InputText.php";
require_once "HTML/QuickForm2/Element/InputPassword.php";
require_once "HTML/QuickForm2/Element/InputHidden.php";
require_once "HTML/QuickForm2/Element/Button.php";

require_once "app/views/components/db/UserDB.php";
require_once "app/views/components/Session.php";

/**
 * Class for the Login Form
 * Handles user login logic and validation.
 */
class LoginForm extends HTML_QuickForm2 {
    public $email;
    public $passwd;
    public $button;

    public function __construct($id) {
        parent::__construct($id);

        $this->email = new HTML_QuickForm2_Element_InputText("email");
        $this->email->setAttribute("size", 25);
        $this->email->setLabel("E-naslov:");
        $this->email->setAttribute("class", "form-control");
        $this->email->addRule("required", "E-naslov je obvezen.");
        $this->email->addRule("callback", "Vpisi veljaven e-naslov.", [
            "callback" => "filter_var",
            "arguments" => [FILTER_VALIDATE_EMAIL]
        ]);
        $this->email->addRule("callback", "Ta e-posta ne obstaja", [
            "callback" => [$this, "checkAccount"]
        ]);
        $this->email->addRule("callback", "Ta e-posta je deaktivirana", [
            "callback" => [$this, "checkUserStatus"]
        ]);

        $this->passwd = new HTML_QuickForm2_Element_InputPassword("passwd");
        $this->passwd->setAttribute("size", 15);
        $this->passwd->setLabel("Geslo:");
        $this->passwd->setAttribute("class", "form-control");
        $this->passwd->addRule("required", "Geslo je obvezno.");
        $this->passwd->addRule("minlength", "Geslo ne sme biti prazno.", 1);
        $this->passwd->addRule("callback", "Password is incorrect", [
            "callback" => [$this, "checkPassword"]
        ]);

        $this->button = new HTML_QuickForm2_Element_Button(null);
        $this->button->setContent("Prijava");
        $this->button->setAttribute("class", "btn btn-success");

        $this->addElement($this->email);
        $this->addElement($this->passwd);
        $this->addElement($this->button);

        $this->addRecursiveFilter("trim");
        $this->addRecursiveFilter("htmlspecialchars");
    }

    /**
     * Validates the provided password by checking against the database.
     *
     * @return bool True if the password is correct, false otherwise.
     */
    public function checkPassword(): bool {
        $credentials = UserDB::getUserCredentials($this->email->getValue());

        if (!$credentials) {
            return false;
        }
        return password_verify($this->passwd->getValue(), $credentials["geslo"]);
    }

    /**
     * Checks if the email exists in the database.
     *
     * @return bool True if the email does not exist, false otherwise.
     */
    public function checkAccount(): bool {
        return !UserDB::checkEmail($this->email->getValue());
    }

    /**
     * Checks if the user account associated with the email is active.
     *
     * @return bool True if the account is active, false otherwise.
     */
    public function checkUserStatus(): bool {
        return UserDB::checkUserStatus($this->email->getValue());
    }
}

/**
 * Class for the Registration Form
 * Handles user registration logic and validation.
 */
class RegisterForm extends HTML_QuickForm2 {
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $passwd;
    public $confirmPasswd;
    public $button;

    public function __construct($id) {
        parent::__construct($id);

        $this->name = new HTML_QuickForm2_Element_InputText("name");
        $this->name->setAttribute("size", 25);
        $this->name->setLabel("Ime:");
        $this->name->setAttribute("class", "form-control");
        $this->name->addRule("required", "Ime je obvezno.");

        $this->surname = new HTML_QuickForm2_Element_InputText("surname");
        $this->surname->setAttribute("size", 25);
        $this->surname->setLabel("Priimek:");
        $this->surname->setAttribute("class", "form-control");
        $this->surname->addRule("required", "Priimek je obvezno.");

        $this->email = new HTML_QuickForm2_Element_InputText("email");
        $this->email->setAttribute("size", 25);
        $this->email->setLabel("E-naslov:");
        $this->email->setAttribute("class", "form-control");
        $this->email->addRule("required", "E-naslov je obvezen.");
        $this->email->addRule("callback", "Vpisi veljaven e-naslov.", [
            "callback" => "filter_var",
            "arguments" => [FILTER_VALIDATE_EMAIL]
        ]);
        $this->email->addRule("callback", "Ta e-naslov že obstaja.", [
            "callback" => [$this, "checkEmailAvailability"]
        ]);

        $this->phone = new HTML_QuickForm2_Element_InputText("phone");
        $this->phone->setAttribute("size", 25);
        $this->phone->setLabel("Telefonska številka:");
        $this->phone->setAttribute("class", "form-control");
        $this->phone->addRule("regex", "Neveljavna telefonska številka.", "/^\+?\d{9,15}$/");

        $this->passwd = new HTML_QuickForm2_Element_InputPassword("passwd");
        $this->passwd->setAttribute("size", 15);
        $this->passwd->setLabel("Geslo:");
        $this->passwd->setAttribute("class", "form-control");
        $this->passwd->addRule("required", "Geslo je obvezno.");
        $this->passwd->addRule("minlength", "Geslo mora biti dolgo vsaj 6 znakov.", 6);
        $this->passwd->addRule("regex", "Geslo mora vsebovati vsaj eno stevilko.", "/[0-9]+/");
        $this->passwd->addRule("regex", "Geslo mora vsebovati vsaj eno veliko crko.", "/[A-Z]+/");
        $this->passwd->addRule("regex", "Geslo mora vsebovati vsaj eno malo crko.", "/[a-z]+/");

        $this->confirmPasswd = new HTML_QuickForm2_Element_InputPassword("confirmPasswd");
        $this->confirmPasswd->setAttribute("size", 15);
        $this->confirmPasswd->setLabel("Potrdi geslo:");
        $this->confirmPasswd->setAttribute("class", "form-control");
        $this->confirmPasswd->addRule("required", "Potrditev gesla je obvezna.");
        $this->confirmPasswd->addRule("eq", "Gesli se ne ujemata.", $this->passwd);

        $this->button = new HTML_QuickForm2_Element_Button(null);
        $this->button->setContent("Registriraj");
        $this->button->setAttribute("class", "btn btn-success");

        $this->addElement($this->name);
        $this->addElement($this->surname);
        $this->addElement($this->email);
        $this->addElement($this->phone);
        $this->addElement($this->passwd);
        $this->addElement($this->confirmPasswd);
        $this->addElement($this->button);

        $this->addRecursiveFilter("trim");
        $this->addRecursiveFilter("htmlspecialchars");
    }

    /**
     * Checks if the email is available for registration.
     *
     * @param string $email Email address to check.
     * @return bool True if the email is available, false otherwise.
     */
    public function checkEmailAvailability($email): bool {
        return !UserDB::checkEmail($email);
    }
}

/**
 * Class EditForm
 * Handles the form for editing user details, including name, surname, phone, and password updates.
 */
class EditForm extends HTML_QuickForm2 {
    public $userId;
    public $name;
    public $surname;
    public $phone;
    public $role;
    public $button;
    public $changePass;

    /**
     * Constructor for EditForm
     *
     * @param string $id Form ID
     * @param int $user_id User ID for fetching and updating credentials
     */
    public function __construct($id, $user_id) {
        parent::__construct($id);

        $session = new Session();

        $this->userId = new HTML_QuickForm2_Element_InputHidden("userId");
        $this->userId->setValue($user_id);

        $this->name = new HTML_QuickForm2_Element_InputText("name");
        $this->name->setAttribute("size", 25);
        $this->name->setLabel("Ime:");
        $this->name->setAttribute("class", "form-control");
        $this->name->addRule("required", "Ime je obvezno.");

        $this->surname = new HTML_QuickForm2_Element_InputText("surname");
        $this->surname->setAttribute("size", 25);
        $this->surname->setLabel("Priimek:");
        $this->surname->setAttribute("class", "form-control");
        $this->surname->addRule("required", "Priimek je obvezno.");

        $this->phone = new HTML_QuickForm2_Element_InputText("phone");
        $this->phone->setAttribute("size", 25);
        $this->phone->setLabel("Telefonska številka:");
        $this->phone->setAttribute("class", "form-control");
        $this->phone->addRule("regex", "Neveljavna telefonska številka.", "/^\+?\d{9,15}$/");

        $this->button = new HTML_QuickForm2_Element_Button(null);
        $this->button->setContent("Posodobi");
        $this->button->setAttribute("class", "btn btn-success");

        $this->addElement($this->userId);
        $this->addElement($this->name);
        $this->addElement($this->surname);
        $this->addElement($this->phone);

        if ($session->get("role_id") == "1" && $session->get("user_id") != $this->userId->getValue()) {
            $this->role = new HTML_QuickForm2_Element_Select("role");
            $this->role->setLabel("Izberite vlogo uporabnika");

            $roles = UserDB::getRoles();
            foreach ($roles as $role) {
                $this->role->addOption($role["naziv_vloge"], $role["id_vloge"]);
            }

            $userData = UserDB::getUserInfoById($this->userId->getValue());

            $this->role->setValue($userData["id_vloge"]);
            $this->role->addRule("required", "Izberita vloge uporabnika je obvezna.");
            $this->role->setAttribute("class", "form-control");
            $this->addElement($this->role);
        }

        $this->addElement($this->button);

        if ($session->get("user_id") == $this->userId->getValue()) {
            $this->changePass = new HTML_QuickForm2_Element_Button(null);
            $this->changePass->setContent("Spremeni geslo");
            $this->changePass->setAttribute("class", "btn btn-primary");
            $this->changePass->setAttribute("onclick", "window.location.href='change-password'; return false;");
            $this->addElement($this->changePass);
        }

        $this->addRecursiveFilter("trim");
        $this->addRecursiveFilter("htmlspecialchars");
    }

    /**
     * Validates the current password against the database.
     *
     * @return bool True if the current password matches, false otherwise.
     */
    public function checkCurrentPassword(): bool {
        $currentPassword = $this->currPasswd->getValue();

        if (empty($currentPassword)) {
            return true;
        }

        $credentials = UserDB::getUserCredentials((int)$this->userId->getValue());

        if (!$credentials || !isset($credentials["geslo"])) {
            return false;
        }

        return password_verify($currentPassword, $credentials["geslo"]);
    }
}

class ChangePasswordForm extends HTML_QuickForm2 {
    public $currPasswd;
    public $newPasswd;
    public $confirmPasswd;
    public $button;

    public function __construct($id) {
        parent::__construct($id);

        $session = new Session();

        $this->currPasswd = new HTML_QuickForm2_Element_InputPassword("currPasswd");
        $this->currPasswd->setAttribute("size", 15);
        $this->currPasswd->setLabel("Trenutno geslo:");
        $this->currPasswd->setAttribute("class", "form-control");
        $this->currPasswd->addRule("required", "Trenutno geslo je obvezno.");
        // $this->currPasswd->addRule("callback", "Trenutno geslo je narobe", [
        //     "callback" => [$this, "checkCurrentPassword"]
        // ]);

        $this->newPasswd = new HTML_QuickForm2_Element_InputPassword("newPasswd");
        $this->newPasswd->setAttribute("size", 15);
        $this->newPasswd->setLabel("Novo geslo:");
        $this->newPasswd->setAttribute("class", "form-control");
        $this->newPasswd->addRule("required", "Novo geslo je obvezno.");
        $this->newPasswd->addRule("minlength", "Novo geslo mora biti dolgo vsaj 6 znakov.", 6);
        $this->newPasswd->addRule("regex", "Novo geslo mora vsebovati vsaj eno stevilko.", "/[0-9]+/");
        $this->newPasswd->addRule("regex", "Novo geslo mora vsebovati vsaj eno veliko crko.", "/[A-Z]+/");
        $this->newPasswd->addRule("regex", "Novo geslo mora vsebovati vsaj eno malo crko.", "/[a-z]+/");

        $this->confirmPasswd = new HTML_QuickForm2_Element_InputPassword("confirmPasswd");
        $this->confirmPasswd->setAttribute("size", 15);
        $this->confirmPasswd->setLabel("Potrdi geslo:");
        $this->confirmPasswd->setAttribute("class", "form-control");
        $this->confirmPasswd->addRule("required", "Potrditev gesla je obvezna.");
        $this->confirmPasswd->addRule("eq", "Gesli se ne ujemata.", $this->newPasswd);

        $this->button = new HTML_QuickForm2_Element_Button(null);
        $this->button->setContent("Spremeni geslo");
        $this->button->setAttribute("class", "btn btn-success");

        $this->addElement($this->currPasswd);
        $this->addElement($this->newPasswd);
        $this->addElement($this->confirmPasswd);
        $this->addElement($this->button);

        $this->addRecursiveFilter("trim");
        $this->addRecursiveFilter("htmlspecialchars");
    }

    /**
     * Validates the current password against the database.
     *
     * @return bool True if the current password matches, false otherwise.
     */
    public function checkCurrentPassword(): bool {
        $currentPassword = $this->currPasswd->getValue();

        if (empty($currentPassword)) {
            return true;
        }

        $credentials = UserDB::getUserCredentials($session->get("user_id"));

        if (!$credentials || !isset($credentials["geslo"])) {
            return false;
        }

        return password_verify($currentPassword, $credentials["geslo"]);
    }
}



