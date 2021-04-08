<?php
require_once './templates/header.php';
require_once './classes/user.php';
$objUser = new User();

if (isset($_SESSION['username'])) {
  $objUser->redirect('./pen_index.php');
}

?>

  <div class="wrapper">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-6 col-md-4 mx-auto form-group">
          <div class="card card-signin my-5">
            <div class="card-body">
              <form action="login.php" method="post">
                <h3 class="card-title text-center">Login เข้าสู่ระบบ</h3>
                <div class="input-group mb-3 mt-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Username:</span>
                  </div>
                  <input class="form-control" type="text" name="username" id="username" minlength="5" autofocus>
                </div>
                <div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Password:</span>
                    </div>
                    <input class="form-control" type="password" name="password" id="password" minlength="5">
                  </div>
                  <div class="d-flex justify-content-center">
                    <input type="submit" name="submit" value="submit" class="btn btn-primary">
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<style>
  .wrapper {
    width: 100vw;
    height: 100vh;
    background: linear-gradient(45deg, #F17C58, #E94584, #24AADB, #27DBB1, #FFDC18, #FF3706);
    background-size: 600% 100%;
    animation: gradient 16s linear infinite;
    animation-direction: alternate;
  }

  @keyframes gradient {
    0% {
      background-position: 0%
    }

    100% {
      background-position: 100%
    }
  }

  .card-signin {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
  }

  .card-signin .card-title {
    margin-bottom: 2rem;
    font-weight: 300;
    font-size: 1.5rem;
  }

  .card-signin .card-body {
    padding: 2rem;
  }
</style>

<?php 
require_once './templates/footer.php';
?>