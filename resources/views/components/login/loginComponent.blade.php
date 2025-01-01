<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="">



    <div class="card w-50 mx-auto m-5">
        <h5 class="card-header">Login Your Account</h5>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="Enter Your Email">
                    <div id="email_error" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter Your Password">
                    <div id="password_error" class="text-danger"></div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Show</label>
                </div>
                <button type="submit" class="btn btn-primary w-50" onclick="onLogin(event)">Login</button>
            </form>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/datatables-simple-demo.js') }}"></script>

    <script>
        async function onLogin(event) {
            event.preventDefault();
            document.getElementById('email_error').innerText = ""
            document.getElementById('password_error').innerText = ""
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let isError = false;


            if (!email) {
                document.getElementById("email_error").innerText = "Email field is required";
                isError = true;
            }

            if (!password) {
                document.getElementById("password_error").innerText = "Password is required";
                isError = true;
            } else if (password.length < 8) {
                document.getElementById("password_error").innerText = "Password length must be 8 characters";
                isError = true;
            }

            if (isError) return;

            let data = {
                email: email,
                password: password
            }

            try {
                let res = await axios.post('/user-login', data)
                if (res.data.status === 'success') {
                    localStorage.setItem('authToken', res.data.token);
                    window.location.href = "/dashboard"; 
                } else {
                    document.getElementById("email_error").innerText = res.data.message;
                    isError = true;
                }
            } catch (error) {
                console.error("error message", error);
            }


        }
    </script>








</body>

</html>
