<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
  <a class="navbar-brand" href="#">
    <img class="img logo-img" id="nav-logo" src="/images/logo.png" alt="">
  </a>
  
    <!-- if user is not signed in then show sign in button, else show sign out button -->
    <?php if( !isset($_SESSION['user']) || count($_SESSION['user']) < 1) : ?>
      <div class="form-inline">
          <a href="/sign-in-user" class="btn btn-outline-success m-2 my-sm-0" type="submit">Sign In</a>
      </dvi>
    <?php else: ?>
      <div class="form-inline">
          <a href="/manage-events" class="btn btn-outline-success m-2 my-sm-0">Manage Events</a>
          <a href="/sign-out-user" class="btn btn-outline-danger m-2 my-sm-0">Sign Out</a>
      </dvi>
    <?php endif; ?>
</nav>

<!-- custom style for the header -->
<style>
  #nav-logo{
    width: 60%;
  }
</style>