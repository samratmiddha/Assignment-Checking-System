<?php
session_start();
require_once('../backend/student.php');
require_once('../backend/reviewer.php');
if(!isset($_SESSION['user'])){
    header('Location: ./login_page.php');
}
$user=unserialize($_SESSION['user']);
$susername=$_GET['username'];
$student2=$user->createstudentobject($susername);
?>
<html>
    <head>
        <title>
student info
        </title>
        <link rel="stylesheet" href="../styles/studentfromreviewer.css">
    </head>
    <body>
        <div id='parent-container'>
            <div id='profile'>
            <?php
                $user->showstudentprofile($susername);
            ?>
            </div>
            <div id='assignments'>
                <div id='pending_assignments'>
                    <h1>pending_assignments</h1>
                    <?php
                        $student2->showpendingassignments(true);
                    ?>
                </div>
                <div id='all_assignments'>
                    <h1>All Assignments</h1>
                    <?php
                        $student2->showassignments(true);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>