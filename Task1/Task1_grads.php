<?php
if ($_POST) {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];
    $num4 = $_POST["num4"];
    $num5 = $_POST["num5"];
    $grade = "";
    $result = (($num1 + $num2 + $num3 + $num4 + $num5) / 500) * 100;
    if ($result >= 90 && $result <= 100) {
        $grade =  "grade A";
    } elseif ($result >= 90 && $result <= 100) {
        $grade = "grade A";
    } elseif ($result >= 80 && $result < 90) {
        $grade = "grade B";
    } elseif ($result >= 70 && $result < 80) {
        $grade = "grade C";
    } elseif ($result >= 60 && $result < 70) {
        $grade = "grade D";
    } elseif ($result >= 40 && $result < 60) {
        $grade = "grade E";
    } elseif ($result < 40) {
        $grade = "grade F";
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
            <div class="col-12 my-5 h1 text-center text-danger"> Grades </div>
            <div class="col-5 mt-5 offset-4">
                <form method="POST">
                    <div class="form-group">
                        <label for="num1">Physics</label>
                        <input type="number" name="num1" id="num1" class="form-control" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="num2">Computer</label>
                        <input type="number" name="num2" id="num2" class="form-control" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="num3">Mathmatics</label>
                        <input type="number" name="num3" id="num3" class="form-control" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="num4">Biology</label>
                        <input type="number" name="num4" id="num4" class="form-control" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="num5">Chemistry</label>
                        <input type="number" name="num5" id="num5" class="form-control" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-danger btn-sm" type="submit">submet</button>


                    </div>
                    <?php
                    if (isset($result)) {
                        echo $result;
                        echo "<br>";
                    }
                    if (isset($grade)) {
                        echo $grade;
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