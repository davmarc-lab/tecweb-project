"use strict";

function main() {
    // Get A WebGL context
    let canvas = document.getElementById("square");
    let canvasParent = canvas.parentElement;

    canvas.width = canvasParent.clientWidth;
    canvas.height = canvasParent.clientHeight;

    let gl = canvas.getContext("webgl");

    if (!gl) {
        return;
    }

    // setup GLSL program
    let program = webglUtils.createProgramFromScripts(gl, ["vertex-shader", "fragment-shader"]);

    // look up where the vertex data needs to go.
    let positionLocation = gl.getAttribLocation(program, "a_position");

    // lookup uniforms
    let matrixLocation = gl.getUniformLocation(program, "u_matrix");

    // Create a buffer for the positions.
    let positionBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, positionBuffer);
    // Set Geometry.
    setGeometry(gl, gl.canvas.clientWidth, gl.canvas.clientHeight);

    // Set square Model.
    let translation = [gl.canvas.clientWidth / 2, 0];
    let angleInRadians = 0;
    let scale = [1, 1];

    // Load new frame.
    requestAnimationFrame(drawScene);

    // Draw the scene.
    function drawScene(timeStamp) {
        webglUtils.resizeCanvasToDisplaySize(gl.canvas);

        // Tell WebGL how to convert from clip space to pixels
        gl.viewport(0, 0, gl.canvas.width, gl.canvas.height);

        // Clear the canvas.
        gl.clear(gl.COLOR_BUFFER_BIT);

        // Tell it to use our program (pair of shaders)
        gl.useProgram(program);

        // Turn on the position attribute
        gl.enableVertexAttribArray(positionLocation);

        // Bind the position buffer.
        gl.bindBuffer(gl.ARRAY_BUFFER, positionBuffer);

        // Tell the position attribute how to get data out of positionBuffer (ARRAY_BUFFER)
        let size = 2;          // 2 components per iteration
        let type = gl.FLOAT;   // the data is 32bit floats
        let normalize = false; // don't normalize the data
        let stride = 0;        // 0 = move forward size * sizeof(type) each iteration to get the next position
        let offset = 0;        // start at the beginning of the buffer
        gl.vertexAttribPointer(
            positionLocation, size, type, normalize, stride, offset);

        // Compute the matrix
        let matrix = m3.projection(gl.canvas.clientWidth, gl.canvas.clientHeight);
        matrix = m3.translate(matrix, translation[0], translation[1]);
        matrix = m3.rotate(matrix, angleInRadians);
        matrix = m3.scale(matrix, scale[0], scale[1]);

        // Set the matrix.
        gl.uniformMatrix3fv(matrixLocation, false, matrix);

        // Draw the geometry.
        let primitiveType = gl.TRIANGLES;
        offset = 0;
        let count = 6;

        gl.drawArrays(primitiveType, offset, count);

        loop(timeStamp);
        canvas.width = canvasParent.clientWidth;
        canvas.height = canvasParent.clientHeight;
        requestAnimationFrame(drawScene);
    }

    // Sends every frame the time to shader.
    function loop(timeStamp) {
        let timeLoc = gl.getUniformLocation(program, "a_time");
        gl.uniform1f(timeLoc, timeStamp * 0.0004);

        let dimLoc = gl.getUniformLocation(program, "blockDim");
        gl.uniform2fv(dimLoc, new Float32Array([canvas.clientWidth, canvas.clientHeight]));
    }
}


// Fill the buffer with the values that define a rectangle.
function setGeometry(gl, b, h) {
    gl.bufferData(
        gl.ARRAY_BUFFER,
        new Float32Array([
            -b / 2, -h,
            b / 2, -h,
            -b / 2, h,
            b / 2, -h,
            -b / 2, h,
            b / 2, h]),
        gl.STATIC_DRAW);
}

main();
