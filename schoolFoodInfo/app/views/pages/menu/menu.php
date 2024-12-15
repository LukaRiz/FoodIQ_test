<?php
if (isset($_GET["remove"])) {
    $index = $_GET["remove"];

    $arr = $session->get("temporary_entries");

    if (isset($arr[$index])) {
        unset($arr[$index]);
        $arr = array_values($arr);
        $session->set("temporary_entries", $arr);
    }
}

if ($form->validate()) {
    $formData = $form->getValue();

    if ($session->get("temporary_entries") === null) {
        $session->set("temporary_entries", []);
        $arr = [];
    } else {
        $arr = $session->get("temporary_entries");
    }

    $arr[] = $formData;
    $session->set("temporary_entries", $arr);

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "add_all") {
    if ($session->get("temporary_entries") !== null && !empty($session->get("temporary_entries"))) {
        try {
            foreach ($session->get("temporary_entries") as $formData) {
                $dataFood = [
                    "naziv_jedi" => $formData["menuDish"],
                    "id_kategorije" => $formData["menuCategory"]
                ];

                $dataChildren = [
                    "datum" => $formData["menuDate"],
                    "prijavljeni_otroci" => $formData["registeredChildren"],
                    "poskenirani_otroci" => $formData["scannedChildren"],
                    "opombe" => $formData["notes"]
                ];

                $foodId = FoodDB::insertDataJed($dataFood);

                FoodDB::insertDataPrisotnost($dataChildren);

                $data = [
                    "id_jedi" => $foodId,
                    "kolicina_kuhana" => $formData["cookedQuantity"],
                    "kolicina_nepostrezena" => $formData["unusedQuantity"]
                ];

                FoodDB::insertDataMeniJed($data);
            }

            $session->remove("temporary_entries");

            header("Location: dashboard");
            exit();
        } catch (PDOException $exc) {
            echo "Napaka pri pošiljanju podatkov v bazo.";
        }
    } else {
        echo "<p>Ni vnosov za dodajanje.</p>";
    }
}
?>

<div class="recent-orders">
    <h2>3.1.1 Vnos Menija in Urejanje Menijev</h2>

    <div class="event-container">
        <?php
        echo $form;
        ?>

       

        <?php if ($session->get("temporary_entries") !== null && !empty($session->get("temporary_entries"))): ?>
            <form method="post" action="">
                <input type="hidden" name="action" value="add_all">
                <button type="submit">Dodaj Vse</button>
            </form>
        <?php endif; ?>
    </div>
</div>
