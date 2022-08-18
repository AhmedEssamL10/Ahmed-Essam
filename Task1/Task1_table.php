<?php
// dynamic table
// dynamic rows //4 
// dynamic columns // 4
// check if gender of user == m ==> male // 1
// check if gender of user == f ==> female // 1

$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
        'phones' => [012312312, 1231513513, 89746543],
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'phones' => [1231513513, 89746543],
    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'phones' => [],
    ],
];

$counter = 0;
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


    <table class="table">
        <thead>

            <tr>
                <?php
                foreach ($users[0] as $key => $user) {
                ?>
                    <th scope="col">

                        <?php
                        echo $key;
                        ?>



                    </th>
                <?php
                }
                ?>
            </tr>

        </thead>
        <tbody>

            <?php
            foreach ($users as $key => $user) { ?>
                <th scope="row">
                    <tr>
                        <?php
                        foreach ($user as $I => $item) { ?>
                            <td>
                            <?php
                            if (gettype($item) == "array" || gettype($item) == "object") {
                                foreach ($item as $k => $v) {
                                    echo $v . "<br>";
                                }
                            } else {
                                echo $item;
                            }
                        }
                            ?>
                            </td>



                </th>
                </tr>
            <?php
                echo "<br>";
            } ?>
            <!-- <td>Mark</td>
               >Otto</td>
                <td>@mdo> -->

        </tbody>
    </table>




</body>

</html>