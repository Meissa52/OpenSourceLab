<?php include 'views/header.php';?>
<div class="container" style="margin-top:10%">
    <h3 class="white-text center">Sign In Below</h3>
    <form class="col s12 l12 m12" action="models/login.php" method="POST">
      <div class="row">
      <div class="input-field col s4 offset-s4 l4 offset-l4 m4 offset-m4">
          <input name="email" class="validate" type="email" >
          <label for="email">Email</label>
        </div>
		<div class="row" style="margin-bottom:0px;">
        <div class="input-field col s4 offset-s4 l4 offset-l4 m4 offset-m4">
          <input name="password" class="validate" type="password" >
		   <label for="password">Password</label>
        </div>
      </div>
      <div class="row" style="margin-bottom:0px;">
		<div class="col s12 l12 m12">
            <p class="center">
    <button class="red white-text center btn-large waves-effect waves-light" type="submit" name="action"><span style="font-weight:bold;">Sign in</span>
    </button>
</p>
<p class="center white-text">Don't have an account? <a href="SignUp.php">Signup Here<a></p>
</div>
</div>
</form>
</div>
</div>
<?php include 'views/footer.php';?>