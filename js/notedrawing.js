// JavaScriptのグローバル変数群
var CANVAS_SIZE;
var undoDataStack = [];
var redoDataStack = [];
var mouseDown = false;

$(function() {
	// 画面読み込み時のロード処理
	$(document).ready(function(){

		// キャンバスのサイズを設定
		$('#canvas').css('width', '500px');
		$('#canvas').css('height', '705px');

		// キャンバスの属性を設定
		canvas = document.getElementById('canvas');
		canvas.width = 500;
		canvas.height = 705;
		CANVAS_SIZE = canvas.clientWidth;

		// 描画開始 → 描画中 → 描画終了
		canvas.addEventListener('mousedown', startDraw, false);
		canvas.addEventListener('mousemove', drawing, false);
		canvas.addEventListener('mouseup', endDraw, false);
	});

	//
	// undo
	//
	$("#undo").click(function() {

		if (undoDataStack.length <= 0) {
			return;
		}

		canvas = document.getElementById('canvas');
		context = canvas.getContext('2d');
		redoDataStack.unshift(context.getImageData(0, 0, canvas.width, canvas.height));

		var imageData = undoDataStack.shift();
		context.putImageData(imageData, 0, 0);
	});

	//
	// redo
	//
	$("#redo").click(function() {

		if (redoDataStack.length <= 0) {
			return;
		}

		canvas = document.getElementById('canvas');
		context = canvas.getContext('2d');
		undoDataStack.unshift(context.getImageData(0, 0, canvas.width, canvas.height));

		var imageData = redoDataStack.shift();
		context.putImageData(imageData, 0, 0);
	});
});

// 描画開始
function startDraw(event){

	// 描画前処理をおこないマウス押下状態にする。
	beforeDraw();
	mouseDown = true;

	// クライアント領域からマウス開始位置座標を取得
	wbound = event.target.getBoundingClientRect() ;
	stX = event.clientX - wbound.left;
	stY = event.clientY - wbound.top;

	// キャンバス情報を取得
	canvas = document.getElementById("canvas");
	context = canvas.getContext("2d");
}

// 描画前処理
function beforeDraw() {
	// undo領域に描画情報を格納
	redoDataStack = [];
	canvas = document.getElementById('canvas');
	context = canvas.getContext('2d');
	undoDataStack.unshift(context.getImageData(0, 0, canvas.width, canvas.height));
}

// 描画中処理
function drawing(event){
	// マウスボタンが押されていれば描画中と判断
	if (mouseDown){
		x = event.clientX - wbound.left;
		y = event.clientY - wbound.top;
		draw(x, y);
	}
}

// 描画終了
function endDraw(event){

// マウスボタンが押されていれば描画中と判断
	if (mouseDown){
		context.globalCompositeOperation = 'source-over';
		context.setLineDash([]);
		mouseDown = false;
	}
}

// 描画
function draw(x, y){
	canvas = document.getElementById("canvas");
	context = canvas.getContext("2d");
	context.beginPath();
	//context.strokeStyle = "black";
	//context.fillStyle = "black";
	context.lineWidth = document.getElementById("lineWidth").value;
	context.lineCap = "round";
	context.globalCompositeOperation = 'source-over';
	context.moveTo(stX,stY);
	context.lineTo(x,y);
	context.stroke();
	stX = x;
	stY = y;
}

//線の太さの値を変える
lineWidth.addEventListener("mousemove",function(){  
var lineNum = document.getElementById("lineWidth").value;
document.getElementById("lineNum").innerHTML = lineNum;
});

//色を選択
$('li').click(function() {
	context = canvas.getContext("2d");
	context.strokeStyle = $(this).css('background-color');
});

//消去ボタンを起動する
$('#clear').click(function(event) {
	if(!confirm('本当に消去しますか？')) return;
	event.preventDefault();
	context.clearRect(0, 0, canvas.width, canvas.height);
});

$('#save').click(function() {
	c = document.getElementById("canvas");
	//a = document.createElement('a');
	//a.href = c.toDataURL('image/png');
	//a.download = 'note.png';
	//a.click();
	
	var imagedata = c.toDataURL('image/png');
	//console.log(imagedata);
	$.ajax({
		type: 'POST',
		url: 'save.php',
		//contentType: false,
		//processData: false,
		data: {"imagedata":imagedata},
		dataType:'text',
		scriptCharset: 'utf-8',
		success:function(data){
			alert("保存しました。saved.");
		},
		error:function(XMLHttpRequest, textStatus, errorThrown){
			alert("ng");
			alert('Error : ' + errorThrown);
			console.log("XMLHttpRequest : " + XMLHttpRequest.status);
			console.log("textStatus     : " + textStatus);
			console.log("errorThrown    : " + errorThrown.message);
		}
	});
});
