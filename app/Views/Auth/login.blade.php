<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h2 class="text-center mb-4">Đăng nhập</h2>
    <form action="" method="POST">
        @isset($errors)
             <div class="alert alert-danger mb-3">
                {{$errors['message']}}
             </div>
        @endisset
      <div class="mb-3">
        <label for="username" class="form-label">Tên đăng nhập</label>
        <input type="text" id="username" name="username" class="form-control" value="{{ $data['username'] ?? ''}}" placeholder="Nhập tên đăng nhập" >
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" >
      </div>
      <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
    </form>

    <div class="text-center mt-3">
      <a href="{{APP_URL . 'register'}}" class="btn btn-outline-secondary">Đăng ký</a>
    </div>
    <div class="text-center mt-3">
      <a href="{{APP_URL . 'forgot-password'}}" class="btn btn-outline-secondary">Quên mật khẩu</a>
    </div>
  </div>

</body>
</html>
