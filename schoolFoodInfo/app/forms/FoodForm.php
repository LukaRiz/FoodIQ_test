<?php

require_once "HTML/QuickForm2.php";
require_once "HTML/QuickForm2/Element/InputText.php";
require_once "HTML/QuickForm2/Element/Date.php";
require_once "HTML/QuickForm2/Element/Select.php";
require_once "HTML/QuickForm2/Element/Textarea.php";
require_once "HTML/QuickForm2/Element/Button.php";
require_once "app/views/components/db/FoodDB.php";

require_once 'HTML/QuickForm2/Element/Input.php';

class HTML_QuickForm2_Element_DateInput extends HTML_QuickForm2_Element_Input {
    protected $attributes = ['type' => 'date'];
}

HTML_QuickForm2_Factory::registerElement('dateinput', 'HTML_QuickForm2_Element_DateInput');

/**
 * FoodForm Class
 * Manages the input form for adding or updating menu data, including details like date, dish name, category, quantities, and notes.
 */
class FoodForm extends HTML_QuickForm2 {
    public $menuDate;
    public $menuDish;
    public $menuCategory;
    public $cookedQuantity;
    public $unusedQuantity;
    public $registeredChildren;
    public $scannedChildren;
    public $notes;
    public $buttonSubmit;
    public $buttonReset;

    /**
     * FoodForm constructor.
     * Initializes the form with various elements for menu data input.
     *
     * @param string $id The form's ID
     */
    public function __construct($id) {
        parent::__construct($id);

        $this->menuDate = $this->addElement("dateinput", "menuDate");
        $this->menuDate->setLabel("Datum (privzeto naslednji dan od zadnjega vnosa):");
        $this->menuDate->addRule("required", "Datum je obvezen.");
        $this->menuDate->setAttribute("pattern", "\d{4}-\d{2}-\d{2}");
        $this->menuDate->setValue(date("Y-m-d", strtotime("tomorrow")));

        $this->menuDish = new HTML_QuickForm2_Element_InputText("menuDish");
        $this->menuDish->setLabel("Jed:");
        $this->menuDish->setAttribute("placeholder", "Vnesite ime jedi");
        $this->menuDish->addRule("required", "Ime jedi je obvezno.");

        $this->menuCategory = new HTML_QuickForm2_Element_Select("menuCategory");
        $this->menuCategory->setLabel("Kategorija Jedi:");
        $this->menuCategory->addOption("Izberi kategorijo", "");

        $categories = FoodDB::getCategories();
        foreach ($categories as $category) {
            $this->menuCategory->addOption($category["naziv_kategorije"], $category["id_kategorije"]);
        }
        $this->menuCategory->addRule("required", "Izbira kategorije je obvezna.");

        $this->cookedQuantity = new HTML_QuickForm2_Element_InputText("cookedQuantity");
        $this->cookedQuantity->setLabel("Vpis kuhane količine:");
        $this->cookedQuantity->addRule("required", "Količina je obvezna.");
        $this->cookedQuantity->addRule("regex", "Količina mora biti številka.", "/^\d+$/");
        $this->cookedQuantity->setAttribute("oninput", "this.value=this.value.replace(/[^0-9]/g,'');");

        $this->unusedQuantity = new HTML_QuickForm2_Element_InputText("unusedQuantity");
        $this->unusedQuantity->setLabel("Vpis ne-postrežene količine:");
        $this->unusedQuantity->addRule("required", "Količina ne-postreženih jedi je obvezna.");
        $this->unusedQuantity->addRule("regex", "Količina mora biti številka.", "/^\d+$/");
        $this->unusedQuantity->setAttribute("oninput", "this.value=this.value.replace(/[^0-9]/g,'');");

        $this->registeredChildren = new HTML_QuickForm2_Element_InputText("registeredChildren");
        $this->registeredChildren->setLabel("Vpis prijavljenih otrok na dan:");
        $this->registeredChildren->addRule("required", "Vpis prijavljenih otrok je obvezen.");
        $this->registeredChildren->addRule("regex", "Količina mora biti številka.", "/^\d+$/");
        $this->registeredChildren->setAttribute("oninput", "this.value=this.value.replace(/[^0-9]/g,'');");

        $this->scannedChildren = new HTML_QuickForm2_Element_InputText("scannedChildren");
        $this->scannedChildren->setLabel("Vpis poskeniranih otrok na dan:");
        $this->scannedChildren->addRule("required", "Vpis poskeniranih otrok je obvezen.");
        $this->scannedChildren->addRule("regex", "Količina mora biti številka.", "/^\d+$/");
        $this->scannedChildren->setAttribute("oninput", "this.value=this.value.replace(/[^0-9]/g,'');");

        $this->notes = new HTML_QuickForm2_Element_Textarea("notes");
        $this->notes->setLabel("Polje za opombe:");

        $this->buttonSubmit = new HTML_QuickForm2_Element_Button(null);
        $this->buttonSubmit->setContent("Dodaj vnos");
        $this->buttonSubmit->setAttribute("class", "btn btn-success");

        $this->buttonReset = new HTML_QuickForm2_Element_Button(null);
        $this->buttonReset->setContent("Prekliči");
        $this->buttonReset->setAttribute("class", "btn btn-secondary");

        $this->addElement($this->menuDate);
        $this->addElement($this->menuDish);
        $this->addElement($this->menuCategory);
        $this->addElement($this->cookedQuantity);
        $this->addElement($this->unusedQuantity);
        $this->addElement($this->registeredChildren);
        $this->addElement($this->scannedChildren);
        $this->addElement($this->notes);
        $this->addElement($this->buttonSubmit);
        $this->addElement($this->buttonReset);

        $this->addRecursiveFilter("trim");
        $this->addRecursiveFilter("htmlspecialchars");
    }
}
