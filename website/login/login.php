<?php
session_start();
if (!isset($_SESSION['oldValueLogin'])) {
    $_SESSION['oldValueLogin'] = [
        "username" => "",
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../includes/style.css" />
    <script src="login_script/changinTextScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="login_script/popupErrorLoginScript.js"></script>
    <script src="login_script/reloadPageScript.js"></script>
    <script src="login_script/showHidePassword.js"></script>
    <title>Log in</title>
</head>

<body class="login-body">
    <section>
        <div class="container-fluid vh-100">
            <div class="row">
                <div class="col-md-3 d-none d-lg-block d-flex align-items-center justify-content-center vh-100 side-panel">
                    <p id="changing-text"></p>
                </div>
                <div class="col-12 col-md-8 d-flex align-items-center justify-content-center my-5 mx-auto">
                    <!-- login form -->
                    <form action="login_php/loginQuery.php" method="post">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h1>Already have an account?</h1>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="login-email" class="col-form-label" hidden>Email</label>
                            <div class="col-md-12">
                                <input type="text" id="login-email" name="email" placeholder="Email or username" class="form-control" value="<?php echo empty($_SESSION['oldValueLogin']['username']) ? "" : htmlspecialchars($_SESSION['oldValueLogin']['username']) ?>" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="login-password" class="col-form-label" hidden>Password</label>
                            <div class="col-md-12">
                                <input type="password" id="login-password" name="password" placeholder="Password" class="form-control" required/>
                                <label for="show-password" class="mb-5">
                                    <input type="checkbox" id="show-password" class="mb-5" />
                                    Show Password
                                </label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mb-3" id="bttLogin">Log in</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="fixed-bottom waves">
            <canvas id="square"></canvas>

            <script id="vertex-shader" type="x-shader/x-vertex">
                precision mediump float;
                attribute vec2 a_position;
    
                uniform mat3 u_matrix;
                uniform vec2 blockDim;
                
                varying vec4 v_color;
                
                void main() {
                    // Multiply the position by the matrix.
                    vec3 position = vec3((u_matrix * vec3(a_position, 1)).xy, 0);

                    gl_Position = vec4(position, 1);
                    
                    v_color = vec4(0.5058823529411764, 0.7411764705882353, 0.8745098039215686, 1);
                }
            </script>

            <script id="fragment-shader" type="x-shader/x-fragment">
                precision mediump float;

                uniform vec2 blockDim;
                uniform float a_time;

                varying vec4 v_color;

                #define PI 3.14

                void main() {
                    vec3 color = vec3(v_color.rgb);
    
                    vec3 bgColorDown = vec3(1, 1, 1);
                    vec3 bgColorUp = vec3(color);
    
                    vec3 P1ColorIn = vec3(color);
                    vec3 P1ColorOut = vec3(color);
    
                    vec3 P2ColorIn = vec3(color);
                    vec3 P2ColorOut = vec3(color);

                    vec2 uv = gl_FragCoord.xy / blockDim.xy;

                    float curve = 0.3 * sin(a_time) * sin((9.25 * uv.x) + (2.0 * a_time));

                    float lineAShape = smoothstep(1.0 - clamp(distance(curve + uv.y, 0.5) * 1.0, 0.0, 1.0), 1.0, 0.99);

                    vec3 bgColor = mix(bgColorDown, bgColorUp, step(uv.y, -curve + 0.5));
                    vec3 lineACol = mix(mix(P1ColorIn, P1ColorOut, lineAShape), P2ColorOut, lineAShape);

                    gl_FragColor = vec4(mix(bgColor, lineACol, 1.0 - lineAShape), 1.0);
                }

            </script>

            <script src="https://webgl2fundamentals.org/webgl/resources/webgl-utils.js"></script>
            <script src="https://webglfundamentals.org/webgl/resources/m3.js"></script>
            <script src="wave.js"></script>
        </div>
    </section>
</body>

</html>