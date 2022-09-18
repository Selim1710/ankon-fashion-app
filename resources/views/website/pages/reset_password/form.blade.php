<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>User Registration Form</title>
</head>

<body>
    <div class="container"><br><br>
        <div class="registration_form">
            <div class="form-header">
                <h4> Reset Password </h4>
            </div><br>
            <!-- Validation Error Message -->
            <div class="message">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <form action="{{ route('user.reset.password',$user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="oldp"> Old Password </label>
                    <input type="text" name="old_password" placeholder="enter old password" class="form-control" id="oldp" required>
                </div> <br>
                <div class="row">
                    <div class="col-6">
                        <label for="newp"> New Password</label>
                        <input type="text" name="password"  placeholder="enter password" class="form-control" id="newp" required>
                    </div>
                    <div class="col-6">
                        <label for="confirmp"> Confirm Password </label>
                        <input type="text" name="password_confirmation" placeholder="Re-enter password" class="form-control" id="confirmp" required>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger text-uppercase mt-4"> reset now &rarr;</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>