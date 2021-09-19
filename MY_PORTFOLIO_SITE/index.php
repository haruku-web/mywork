
<?php
session_start();
$error =[];
  if($_SERVER['REQUEST_METHOD']==='POST'){
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    // フォームの送信時にエラーをチェックする
    if($post['name']===''){
      $error['name']='blank';
    }
    if($post['email']===''){
      $error['email']='blank';
    }  elseif(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
      $error['email'] = 'email';
    }
    if($post['contact']===''){
      $error['contact']='blank';
    }  
    if(count($error)===0){
      // エラーがないので確認画面へ移動
      $_SESSION['form'] = $post;
      header('Location: contact.php');
      exit();
    }
  }else{
    if(isset($_SESSION['form'])){
      $post = $_SESSION['form'];
    }
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MY PORTFOLIO SITE</title>
  <link href="https://unpkg.com/sanitize.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Merriweather+Sans:wght@500&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.3.0/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
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
      <div class="header-title">
        <h1 class="site-title">MY PORTFOLIO SITE.</h1>
        <p class="sitedescription">Check out some of my works.</p>
      </div>
  </header>
      <section class="about" id="about">
        <h2 class="heading">About.</h2>
        <div class="about-container">
          <div class="up about-image">
            <img class="about-item book" src="images/book.jpg" alt="">
          </div>
          <div class="about-item about-text">
            <p>
              初めまして。現在WEB開発を学んでおります。<br>
              見る人の目を引くような、素敵な作品を作っていきたいと考えています。<br>
              このサイトは私が作成した作品を掲載している、 <br>
              自己紹介も兼ねたポートフォリオサイトです。<br>
            </p>
            <p>
              使用言語は、HTML,CSS,PHP,MySQL,Javascriptです。 <br>
              他の制作物も掲載していますので、ぜひWorksからご覧ください！！<br>
            </p>
          </div>
        </div>
      </section>
      <section class="works" id="works">
        <h2 class="heading wk-heading">Works.</h2>
        <div class="works-wrapper">
          <div class="works-box wb1">
            <img class="work-image" src="images/beach.jpg" alt="">
            <p class="work-text">
              <使用言語><br>
              ******* <br>
              ******* <br>
              ******* <br>
            </p>
            <a href="#" class="button">More</a>
          </div>
          <div class="works-box wb2">
            <img class="work-image" src="images/boat.jpg" alt="">
            <p class="work-text">
              <使用言語><br>
              ******* <br>
              ******* <br>
              ******* <br>
            </p>
            <a href="#" class="button">More</a>
          </div>
          <div class="works-box wb3">
            <img class="work-image" src="images/nature.jpg" alt="">
            <p class="work-text">
              <使用言語><br>
              ******* <br>
              ******* <br>
              ******* <br>
            </p>
            <a href="#" class="button">More</a>
          </div>
        </div>
      </section>
      <section class="skills" id="skills">
        <h2 class="heading">Skills.</h2>
        <div class="skill-wrapper">
          <div class="skill-box box1">
            <i class="skill-icon fas fa-code"></i>
            <div class="text-box">
              <div class="skill-title">CORDING</div>
              <p class="skill-text">HTML/CSS/Javascriptから<br>
                PHP/MySQLまで触れています。<br>
                一つのサイトを一貫して制作すること<br>
                ができます。</p>
            </div>
          </div>
          <div class="skill-box box2">
            <i class="skill-icon fas fa-pencil-ruler"></i>            
            <div class="text-box">
              <div class="skill-title">DESIGN</div>
              <p class="skill-text">一から自分でサイトを作ることが<br>
                とても好きです。<br>
                AdobeXDを使用しています。<br>
                </p>
            </div>
          </div>
          <div class="skill-box box3">
            <i class="skill-icon fas fa-graduation-cap"></i>
            <div class="text-box">
              <div class="skill-title">資格</div>
                <p class="skill-text">LPIC level1 <br>
                ITIL  foundation</p>
            </div>
          </div>
        </div>
      </section>
      <section class="contact blur" id="contact">
        <h2 class="heading contact-heading">Contact</h2>
        <form class="contact-form" action="" method="POST">
          <input class="name" type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($post['name']); ?>" >
          <?php if($error['name']==='blank'): ?>
          <p class="error_msg">※ Please write your name.</p>
          <?php endif; ?>
          <input class="email" type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($post['email']); ?>" >
          <?php if($error['email']==='blank'): ?>
          <p class="error_msg">※ Please write your email.</p>
          <?php endif; ?>
          <?php if($error['email']==='email'): ?>
          <p class="error_msg">※ The email you entered is not correct. Retry.</p>
          <?php endif; ?>
          <textarea class="form-contact" name="contact" placeholder="Message"><?php echo htmlspecialchars($post['contact']); ?></textarea>
          <?php if($error['contact']==='blank'): ?>
          <p class="error_msg">※ Please fill in the inquiry content</p>
          <?php endif; ?>
          <input type="submit" value="SEND">
        </form>
      </section>
  <footer class="footer">©️ 2021 MY PORTFOLIO SITE</footer>
  <script src="main.js"></script>
</body>
</html>