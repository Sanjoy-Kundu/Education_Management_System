<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="">
    <div class="card w-50 mx-auto m-5">
        <h5 class="card-header">Register Your Account</h5>
        <div class="card-body">
            <div id="any_error" class="text-danger"></div>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" class="form-control" id="name" name="name" placeholder="Enter Your Name">
                    <div id="name_error" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email">
                    <div id="email_error" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                    <div id="password_error" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Your Confirm Password">
                    <div id="password_confirmation_error" class="text-danger"></div>
                </div>
                <button type="submit" class="btn btn-primary w-50" onclick="onRegister(event)">Registration</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/datatables-simple-demo.js') }}"></script>

    <script>
        async function onRegister(event) {
            event.preventDefault();
            document.getElementById('name_error').innerText = ""
            document.getElementById('email_error').innerText = ""
            document.getElementById('password_error').innerText = ""
            document.getElementById('password_confirmation_error').innerText = ""
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let password_confirmation = document.getElementById('password_confirmation').value;
            let isError = false;

            if (!name) {
                document.getElementById("name_error").innerText = "Name field is required";
                isError = true;
            }

            if (!email) {
                document.getElementById("email_error").innerText = "Email field is required";
                isError = true;
            }

            if (!password) {
                document.getElementById("password_error").innerText = "Password field is required";
                isError = true;
            } else if (password.length < 8) {
                document.getElementById("password_error").innerText = "Password must be at least 8 characters";
                isError = true;
            }

            if (!password_confirmation) {
                document.getElementById("password_confirmation_error").innerText = "Password confirmation field is required";
                isError = true;
            }

            if (password !== password_confirmation) {
                document.getElementById("password_confirmation_error").innerText = "Password and password confirmation must be the same";
                isError = true;
            }

            if (isError) return;

            let data = {
                name: name,
                email: email,
                password: password,
                password_confirmation:password_confirmation
            }

            try {
                let res = await axios.post('/user-registration', data)
                if (res.data.status === 'success') {
                    window.location.href = "/login";
                } else {
                    console.log(res.data);
                }
            } catch (error) {
                console.error("error message", error);
            }
        }
    </script>
</body>

</html>