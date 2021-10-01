<?php
session_start();
require('dbconnect.php');
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
  $_SESSION['time'] = time();
  $members = $db->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
}else{
  header('Location: login.php');
  exit();
}
if(!empty($_POST)){
  if($_POST['message'] !== ''){
    $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_message_id=?, created=NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message'],
      $_POST['reply_post_id']
    ));
    header('Location: bbs.php');
    exit();
  }
}
$page = $_REQUEST['page'];
if($page == ''){
  $page = 1;
}
$page = max($page, 1);

$counts = $db->query('SELECT COUNT(*) AS cnt FROM posts');
$cnt = $counts->fetch();
$maxPage = ceil($cnt['cnt']/5);
$page = min($page, $maxPage);
$start = ($page - 1)*5;

$posts = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC LIMIT ?,5');
$posts->bindParam(1, $start, PDO::PARAM_INT);
$posts->execute();

if(isset($_REQUEST['res'])){
  // 返信の処理
  $response = $db->prepare('SELECT m.name, m.picture, p.* FROM members m ,posts p WHERE m.id=p.member_id AND p.id=?');
  $response->execute(array($_REQUEST['res']));

  $table = $response->fetch();
  $message = '@' . $table['name'] . ' ' . $table['message'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ひとこと掲示板</title>

	<link rel="stylesheet" href="index.css">
  <link href="https://use.fontawesome.com/releases/v5.3.0/css/all.css" rel="stylesheet">
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
          <div id="content" class="content">
            
            <div class="logout">
              <i class="fas fa-sign-out-alt"></i>
              <a href="logout.php">ログアウト</a></div>
            <form action="" method="post">
              <dl>
                <dt><?php print(htmlspecialchars($member['name'],ENT_QUOTES)); ?>さん、ようこそ！！</dt>
                <dd class="item">
                  <textarea name="message" cols="60" rows="8" placeholder="メッセージを入力"><?php print(htmlspecialchars($message,ENT_QUOTES)); ?></textarea>
                  <input type="hidden" name="reply_post_id" value="<?php print(htmlspecialchars($_REQUEST['res'],ENT_QUOTES)); ?>" />
                </dd>
              </dl>
              <div class="item">
                <p>
                  <input type="submit" value="投稿する" />
                </p>
              </div>
            </form>
          </div>
          <?php foreach($posts as $post): ?>
            <div class="msg">
              <div class="images up">
                <img src="member_picture/<?php print(htmlspecialchars($post['picture'],ENT_QUOTES)); ?>" width="48" height="48" alt="<?php print(htmlspecialchars($post['name'],ENT_QUOTES)); ?>">
                <span class="name"><?php print(htmlspecialchars($post['name'],ENT_QUOTES)); ?></span>
              </div>
              <div class="text-msg up">
                <p class="message op"><?php print(htmlspecialchars($post['message'],ENT_QUOTES)); ?>
                <a class="rep op" href="bbs.php?res=<?php print(htmlspecialchars($post['id'],ENT_QUOTES)); ?>">返信</a></p>
                <p class="day"><a href="view.php?id=<?php print(htmlspecialchars($post['id'],ENT_QUOTES)); ?>"><?php print(htmlspecialchars($post['created'],ENT_QUOTES)); ?></a>
                  <?php if($post['reply_message_id'] > 0): ?>
                  <a href="view.php?id=<?php print(htmlspecialchars($post['reply_message_id'],ENT_QUOTES)); ?>">
                    返信元のメッセージ</a>
                  <?php endif; ?>
                  <?php if($_SESSION['id'] == $post['member_id']): ?>
                    <a href="delete.php?id=<?php print(htmlspecialchars($post['id'],ENT_QUOTES)); ?>"
                      style="color: #F33;">削除</a>]
                  <?php endif; ?>
                </p>
              </div>
            </div>
              <?php endforeach; ?>
              <ul class="paging">
                <?php if($page > 1): ?>
                  <li class="prev"><i class="fas fa-angle-left"></i><a href="bbs.php?page=<?php print($page-1); ?>">前のページへ</a></li>
                <?php else: ?>
                  <li>前のページへ</li>
                <?php endif; ?>
                <?php if($page < $maxPage): ?>
                  <li class="next"><a href="bbs.php?page=<?php print($page+1); ?>">次のページへ</a><i class="fas fa-angle-right"></i></li>
                <?php else: ?>
                  <li></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
                    