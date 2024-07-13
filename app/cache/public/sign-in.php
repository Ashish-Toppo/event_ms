<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="View various events going on in Assam Don Bosco University">
    <meta name="keyword" content="ADBU, assam, don, bosco, university, event, portal">
    <title>ADBU EVENTS PORTAL</title>
    
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css" />

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  </head>
  <body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
              <div class="card col-md-7 p-4 mb-0">
                <form class="card-body" method="post" action="/sign-in-user">
                  <h1 class="mb-2">ADBU Events Portal</h1>
                  <p class="text-medium-emphasis">Sign In to as user</p>

                  <?php if ( isset( $_SESSION['sign-in-error'] ) ) : ?>
                      <p class="alert alert-danger" role="alert"> <?php echo  $_SESSION['sign-in-error'] ; ?> </p>
                  <?php endif; ?>

                  <input type="hidden" name="csrf_token" value="8697e652960f1ad110d36a867f0a3f93" />

                  <div class="input-group mb-3"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg></span>
                    <input class="form-control" type="text" placeholder="Username" name="username">
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                      </svg></span>
                    <input class="form-control" type="password" placeholder="Password" name="password">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit">Sign In</button>
                    </div>
                    <!-- <div class="col-6 text-end">
                      <button class="btn btn-link px-0" type="button">Forgot password?</button>
                    </div> -->
                  </div>
                </form>
              </div>
              <div class="card col-md-5 text-white bg-primary py-5">
                <div class="card-body text-center">
                  <div>
                    <!-- <h2>ADBU</h2>
                    <p>Welcome to Events Portal of Assam Don Bosco University!</p> -->

                    <img src="default_items/university_logo/logo.png" alt="" class="img-logo-png">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <script>
    </script>

  </body>
</html>