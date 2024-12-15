<div class="nav">
    <button id="menu-btn">
        <span class="material-icons-sharp">menu</span>
    </button>

    <div class="dark-mode">
        <span class="material-icons-sharp active">light_mode</span>
        <span class="material-icons-sharp">dark_mode</span>
    </div>

    <div class="profile">
        <div class="info">
            <p>
                Pozdravljeni,
                <b id="displayUser">
                    <?= $session->get("fullName"); ?>
                </b>
            </p>
        </div>
    </div>
</div>

<div class="reminders">
    <div class="header">

            <div class="event-container2">
                <h3>Začasni Vnosi</h3>
                <table id="temporaryEntriesTable">
                    <thead>
                        <tr>
                            <th>Jed</th>
                            <th>Kategorija</th>
                            <th>Urejanje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($session->get("temporary_entries") !== null) {
                            foreach ($session->get("temporary_entries") as $index => $entry) {
                                echo "<tr>";
                                echo "<td style='color: black;'>" . htmlspecialchars($entry["menuDish"]) . "</td>";
                                echo "<td style='color: black;'>" . htmlspecialchars($entry["menuCategory"]) . "</td>";
                                echo "<td style='color: black;'><a href='?remove=" . $index . "'>Odstrani</a></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

    </div>
</div>
