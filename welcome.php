<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html lang="en">
<div id="logreg-forms">
    <form class="form-signin" action="check.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Welcome </h1>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="email address" required="" autofocus="" value="">
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="password" required="" autofocus="" value="">
        <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Login </button>
        <hr>
    </form>
    
    <form action="register.php"method="post">
        <p style="text-align:center">Create a new account</p>
        <input type="text" name="nname" id="user-name" class="form-control" placeholder="opg" required="" autofocus="">
        <input type="email" name="email" id="user-name" class="form-control" placeholder="email address" required="" autofocus="">
        <input type="password" name="password" id="user-name" class="form-control" placeholder="password" required="" autofocus="">
        <input type="number" name="contactphone" id="user-email" class="form-control" placeholder="phone number" required autofocus="">
        <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Register </button>
    </form>
    <br>
    <p>
    admin@email.com - admin <br>
    opg1@email.com - opg1 <br>
    opg2@email.com - opg2 <br>
    itd... <br>
    </p>
</div>
