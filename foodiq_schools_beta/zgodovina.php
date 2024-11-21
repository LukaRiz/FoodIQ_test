
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="assets/style3.css">
    <title>FoodIQ</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="assets/0707__2__1_-removebg.png">
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="index3.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Glavna plošča</h3>
                </a>
                <a href="index2.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Uporabniki</h3>
                </a>
                <a href="zgodovina.php">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Zgodovina</h3>
                </a>
                <a href="#" class="active">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analize</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Nastavitve</h3>
                </a>
                <a href="index.html">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Odjava</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
        <div class="recent-orders">
                <h2>Zgodovina</h2>
                <div class="event-container">
                    <form id="menuForm">
                    <h3>Obstoječi Vnosi</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Datum</th>
                                <th>Jed</th>
                                <th>Kategorija</th>
                                <th>Urejanje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic content -->
                        </tbody>
                    </table>
                    </form>

                    
                </div>
            </div>
        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <!-- Display selected user -->
                <div class="profile">
                    <div class="info">
                        <p>Pozdravljeni, <b id="displayUser"></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                </div>
            </div>
            <!-- End of Nav -->

            <div class="reminders">
                <div class="header">
                    <h2>Opombe</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>
            </div>
        </div>

    </div>

    <script src="orders.js"></script>
    <script src="assets/index.js"></script>
    <script src="event.js"></script>
    <script>
        // Load selected chef from localStorage and display
        document.addEventListener("DOMContentLoaded", function() {
            const selectedUser = localStorage.getItem("selectedUser") || "Uporabnik";
            document.getElementById("displayUser").textContent = selectedUser;
        });
    </script>
</body>

</html>
