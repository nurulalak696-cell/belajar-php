<?php
// code
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container-xxl">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-primary mb-4">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Navbar</a>

                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Link</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown">
                                Dropdown
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link disabled text-white">Disabled</a>
                        </li>

                    </ul>

                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </div>
        </nav>

        <div class="container">
            <form>
                <div class="mb-3">
                    <label for="inputProductName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="inputProductName" aria-describedby="productnamehelp">
                    <div id="productnamehelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="inputProductPrice" class="form-label">Product Price</label>
                    <input type="text" class="form-control" id="inputProductPrice" aria-describedby="productpricehelp">
                    <div id="productpricehelp" class="form-text">We'll never share your email with anyone else.</div>
                </div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Input Group -->
        <div class="input-group mb-3">
            <span class="input-group-text">@</span>
            <input type="text" class="form-control" placeholder="Username">
        </div>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Recipient's username">
            <span class="input-group-text">@example.com</span>
        </div>

        <div class="mb-3">
            <label for="basic-url" class="form-label">Your vanity URL</label>
            <div class="input-group">
                <span class="input-group-text">https://example.com/users/</span>
                <input type="text" class="form-control" id="basic-url">
            </div>
            <div class="form-text">
                Example help text goes outside the input group.
            </div>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control">
            <span class="input-group-text">.00</span>
        </div>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username">
            <span class="input-group-text">@</span>
            <input type="text" class="form-control" placeholder="Server">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">With textarea</span>
            <textarea class="form-control"></textarea>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>