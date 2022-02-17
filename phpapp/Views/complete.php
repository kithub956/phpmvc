<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title></title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/complete.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script defer src="public/js/index.js"></script>
    </head>
    <body>
      <?php if (empty($_SERVER["HTTP_REFERER"])) {
            header('Location: contact.php');
      }
        ?>
        <?php
         include 'header.php';
        ?>  
        <section>
            <div id="box">
        <h2>完了画面</h2>
                <div class="boxinner">
                    <p>お問い合わせ内容を送信しました。
                        <br>ありがとうございました。</p>
                    <a href="index.php">トップへ</a>
                </div>
            </div>
        </section>
        <?php
         include 'footer.php';
        ?>
    </body>
</html>