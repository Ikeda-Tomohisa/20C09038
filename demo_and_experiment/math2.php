<!-- math -->

<?php include './globalcommon.php' ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>myapp-算数</title>
<link rel="stylesheet" href="../css/swiper-bundle.min.css">
<link rel="stylesheet" href="../css/stylemaincontents.css">

<style>
.swiper-container {
      width: 500px;
      height: 705px;
    }
.swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
</style>
</head>

<script src="../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../js/notedrawing.js"></script>
<script src="../js/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
</script>

<body>
<?php include './header.php' ?>

<div id="tab">tab</div>
<div id="box">
    <div id="textside">textbook<br>
        <div id="textbook">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="tbmath1.png"></div>
                    <div class="swiper-slide"><img src="tbmath2.png"></div>
                    <div class="swiper-slide"><img src="tbmath3.png"></div>
                    <div class="swiper-slide"><img src="tbmath4.png"></div>
                    <div class="swiper-slide"><img src="tbmath5.png"></div>
                    <div class="swiper-slide">Slide 6</div>
                    <div class="swiper-slide">Slide 7</div>
                    <div class="swiper-slide">Slide 8</div>
                    <div class="swiper-slide">Slide 9</div>
                    <div class="swiper-slide">Slide 10</div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div><br>
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