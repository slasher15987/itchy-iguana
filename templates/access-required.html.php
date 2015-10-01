<?php if (!isset($_SESSION['isValidUser']) || $_SESSION['isValidUser'] !== true) : ?>
    <div class="container">
        <div class="jumbotron vertical-center">    
            <h1>Access Denied</h1>
            <p>Please <a href="../index.php?view=login">Login</a></p>
        </div>
    </div>
<?php die(); endif; ?>
