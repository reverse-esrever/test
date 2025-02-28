<form action="" method="post" class="w-25 m-2">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
    <div class="text-danger"><?php  echo $_SESSION['nameError'] ?? '' ?></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    <div class="text-danger"><?php  echo $_SESSION['emailError'] ?? '' ?></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">Password confirmation:</label>
    <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmed">
  </div>
  <div class="text-danger"><?php  echo $_SESSION['passwordError'] ?? '' ?></div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>