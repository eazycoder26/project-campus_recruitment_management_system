<!--  -->
<nav class="navbar navbar-expand-lg navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0 ">
    <a class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5" href="index.php">
    <h1 class="m-0 text-primary"> Dashboard</h1>

    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i> 
                    <?php 
                    // echo $_SESSION['company_info']['c_name'];
                    if (isset($_SESSION['company_info']['c_name'])) {
                        echo htmlspecialchars($_SESSION['company_info']['c_name']);
                    } else {
                        echo "Company";
                    }
                    ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
