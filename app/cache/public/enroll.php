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

                    <form method="POST" action="/enroll?id=<?php echo  $data['event_id'] ; ?>">
                        <input type="hidden" name="csrf_token" value="8697e652960f1ad110d36a867f0a3f93" />

                        <?php 
                            if (isset($_SESSION['enrollment-error'])) $error = 1;
                            else $error = 0;
                        ?>
                        <?php if($error): ?>
                            <div class="b-danger m-2">
                                <span class="text-danger">
                                    <?php echo  $_SESSION['enrollment-error'] ; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="my-2">
                            <h2 class="center"> <?php echo  $data['event_name'] ; ?> </h2>
                            <p>ENROLL</p>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Name</label>
                            <input type="text" class="form-control" id="username" aria-describedby="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="numnber" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div id="dynamicFields">
                            <!-- dynamically generated fields here -->

                            <?php foreach($data['enrollment_fields'] as $field): ?>
                                <div class="mb-3">
                                    <label for="<?php echo  $field['id'] ; ?>" class="form-label"> <?php echo  $field['field_name'] ; ?> </label>
                                    <input type="<?php echo  $field['field_type'] ; ?>" class="form-control" id="<?php echo  $field['id'] ; ?>" name="<?php echo  $field['id'] ; ?>" required>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Enroll As</label>
                            <select name="type" id="type" class="form-control" required>
                                <?php foreach($data['enrollment_types'] as $type): ?>
                                    <option value="<?php echo  $type['id'] ; ?>"> <?php echo  $type['enrollment_type'] ; ?> ( FEE: <?php echo  $type['enrollment_charges'] ; ?> <?php echo  $type['enrollment_charges_curr'] ; ?>) </option>
                                <?php endforeach; ?>
                            </select>
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