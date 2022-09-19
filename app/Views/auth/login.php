<div class="container py-5">
  <div class="row">
    <div class="col-lg-9 mx-auto">
      <h1 class="hero-heading">Login</h1>
      <p class="text-muted mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2 class="h4 mb-4">Returning user</h2>
      <form class="mb-5" action="/signin" method="POST">
        <div class="row">
          <div class="col-lg-6 mb-3">
            <label class="form-label">Email address</label>
            <input class="form-control" type="email" placeholder="Email address" name="email">
          </div>
          <div class="col-lg-6 mb-3">
            <label class="form-label">Password:</label>
            <div class="input-group mb-3">
              
              <input class="form-control" type="password" placeholder="Password" name="password" id="password">
              <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true" id="togglePassword"></i></span>
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="form-check">
              <input class="form-check-input" id="flexCheckDefault" type="checkbox">
              <label class="form-check-label text-muted" for="flexCheckDefault">Remember me for next time</label>
            </div>
          </div>
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Login</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-5 ms-auto">
      <h2 class="h4 mb-4">New customer</h2>
      <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><a class="btn btn-primary" href="/register">Create an account</a>
    </div>
  </div>
</div>
<script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");
        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the icon
            this.classList.toggle("fa-eye-slash");
        });
</script>