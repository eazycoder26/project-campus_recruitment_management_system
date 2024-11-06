<nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
        <a class="navbar-brand" href="index.php">
            <h2 class="text-success">Dashboard</h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user"></i> 
                    
					<?php 
					// echo $_SESSION['admin_info']['email'] ;
					
                        // if (isset($_SESSION['candidate_name'])) {
                        //     echo htmlspecialchars($_SESSION['candidate_name']); 
                        // } 
                        // else {
                        //     echo "User";
                        // }
                        
					
					?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>