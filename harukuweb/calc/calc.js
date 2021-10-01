const outputScreen = document.getElementById("output-screen");
// スクリーンに押した数字を順番に表示させる
function display(num){
  outputScreen.value += num;
}
// イコールを押したときの処理
function Calculate(){
  try{
    // 実行したディスプレイの表示
    outputScreen.value = eval(outputScreen.value);
    // エラーの無効アラートを返す
  }catch(err){
    alert("Invalid");
  }
}
// Clearを押したら0にする
function Clear(){
  outputScreen.value = "";
}
// delを押したら一文字カットする
function del(){
  outputScreen.value = outputScreen.value.slice(0,-1);
}