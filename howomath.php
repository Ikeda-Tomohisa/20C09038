<!-- howomath homeworkmath -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>myapp-算数</title>
<link rel="stylesheet" href="./stylemaincontents.css">
</head>
<script src="./jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./notedrawing.js"></script>

<body>
<?php include './header.php' ?>

<div id="tab">tab</div>
<div id="box">
    <div id="textside">textbook<br>
        <div id="textbook">
            <img src="./howomath1.png" >
        </div>
    </div>
    <div id="noteside">note
        <div id="note">
             <canvas id="canvas"></canvas>
        </div>
        <div>
        <input type="button" id="undo" name="undo" value="undo">
        <input type="button" id="redo" name="redo" value="redo">
        </div>
    </div>
</div>
</body>
</html>