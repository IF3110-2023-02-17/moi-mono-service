<form action= "login" class="login">
    <h1 class="auth-title">
        Masuk untuk Akses Full Fitur!
    </h1>
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-input" id="username" name="username" type="text" placeholder="Username" />
        <i>
            <p id="username-warn" class="hide alert-text">Isi dulu username-nya woy</p>
        </i>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-input" id="password" name="password" type="password" placeholder="Password"/>
        <i>
            <p id="password-warn" class="hide alert-text">Isi dulu password-nya woy</p>
        </i>
    </div>
    <i>
        <p id="login-warn" class="hide alert-text">Kyknya Username/Password ada yg salah</p>
    </i>
    <button class="btn btn-primary" type="submit">Masuk</button>
</form>

<div class="register-btn">
    <a href="/user/register" class="btn alt-btn">Register</a>
</div>
