<?php

$review = [

    "هل انت راضي علي الهدوء بالمستشفي",
    "هل انت راضي علي مستوي الدكاترة",
    "هل انت راضي عن خدمة التمريض",
    "هل انت راضي علي اسعار الخدمات",
    "هل انت راضي عن مستوى النظافة"


];
$questions = [
    "السؤال" => "",
    "سىء" => 0,
    "جيد" => 3,
    "جيد جدا" => 5,
    "ممتاز" => 10

];

if ($_POST) {
    # code...

    $_POST["first"] = 0;
    $_POST["sec"] = 1;
    $_POST["third"] = 5;
    $_POST["fourth"] = 10;
    $result = 0;
    if ($_POST["first"]) {
        $result = $result + $_POST["first"];
    } elseif ($_POST["sec"]) {
        $result = $result + $_POST["sec"];
    } elseif ($_POST["third"]) {
        $result = $result + $_POST["third"];
    } elseif ($_POST["fourth"]) {
        $result = $result +  $_POST["fourth"];
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

    <form method="POST" action="Result.php">
        <table class="table">
            <thead>

                <tr>
                    <?php

                    foreach ($questions as $item => $i) {
                    ?>
                        <th scope="col">

                            <?php
                            echo $item;
                            echo "<br>";
                            echo $i;
                            ?>
                        </th>

                    <?php
                    }
                    ?>
                </tr>

            </thead>
            <tbody>
                <th scope="row">
                    <tr>
                        <?php
                        foreach ($review as $rev => $r) {
                            // 
                        ?>
                            <td>
                                <?php

                                echo "<br>";
                                echo $r;
                                ?>
                            </td>
                            <?php
                            ?>
                            <?php

                            // for ($i = 0; $i < 4; $i++) {
                            # code...

                            ?>
                            <td>

                                <input type="radio" id="html" name="first" value="HTML">

                            </td>
                            <td>

                                <input type="radio" id="html" name="sec" value="HTML">

                            </td>
                            <td>

                                <input type="radio" id="html" name="third" value="HTML">

                            </td>
                            <td>

                                <input type="radio" id="html" name="fourth" value="HTML">

                            </td>



                    </tr>
                </th>

            <?php
                            //     echo "<br>";
                        }
                        if (isset($result)) {
                            echo $result;
                        }
            ?>




            </tbody>
        </table>
        <div class="form-group">
            <button class="btn btn-outline-danger btn-sm" type="submit">submet</button>


        </div>

    </form>
</body>

</html>