<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <title>Document</title>
</head>
<body>
    <main class="p-4">
        <section>
            <form>
                <div class="mb-2">
                    <input type="text" id="inputName" class="form-control" placeholder="Name" />
                </div>
                <div class="mb-2">
                    <input type="text" id="inputSurname" class="form-control" placeholder="Surname" />
                </div>
                <div class="mb-2">
                    <input type="text" id="inputCity" class="form-control" placeholder="City" />
                </div>
                <div class="mb-2">
                    <input type="date" id="inputDate" class="form-control" placeholder="Birth date" />
                </div>
                <div class="mb-2">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email" />
                </div>
                <div class="mb-2">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" />
                </div>
                <div class="mb-2">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Repeat password" />
                </div>
                <div class="mb-2">
                    <textarea id="inputDescription" class="form-control" rows="4" placeholder="Description *"></textarea>
                </div>
                <div class="d-flex">
                    <button type="reset" class="btn btn-outline-danger ms-auto m-2">Cancel</button>
                    <button type="submit" class="btn btn-outline-success m-2">Save</button>
                </div>
            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>