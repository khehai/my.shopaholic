<section>
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-9 mx-auto">
        <h1 class="hero-heading">Register</h1>
        <p class="text-muted mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <h2 class="h4 mb-4">Personal information</h2>
        <form class="mb-5" action="/signup" method="POST">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">First name</label>
              <input class="form-control" type="text" name="first_name" placeholder="Enter your first name">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Last name</label>
              <input class="form-control" type="text" name="last_name" placeholder="Enter your last name">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Email address</label>
              <input class="form-control" type="email" name="email" placeholder="Enter your email address">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Telephone</label>
              <input class="form-control" type="tel" name="phone_number" placeholder="Enter your phone number">
            </div>
          </div>
        
              
        <h2 class="h4 mb-4">Your password</h2>
        
        <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Password</label>
              <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Confirm password</label>
              <input class="form-control" type="password" placeholder="Confirm password" name="confirmpassword">
            </div>
            <div class="col-12 mb-3">
              <div class="form-check">
                <input class="form-check-input" id="flexCheckDefault" type="checkbox">
                <label class="form-check-label text-muted" for="flexCheckDefault">I have read and accept policy privacy</label>
              </div>
            </div>
            <div class="col-12">
              <button class="btn btn-primary" type="submit">Create your account</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>