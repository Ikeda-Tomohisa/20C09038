<!-- math -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>myapp-算数</title>
<link rel="stylesheet" href="./stylemaincontents.css">
</head>

<script src="./jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./notedrawing.js"></script>
<script>

$(document).ready(function(){
  $("#nextpage").click(function(){
    $("#textbook").children("img").attr("src", "./tbmath2.png");
  });
  $("#previouspage").click(function(){
    $("#textbook").children("img").attr("src", "./tbmath1.png");
  });
});

</script>

<body>
<?php include './header.php' ?>

<div id="tab">tab</div>
<div id="box">
    <div id="textside">textbook<br>
        <div id="textbook">
            <img src="./tbmath1.png">
        </div><br>
        <button id="previouspage">前ページ</button>
        <button id="nextpage">次ページ</button>
    </div>
    <div id="noteside">note</button>
        <div id="note">
             <canvas id="canvas"></canvas>
        </div>
        <input type="button" id="undo" name="undo" value="undo">
        <input type="button" id="redo" name="redo" value="redo"><br>
        
    </div>

</div>
</body>
</html>