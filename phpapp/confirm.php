<?php
session_start();
require('database.php');
require('./Controllers/controller.php');
$controller = new ContactController();
$controller = $controller->checkOut($_SESSION['form']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Casteria</title>
    <link rel="stylesheet" type="text/css" href="public/css/base.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script defer src="../js/index.js"></script>
    </head>
    <body>
         <?php
            if (empty($_SERVER["HTTP_REFERER"])) {
                header('Location: contact.php');
            }
            $date= $_SESSION['form'];
            ?>
        <?php
         include './header.php';
        ?>  
        <section>
            <div id="box">
        <h2>確認画面</h2>
                <form method="post" action="complete.php">
                <div class="boxinner">
<dl>
    <dt>氏名</dt>
    <dd>
        <?php echo htmlspecialchars($date["name"], ENT_QUOTES, "UTF-8"); ?>
    </dd>
    <dt>フリガナ</dt>
    <dd>
        <?php echo htmlspecialchars($date["kana"], ENT_QUOTES, "UTF-8"); ?>
    </dd>
    <dt>電話番号</dt>
    <dd>
        <?php echo htmlspecialchars($date["tel"], ENT_QUOTES, "UTF-8"); ?>
    </dd>
    <dt>メールアドレス</dt>
    <dd>
        <?php echo htmlspecialchars($date["email"], ENT_QUOTES, "UTF-8");?>
    </dd>
    <dt>お問い合わせ内容</dt>
    <dd>
        <?php echo htmlspecialchars($date["body"], ENT_QUOTES, "UTF-8"); ?>
    </dd>
    <dd class="btn">
        <button type="submit" id="send">送　信</button>
        <a href="javascript:history.back()">戻　る</a>
    </dd>
</dl>
                </div>
                </form>
            </div>
        </section>
        <?php
         include './footer.php';
        ?>
    </body>
</html>
<style>
    .btn button {
        background-color: #fff;
        color: red;
        border-color: red;
    }
    .btn a {
        border: solid;
        padding: 2px 7px;
    }
    .btn a:hover {
        background-color: blue;
        color: #fff;
    }
    section {
        margin-top: 30px;
        margin-left: 20%;
    }
           dd button {
        margin-top: 15px;
        margin-bottom: 5px;
    }
            dd button:hover{
                background-color: red;
                color: #fff;
            }
</style>