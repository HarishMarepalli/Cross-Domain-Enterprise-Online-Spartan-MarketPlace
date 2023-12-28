<!-- The Modal -->
<div class="modal fade" id="loginModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Login to Your Account</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="includes/loginvalidation.php" method="post">
            <input type="text" class="form-control" name="Username" placeholder="Username"><br/>
            <input type="password" class="form-control" name="Password" placeholder="Password"><br/>
            <div class="loginContainer">
                <input type="submit" name="Login" class="loginSubmitBtn loginmodal-submit" value="Sign in">
            </div>
            <hr/>
        </form>
        <div class="signUpContainer">
            <p class="createAccText">Don't have an account!! Create one</p>
            <div class="signUpBtnContainer">
              <a class="signUpBtn" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign up</a>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="signUpModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create an Account</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action=
          <?php if($page == 'Home') 
            {
              echo 'includes/validateAndAddUser.php';
            }
            else
            {
              echo 'validateAndAddUser.php';
            }
            ?> method="post">
            <input type="text" class="form-control" name="firstName" placeholder="FirstName"><br/>
            <input type="text" class="form-control" name="lastName" placeholder="LastName"><br/>
            <input type="email" class="form-control" name="emailID" placeholder="Email"><br/>
            <textarea class="form-control" rows="5" id="homeAddress" name="homeAddress" placeholder="Home Address"></textarea><br/>
            <input type="tel" class="form-control" id="homePhone" name="homePhone" placeholder="Home Phone => Eg: (xxx)xxx-xxxx"><br/>
            <input type="tel" class="form-control" id="cellPhone" name="cellPhone" placeholder="Cell Phone => Eg: (xxx)xxx-xxxx"><br/>
            <input type="text" class="form-control" name="newUserName" placeholder="Enter a new UserName"><br/>
            <input type="password" class="form-control" name="newPassword" placeholder="Password"><br/>
            <div class="signUpBtnContainer">
                <input type="submit" name="Signup" class="signUpBtn signUpmodal-submit" value="Sign up">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>