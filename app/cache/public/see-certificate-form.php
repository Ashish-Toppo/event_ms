<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADBU | Events</title>
    <link rel="shortcut icon" href="./favicon.ico"  type="image/x-icon">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- include the componenet: header -->
    <?php include ('../app/views/' . '/components/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-12 p-2">
                <!-- include the component: sidebar -->
                <?php include ('../app/views/' . '/components/sidebar.php'); ?>
            </div>

            <!-- home main container starts here -->
            <main class="col-md-9 col-sm-12">
                <div class="row d-flex flex-column p-3">

                    <form method="get" action="/certificate">
                        
                        <div class="my-2">
                            <h2 class="center"> View Certificate </h2>
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="id" class="form-label">Certificate No. </label>
                            <input type="text" class="form-control" id="id" aria-describedby="id" name="id" required>
                        </div>
                        

                        
                        

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </main>
        </div>
        <!-- home main container ends here -->
    </div>
</body>
</html>