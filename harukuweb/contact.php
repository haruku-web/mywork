<?php
session_start();

//入力画面からのアクセスでなければ戻す 
if(!isset($_SESSION['form'])){
  header('Location: contact.php');
  exit();
}else{
  $post =$_SESSION['form'];
}
if($_SERVER['REQUEST_METHOD']==='POST'){
  // メールを送信する
  $to = 'me@example.com';
  $from = $post['email'];
  $subject = 'お問い合わせが届きました';
  $body = <<<EOT
名前：{$post['name']}
メールアドレス：{$post['email']}
内容：
{$post['contact']}  
EOT;
  mb_send_mail($to, $subject, $body, "From:{$from}");
  // セッションを消してお礼画面へ
  unset($_SESSION['form']);
  header('Location: thanks.html');
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation</title>
  <link href="https://unpkg.com/sanitize.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="contact.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Merriweather+Sans:wght@500&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.3.0/css/all.css" rel="stylesheet">
</head>
<body>
  <header class="header" id="home">
    <div class="header-nav">
      <button class="menu" id="menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="overlay">
        <nav>
          <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#works">Works</a></li>
          <li><a href="#skills">Skills</a></li>
          <li><a href="#contact">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  </header>
  <main>
    <div class="container">
    <form action="" method="POST" novalidate>
        <div class="heading">
          <h2>Confirmation.</h2>
        </div>
        <div class="form">
          <div class="form-group">
            <div class="row">
              <div class="item">
                <label for="inputName">Name</label>
              </div>
              <div class="txt">
                <p class="display_item"><?php echo htmlspecialchars($post['name']); ?></p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="item">
                <label for="inputEmail">Enaml</label>
              </div>
              <div class="txt">
                <p class="display_item"><?php echo htmlspecialchars($post['email']); ?></p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="item">
                <label for="inputContent">Message</label>
              </div>
              <div class="txt">
                <p class="display_item"><?php echo nl2br(htmlspecialchars($post['contact'])); ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="sub">
        <a href="./index.php"> Back </a>
        <button type="submit">SEND</button>
      </div>
        </form>

  </main>
  <footer>
    <div class="footer">
      <p>©️ 2021 MY PORTFOLIO SITE</p>
    </div>
  </footer>
  <script src="main.js"></script>
</body>
</html>  