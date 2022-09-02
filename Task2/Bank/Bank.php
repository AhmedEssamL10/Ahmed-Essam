<?php
if ($_POST) {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];
    if ($num3 <= 3) {
        $result = $num2 + ($num2 * 0.1) * $num3;
    } elseif ($num3 >= 3) {
        $result = $num2 + ($num2 * 0.15) * $num3;
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="contianer">
        <div class="row">
            <div class="col-12 my-5 h1 text-center text-danger"> Bank loan </div>
            <div class="col-5 mt-5 offset-4">
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="num1" id="name" class="form-control" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="Phone">the loan </label>
                        <input type="number" name="num2" id="Phone" class="form-control" aria-describedby="helpId">
                        <div class="form-group">
                            <label for="Phone">number of years </label>
                            <input type="number" name="num3" id="Phone" class="form-control" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-danger btn-sm" type="submit">submet</button>


                        </div>
                        <?php
                        if (isset($result)) {
                            echo "The Customer Name is $num1";
                            echo "<br>";
                            echo "The Customer loan is $num2";
                            echo "<br>";
                            echo "The Customer loan after Benefits $result";
                            echo "<br>";
                            echo "Amount to be paid monthly " . ($result / (12 * $num3));
                        }
                        ?>

                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>