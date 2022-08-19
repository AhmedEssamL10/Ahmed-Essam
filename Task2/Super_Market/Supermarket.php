<!doctype html>
<html lang="en">

<?php
session_start();
if (($_POST)) {

    if (isset($_POST['but1'])) {
        $num1 = $_POST["num1"];
        $num2 = $_POST["gov"];
        $num3 = $_POST["num3"];
        $_SESSION['num3'] = $num3;
        $_SESSION['num1'] = $num1;
        $_SESSION['num2'] = $num2;
    }
    if (isset($_POST['but2'])) {
        $result = 0;
        $delivery = 0;
        if ($_SESSION['num2'] == "Cairo") {
            $delivery = 0;
        } elseif ($_SESSION['num2'] == "Giza") {
            $delivery = 30;
        } elseif ($_SESSION['num2'] == "Alex") {
            $delivery = 50;
        } else {
            $delivery = 100;
        }
        $productname = $_POST["productname"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];

        for ($i = 1; $i <= $_SESSION['num3']; $i++) {

            $result = $result  + ($price * $quantity);
        }
        $result = $result + $delivery;
    }
}
?>

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
            <div class="col-12 my-5 h1 text-center text-danger"> Super Market </div>
            <div class="col-5 mt-5 offset-4">
                <form method="POST">
                    <div class="form-group">
                        <label for="name">Select Your Name </label>
                        <input type="text" name="num1" id="name" class="form-control" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="name">Select Your Government</label>
                        <select name="gov" id="cars">
                            <option value="Cairo">Cairo</option>
                            <option value="Giza">Giza</option>
                            <option value="Alex">Alex</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Phone">number of products </label>
                        <input type="number" name="num3" id="Phone" class="form-control" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <button name="but1" class="btn btn-outline-danger btn-sm" type="submit">submet</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['but1'])) {
                ?>

                    <form method="POST">
                        <table>


                            <?php
                            for ($i = 1; $i <= $num3; $i++) {
                                # code...
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo "$i";
                                        echo "<br>";
                                        ?>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="name">product name</label>
                                            <input type="text" name="productname" id="name" class="form-control" aria-describedby="helpId">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="Phone">price </label>
                                            <?php

                                            echo   "<input type='number' name='price' id='Phone' class='form-control' aria-describedby='helpId'>";
                                            ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="Phone">quantity </label>
                                            <?php

                                            echo   "<input type='number' name='quantity' id='Phone' class='form-control' aria-describedby='helpId'>";
                                            ?>
                                            <!-- <input type="number" name="quantity" id="Phone" class="form-control" aria-describedby="helpId"> -->
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            } ?>

                        </table>

                        <div class="form-group">
                            <button name="but2" class="btn btn-outline-danger btn-sm" type="submit">calc total price</button>


                        </div>
                    </form>

                <?php

                }
                ?>


                <?php


                ?>
                <div class="contianer">
                    <div class="row">
                        <div class="col-5 mt-5 offset-4">
                            <form method="POST">

                            </form>

                            <?php
                            if (isset($result)) {
                                echo "Customer name is " . $_SESSION['num1'];
                                echo "<br>";
                                echo "Customer Government is " . $_SESSION['num2'];
                                echo "<br>";
                                echo "Total price " . $result;
                                echo "<br>";
                                if ($result < 1000) {
                                    echo "Total price After discount" . $result;
                                    echo "<br>";
                                } elseif ($result < 3000 && $result >= 1000) {
                                    echo "Total price After discount " . $result - $result * 0.1;
                                    echo "<br>";
                                } elseif ($result <= 4500 && $result >= 3000) {
                                    echo "Total price After discount " . $result - $result * 0.15;
                                    echo "<br>";
                                } elseif ($result > 4500) {
                                    echo "Total price After discount " . $result - $result * 0.2;
                                    echo "<br>";
                                }
                                echo "product name" . $productname;
                            }
                            ?>



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