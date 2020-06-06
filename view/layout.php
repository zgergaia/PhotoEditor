<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PhotoEditor</title>

    <link rel="shortcut icon" href="/Resources/icon-1x.png">
    <link rel="shortcut icon" href="/Resources/icon-2x.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="view/style.css">
    <link href="../cropperjs-master/dist/cropper.css" rel="stylesheet">

    <script src="../cropperjs-master/dist/cropper.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://kit.fontawesome.com/80d2a08adf.js" crossorigin="anonymous"></script>
</head>
<body class="m-2">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item mr-2">
                <i class="fas fa-images fa-2x"></i>
            </li>
            <li class="nav-item active mx-1">
                <a class="btn btn-outline-primary" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active mx-1">
                <a class="btn btn-outline-primary" href="/About">About <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active mx-1">
                <a class="btn btn-outline-danger" href="/Demo">Demo <span class="sr-only">(current)</span></a>
            </li>
            </ul>
        </div>
    </nav>
    <h1 class="display-4 m-2">Simple Photo Editor</h1>
    <?php echo $content ?>
    <script src="view/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>