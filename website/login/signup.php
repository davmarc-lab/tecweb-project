<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Log in</title>
    <script src="login_script/changinTextScript.js"></script>
</head>

<body>
    <section>

        <div class="container-fluid" style="height: 100vh;">
            <div class="row">
                <div class="col-md-3 d-flex align-items-center justify-content-center"
                    style="height: 100vh; background-color: #81BDDF;">
                    <p class="text-center" id="changingText"
                        style="font-family: 'Kaisei Tokumin', sans-serif; font-size: 35px;"></p>
                </div>
                <div class="col-md-8 d-flex align-items-center justify-content-center">
                    <!-- signup form -->
                    <form action="login_php/signupQuery.php" method="post" id="signupForm">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h1>Inserisci i tuoi dati</h1>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="signupName" class="col-form-label" hidden>Name</label>
                            <div class="col-md-12">
                                <input type="text" id="signupName" name="name" placeholder="Name" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="signupSurname" class="col-form-label" hidden>Surname</label>
                            <div class="col-md-12">
                                <input type="text" id="signupSurname" name="surname" placeholder="Surname" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="signupEmail" class="col-form-label" hidden>Email</label>
                            <div class="col-md-12">
                                <input type="email" id="signupEmail" name="email" placeholder="Email" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="signupUsername" class="col-form-label" hidden>Username</label>
                            <div class="col-md-12">
                                <input type="text" id="signupUsername" name="username" placeholder="Username" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="signupPassword" class="col-form-label" hidden>Password</label>
                            <div class="col-md-12">
                                <input type="password" id="signupPassword" name="password" placeholder="Password"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="signupPasswordRepeat" class="col-form-label" hidden>Password again</label>
                            <div class="col-md-12">
                                <input type="password" id="signupPasswordRepeat" name="passwordRepeat" placeholder="Repeat Password"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mb-3" value="Post">Sign up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="position: absolute; bottom: 0; width: 100%; z-index: -1;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#81BDDF" fill-opacity="1"
                    d="M0,256L48,256C96,256,192,256,288,229.3C384,203,480,149,576,149.3C672,149,768,203,864,218.7C960,235,1056,213,1152,192C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </section>
</body>

</html>