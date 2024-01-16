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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Playfair+Display&family=Satisfy&display=swap" rel="stylesheet">
    <script src="login_script/changinTextScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="login_script/popupErrorLoginScript.js"></script>
    <script src="login_script/reloadPageScript.js"></script>
    <script src="login_script/showHidePassword.js"></script>
    <title>Log in</title>
</head>

<body>
    <section>
        <div class="container-fluid" style="height: 100vh;">
            <div class="row">
                <div class="col-md-3 d-none d-lg-block d-xl-block d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #81BDDF; padding-top: 40vh;">
                    <p style="font-family: 'Bebas Neue', sans-serif; font-size: 40px; text-align: center;" id="changingText"></p>
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
                            <label for="loginEmail" class="col-form-label" hidden>Email</label>
                            <div class="col-md-12">
                                <input type="text" id="loginEmail" name="email" placeholder="Email or username" class="form-control" value="<?php echo empty($_SESSION['oldValueLogin']['username']) ? "" : htmlspecialchars($_SESSION['oldValueLogin']['username']) ?>" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="login-password" class="col-form-label" hidden>Password</label>
                            <div class="col-md-12">
                                <input type="password" id="login-password" name="password" placeholder="Password" class="form-control" />
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
        <div class="fixed-bottom" style="width: 100%; height: 20%; z-index: -1;">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#81BDDF" fill-opacity="1" d="M0,256L48,256C96,256,192,256,288,229.3C384,203,480,149,576,149.3C672,149,768,203,864,218.7C960,235,1056,213,1152,192C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg> -->
            <!-- missing script on resize -->
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