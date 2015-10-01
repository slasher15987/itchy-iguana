<?php
$results = "";
if (isPostRequest()) {

    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if (!existingEmail($email, "email", "users")) {


        if (createNewUser($email, $password)) {
            $results = "User Registered";
        } else {
            $results = "Error, try again";
        }
    } else {
        $results = 'User already exists. Sorry, please try again.';
    }
}
?>



<h3>To register your account, please enter an email and password below</h3>

<br />

<?php echo $results; ?>

<div id="register">
    <form method="post" action="#">    
        <input name="email" type="text" value="" placeholder="Email" class="form-control"/>
        <br />
        <input name="password" type="password" value="" placeholder="Password" class="form-control"/>
        <br />
        <br /> 
        <input type="submit" value="Register" class="btn btn-primary"/>    
    </form>
</div>