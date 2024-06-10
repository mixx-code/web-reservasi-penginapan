<div class="form-sign-up">
    <h1 class="title">Sign In</h1>
    <form action="../config/proses/login.php" method="post">
        <input type="text" class="form-input" placeholder="Username" required name="username" maxlength="15">
        <input type="password" class="form-input" placeholder="Password" required name="password" maxlength="12">
        <button type="submit" class="btn-submit">Submit</button>
    </form>
    <p>don't have an account yet, <a href="/src/pages/main_layout.php?page=sign-up">Register Here.</a></p>
</div>