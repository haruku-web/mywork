<?php
session_start();
require('dbconnect.php');
if(empty($_REQUEST['id'])){
  header('Location: bbs.php');
  exit();
}

$posts = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=?');
$posts->execute(array($_REQUEST['id']));
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ひとこと掲示板</title>

	<link rel="stylesheet" href="index.css" />
</head>

<body>
  <section>
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
    <div class="box">
      <div class="container">
        <div id="wrap">
          <div id="head">
            <h1>ひとこと掲示板</h1>
          </div>
          <div id="content">
          <p>&laquo;<a href="bbs.php">一覧にもどる</a></p>

        <?php if($post = $posts->fetch()): ?>
          <div class="msg">
            <div class="images up">
            <img src="member_picture/<?php print(htmlspecialchars($post['picture'])); ?>"width="48" height="48" alt="<?php print(htmlspecialchars($post['name'],ENT_QUOTES)); ?>">
            <span class="name"><?php print(htmlspecialchars($post['name'])); ?></span>
          </div>
          <div class="text-msg up">
              <p><?php print(htmlspecialchars($post['message'])); ?></p>
              <p class="day"><?php print(htmlspecialchars($post['created'])); ?></p>
            </div>
            <?php else: ?>
              <p>その投稿は削除されたか、URLが間違えています</p>
            <?php endif; ?>  
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
