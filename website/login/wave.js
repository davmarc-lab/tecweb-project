"use strict";

function main() {
    // Get A WebGL context
    /** @type {HTMLCanvasElement} */
    var canvas = document.getElementById("square");
    var canvasParent = canvas.parentElement;

    canvas.width = canvasParent.clientWidth;
    canvas.height = canvasParent.clientHeight;

    console.log(canvas.width + ", " + canvas.height);

    var gl = canvas.getContext("webgl");

    if (!gl) {
        return;
    }

    // setup GLSL program
    var program = webglUtils.createProgramFromScripts(gl, ["vertex-shader", "fragment-shader"]);

    // look up where the vertex data needs to go.
    var positionLocation = gl.getAttribLocation(program, "a_position");

    // lookup uniforms
    var matrixLocation = gl.getUniformLocation(program, "u_matrix");

    // Create a buffer for the positions.
    var positionBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, positionBuffer);
    // Set Geometry.
    setGeometry(gl, gl.canvas.clientWidth, gl.canvas.clientHeight);


    var translation = [gl.canvas.clientWidth / 2, 0];
    var angleInRadians = 0;
    var scale = [1, 1];

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
        var size = 2;          // 2 components per iteration
        var type = gl.FLOAT;   // the data is 32bit floats
        var normalize = false; // don't normalize the data
        var stride = 0;        // 0 = move forward size * sizeof(type) each iteration to get the next position
        var offset = 0;        // start at the beginning of the buffer
        gl.vertexAttribPointer(
            positionLocation, size, type, normalize, stride, offset);

        // Compute the matrix
        var matrix = m3.projection(gl.canvas.clientWidth, gl.canvas.clientHeight);
        matrix = m3.translate(matrix, translation[0], translation[1]);
        matrix = m3.rotate(matrix, angleInRadians);
        matrix = m3.scale(matrix, scale[0], scale[1]);

        // Set the matrix.
        gl.uniformMatrix3fv(matrixLocation, false, matrix);

        // Draw the geometry.
        var primitiveType = gl.TRIANGLES;
        var offset = 0;
        var count = 6;

        gl.drawArrays(primitiveType, offset, count);

        loop(timeStamp);
        canvas.width = canvasParent.clientWidth;
        canvas.height = canvasParent.clientHeight;
        requestAnimationFrame(drawScene);
    }

    function loop(timeStamp) {
        let timeLoc = gl.getUniformLocation(program, "a_time");
        gl.uniform1f(timeLoc, timeStamp * 0.0004);

        let dimLoc = gl.getUniformLocation(program, "blockDim");
        console.log(canvas.clientWidth + ", " + canvas.clientHeight);
        gl.uniform2fv(dimLoc, new Float32Array([canvas.clientWidth, canvas.clientHeight]));
    }
}


// Fill the buffer with the values that define a rectangle.
// Note, will put the values in whatever buffer is currently
// bound to the ARRAY_BUFFER bind point
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
