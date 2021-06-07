<!-- math -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>myapp-算数</title>
<link rel="stylesheet" href="./css/stylemaincontents.css">
</head>

<script src="./js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./js/notedrawing.js"></script>
<script type="text/javascript" src="./js/textbookpagechange.js"></script>

<body>
<?php include './header.php' ?>

<div id="tab">tab</div>
<div id="box">
    <div id="textside">textbook<br>
        <div id="textbook">
            <img>
        </div><br>
        <div id="center">
            <button id="firstpage">最初へ</button>
            <button id="previouspage">前ページ</button>
            <p id="pagenumber"></p>
            <button id="nextpage">次ページ</button>
            <button id="lastpage">最後へ</button>
        </div>
    </div>
    <div id="noteside">note</button>
        <div id="note">
             <canvas id="canvas"></canvas>
        </div><br>
        <div id="center">
        <input type="button" id="undo" name="undo" value="undo">
        <input type="button" id="redo" name="redo" value="redo">
        </div>
        
    </div>

</div>
</body>
</html>