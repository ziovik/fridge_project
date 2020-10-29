<?php
include_once("config/db.php");

session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>window.open('index.php', '_self')</script>";
} else {


    ?>
    <!DOCTYPE html>

    <html lang="rus">

    <head>
        <title>Fridges</title>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        <link href="layout/styles/modal.css" rel="stylesheet" type="text/css" media="all">
        <script
                src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                crossorigin="anonymous"></script>
        <link href="css/main.css" rel="stylesheet">

    </head>
    <body id="top">

    <div class="wrapper row3">
        <main class="hoc container clear">
            <p>Пользователь:

                <?php
                if (isset($_GET['login'])) {
                    $login = $_GET['login'];
                    $query = "SELECT name,login as login FROM tbl_users WHERE login = '$login'";
                    $stmt = mysqli_query($con, $query);
                    $count = mysqli_num_rows($stmt);


                    if ($count >= 1) {
                        while ($row = mysqli_fetch_assoc($stmt)) {
                            echo $name = $row['name'];


                        }
                    }
                }
                ?>
            </p>
            <a href="index.php" class="btn" id="btn_ingresar">Back</a>
            <a href="?userId" class="btn" id="btn_ingresar" style="float: right;">Logout</a>
            <?php
            if (isset($_GET['userId'])) {

                $_SESSION = array();

                if (ini_get("session.use_cookies")) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                    );
                }

                session_destroy();
                echo "<script>window.open('index.php','_self')</script>";
            }
            ?>
            <section>
                <div class="sectiontitle">
                    <h6 class="heading">Плиточник "Убой"</h6>
                    <?php
                    date_default_timezone_set('Europe/Moscow');
                    $dt = date('Y-m-d H:i:s');
                    $date = substr($dt, 0, -9);
                    $time = substr($dt, -8);
                    echo '<p>date:' . $date . '</p>';
                    echo '<p>Time:' . $time . '</p>';
                    //       echo  $dt2 = date('Y-m-d H:i:s',strtotime('+2 hour +30 minutes',strtotime($dt)));

                    ?>
                </div>
                <input type="text" id="proccess" name="process"
                       style="font-size: 28px; font-weight: bold; color: green;border: none;">
                <!--  <?php if ($status == 1) { ?>  disabled <?php } ?> -->
                <div id="gallery">
                    <figure>

                        <?php
                        if (isset($_GET['deptId'])) {
                            $deptId = $_GET['deptId'];

                            $query = "SELECT * FROM tbl_department_fridges where dept_id = '$deptId' ";
                            $run = mysqli_query($con, $query);

                            $count = mysqli_num_rows($run);
                            if ($count >= 1) {
                                while ($row_fridge = mysqli_fetch_array($run)) {
                                    $fridgeId = $row_fridge['id'];

                                    ?>
                                    <ul class="nospace clear">
                                        <li class="one_quarter first folder">
                                            <a>
                                                <img src="images/demo/fridge.png" alt="">
                                            </a>
                                            <div class="centered"><?= $row_fridge['name'] ?></div>
                                        </li>
                                        <li class="three_quarter">

                                            <table border="1">
                                                <tr>
                                                    <td>
                                                        <div class="modal-body">
                                                            <div class="input-group">
                                                                <h3 style="text-align: center">
                                                                    Заморозка</h3>
                                                                <div class="one_third first">
                                                                    <input
                                                                            id="begin-time1<?=
                                                                            $fridgeId ?>"
                                                                            type="text"
                                                                            class="form-control"
                                                                            readonly/>
                                                                </div>
                                                                <div class="one_third"
                                                                     style="text-align: center;">
                                                                    <button
                                                                            id="left<?= $fridgeId
                                                                            ?>-btn"
                                                                            data-fridge-id="<?= $fridgeId ?>"
                                                                            class="btn left-btn"
                                                                            type="button">+
                                                                    </button>

                                                                </div>
                                                                <div class="one_third">
                                                                    <input
                                                                            id="end-time1<?=
                                                                            $fridgeId ?>"
                                                                            type="text"
                                                                            class="form-control"
                                                                            readonly/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="modal-body">
                                                            <div class="input-group">
                                                                <h3 style="text-align: center">
                                                                    Разморозка</h3>
                                                                <div class=" one_third first">
                                                                    <input
                                                                            id="begin-time2<?=
                                                                            $fridgeId ?>"
                                                                            type="text"
                                                                            class="form-control"
                                                                            readonly/>
                                                                </div>
                                                                <div class=" one_third"
                                                                     style="text-align: center; ">
                                                                    <button
                                                                            id="right<?= $fridgeId
                                                                            ?>-btn"
                                                                            data-fridge-id="<?= $fridgeId ?>"
                                                                            class="btn right-btn "
                                                                            type="button">+
                                                                    </button>
                                                                </div>
                                                                <div class=" one_third">
                                                                    <input
                                                                            id="end-time2<?=
                                                                            $fridgeId ?>"
                                                                            type="text"
                                                                            class="form-control"
                                                                            readonly/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <table>
                                                            <?php
                                                            $query1 = "SELECT * FROM fridge_power where fridge_id = '$fridgeId' and status = 1 ";
                                                            $run1 = mysqli_query($con, $query1);
                                                            $count1 = mysqli_num_rows($run1);
                                                            $i = 0;
                                                            if ($count1 >= 1) {
                                                                while ($row = mysqli_fetch_array
                                                                ($run1)) {
                                                                    $i++;
                                                                    ?>

                                                                    <tr>
                                                                        <td><p><?= $i ?></p></td>
                                                                        <td>
                                                                            <p><?= $row['begin_time1'] ?></p>
                                                                        </td>
                                                                        <td>
                                                                            <p><?= $row['end_time1'] ?></p>
                                                                        </td>
                                                                        <td>
                                                                            <p><?= $row['begin_time2'] ?></p>
                                                                        </td>
                                                                        <td>
                                                                            <p><?= $row['end_time2'] ?></p>
                                                                        </td>
                                                                    </tr>

                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>


                                        </li>

                                    </ul>
                                    <br>
                                    <hr>
                                    <br>
                                    <?php
                                }
                            }
                        }
                        ?>


                    </figure>
                </div>
            </section>

            <!-- / main body -->
            <div class="clear"></div>
        </main>
    </div>


    <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>

    <script src="layout/scripts/jquery.min.js"></script>
    <script src="layout/scripts/jquery.backtotop.js"></script>
    <script src="js/script.js"></script>
    <script src="js/moment-with-locales.min.js"></script>


    </body>
    </html>

<?php } ?>

