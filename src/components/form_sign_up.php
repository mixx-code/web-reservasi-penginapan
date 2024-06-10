<div class="form-sign-up">
    <h1 class="title">Sign Up</h1>
    <form action="../config/proses/register.php" method="post">
        <input type="text" class="form-input" placeholder="Full Name" required name="fullname" maxlength="100">
        <input type="text" class="form-input" placeholder="Username" required name="username" maxlength="15">
        <input type="password" class="form-input" placeholder="Password" required name="password" maxlength="12">
        <input type="email" class="form-input" placeholder="Email" required name="email" maxlength="100">
        <input type="tel" class="form-input" placeholder="Phone" required name="phone" maxlength="15">
        <button type="submit" class="btn-submit">Submit</button>
    </form>
    <p class="sign-navigasi">Already have an account? <a href="/src/pages/main_layout.php?page=sign-in">Sign In Here.</a></p>
</div>