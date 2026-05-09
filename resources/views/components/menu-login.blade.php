<div class=' container-fluid d-flex justify-content-center align-items-center ' style='height:100vh'>
    <div class="container-md-6 p-5 rounded-5 shadow-3" style='background-color:#222840'>
        <h2 class="text-center text-primary fs-1">Hai... Welcome Admin</h2>
        <form action="/admin/action/login" method="post">
            @csrf
        <div class="mb-3">
            <label for="" class="form-label text-white">Username</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name='username' class="form-control" placeholder="Username" required='required'>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label text-white">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name='password' class="form-control" placeholder="Password" required='required'>
            </div>
        </div>
        <div class="row my-2 px-3">
            <button type="submit" class='btn btn-primary'style='width:100%'>LOGIN</button>
        </div>
        </form>
    </div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div>