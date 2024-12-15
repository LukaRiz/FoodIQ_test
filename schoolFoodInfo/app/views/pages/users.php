<!DOCTYPE html>
<html lang="en">

<?php
require_once "app/views/components/header.php";
require_once "app/views/components/db/UserDB.php";

if (isset($_GET["remove"]) && $session->get("role_id") == 1) {
    $id = preg_replace("/[^0-9]/", "", $_GET["remove"]);
    $result = UserDB::deleteUser($id);
}

if (isset($_GET["deactive"]) && ($session->get("role_id") == 1 || $session->get("role_id") == 2)) {
    $id = preg_replace("/[^0-9]/", "", $_GET["deactive"]);
    $result = UserDB::updateUserStatus("deactivate", $id);
}

if (isset($_GET["active"]) && ($session->get("role_id") == 1 || $session->get("role_id") == 2)) {
    $id = preg_replace("/[^0-9]/", "", $_GET["active"]);
    $result = UserDB::updateUserStatus("activate", $id);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_URL ?>dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= CSS_URL ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= CSS_URL ?>style.css">

    <title>FoodIQ - Uporabniki</title>
</head>

<body>

    <?php require_once "app/views/pages/menu/navbar.php"; ?>

    <div class="card">
        <div class="card-header">
            <h3>
                <i class="fas fa-users mr-2"></i> Seznam uporabnikov
                <span class="float-right">Dobrodošli!
                    <strong>
                        <span class="badge badge-lg badge-secondary text-white">
                            <?= $session->get("fullName"); ?>
                        </span>
                    </strong>
                </span>
            </h3>
        </div>

        <div class="card-body pr-2 pl-2">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Zaporedna številka</th>
                        <th class="text-center">Ime</th>
                        <th class="text-center">Priimek</th>
                        <th class="text-center">E-posta</th>
                        <th class="text-center">Telefon</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ustvarjen</th>
                        <th width="25%" class="text-center">Akcija</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = UserDB::selectAllUsers();

                    if ($users) {
                        foreach ($users as $i => $value) {
                            $highlight = $session->get("user_id") == $value["id_uporabnika"] ? "style='background:#d9edf7'" : "";
                            ?>
                            <tr class="text-center" <?= $highlight; ?>>
                                <td><?= $i + 1; ?></td>
                                <td><?= htmlspecialchars($value["ime"]); ?></td>
                                <td>
                                    <?= htmlspecialchars($value["priimek"]); ?><br>
                                    <?php if ($value["id_vloge"] == 1) {
                                        echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                                    } elseif ($value["id_vloge"] == 2) {
                                        echo "<span class='badge badge-lg badge-dark text-white'>Editor</span>";
                                    } elseif ($value["id_vloge"] == 3) {
                                        echo "<span class='badge badge-lg badge-dark text-white'>User Only</span>";
                                    } ?>
                                </td>
                                <td><?= htmlspecialchars($value["e_posta"]); ?></td>
                                <td><span class="badge badge-lg badge-secondary text-white"><?= htmlspecialchars($value["telefon"]); ?></span></td>
                                <td>
                                    <?php if ($value["aktiven"] == 1) { ?>
                                        <span class="badge badge-lg badge-info text-white">Active</span>
                                    <?php } else { ?>
                                        <span class="badge badge-lg badge-danger text-white">Deactive</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <span class="badge badge-lg badge-secondary text-white">
                                        <?= htmlspecialchars(date("Y-m-d H:i:s", strtotime($value["uporabnik_ustvarjen"]))); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($session->get("role_id") == 1) { ?>
                                        <a class="btn btn-success btn-sm" href="view-profile?id=<?= $value["id_uporabnika"]; ?>">Ogled</a>
                                        <a class="btn btn-info btn-sm" href="profile?id=<?= $value["id_uporabnika"]; ?>">Uredi</a>
                                        <a class="btn btn-danger btn-sm <?= $session->get("user_id") == $value["id_uporabnika"] ? "disabled" : ""; ?>"
                                           href="?remove=<?= $value["id_uporabnika"]; ?>"
                                           onclick="return confirm('Ali ste prepričani, da želite odstraniti uporabnika?')">Odstrani</a>
                                        <?php if ($value["aktiven"] == 1) { ?>
                                            <a class="btn btn-warning btn-sm <?= $session->get("user_id") == $value["id_uporabnika"] ? "disabled" : ""; ?>"
                                               href="?deactive=<?= $value["id_uporabnika"]; ?>"
                                               onclick="return confirm('Ali ste prepričani, da želite deaktivirati uporabnika?')">Onemogoči</a>
                                        <?php } else { ?>
                                            <a class="btn btn-secondary btn-sm <?= $session->get("user_id") == $value["id_uporabnika"] ? "disabled" : ""; ?>"
                                               href="?active=<?= $value["id_uporabnika"]; ?>"
                                               onclick="return confirm('Ali ste prepričani, da želite aktivirati uporabnika?')">Aktiviraj</a>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else { ?>
                        <tr class="text-center">
                            <td colspan="8">No user available now!</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php require_once "app/views/components/footer.php"; ?>
</body>
</html>
