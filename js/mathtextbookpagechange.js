$(document).ready(function(){
  
  let index = 0;
  $("#textbook").children("img").attr("src", "./class_"+classid+"/textbook_math/"+imgs[index]);
  $("#pagenumber").text((index+1)+"ページ");
  
  $("#nextpage").click(function(){
    if(index == imgs.length - 1){
      index = imgs.length - 1;
    }else{
      index++;
    }
    $("#textbook").children("img").attr("src", "./class_"+classid+"/textbook_math/"+imgs[index]);
    $("#pagenumber").text((index+1)+"ページ");
  });
  
  $("#previouspage").click(function(){
    if(index == 0){
      index = 0;
    }else{
      index--;
    }
    $("#textbook").children("img").attr("src", "./class_"+classid+"/textbook_math/"+imgs[index]);
    $("#pagenumber").text((index+1)+"ページ");
  });
  
  $("#firstpage").click(function(){
    index = 0;
    $("#textbook").children("img").attr("src", "./class_"+classid+"/textbook_math/"+imgs[index]);
    $("#pagenumber").text((index+1)+"ページ");
  });
  
  $("#lastpage").click(function(){
    index = imgs.length - 1;
    $("#textbook").children("img").attr("src", "./class_"+classid+"/textbook_math/"+imgs[index]);
    $("#pagenumber").text((index+1)+"ページ");
  });
  
});