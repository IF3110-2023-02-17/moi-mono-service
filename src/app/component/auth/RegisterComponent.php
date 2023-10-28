<form action = "register" class="register">
    <h1 class="auth-title">
        Silahkan Daftarkan Dirimu!
    </h1>
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-input" id="email" name="email" type="email" placeholder="Email" />
        <i>
            <p id="email-warn" class="hide alert-text">Isi dulu username-nya woy</p>
        </i>
    </div>
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
            <p id="password-warn" class="hide alert-text">Isi dulu username-nya woy</p>
        </i>
    </div>
    <i>
        <p id="register-warn" class="hide alert-text">Isi dulu username-nya woy</p>
    </i>
    <button type="submit" class="btn btn-primary">Daftar</button>
</form>