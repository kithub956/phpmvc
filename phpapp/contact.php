<?php
session_start();
require('database.php');
require('./Controllers/controller.php');
$controller = new ContactController();
$date = $controller->index();

        $name =!empty($_POST["name"]);
        $kana = !empty($_POST["kana"]);
        $tel = !empty($_POST["tel"]);
        $email = !empty($_POST["email"]);
        $body = !empty($_POST["body"]);
        $name = htmlspecialchars($name, ENT_QUOTES);
        $kana = htmlspecialchars($kana, ENT_QUOTES);
        $tel =  htmlspecialchars($tel, ENT_QUOTES);
        $email =  htmlspecialchars($email, ENT_QUOTES);
        $body =  htmlspecialchars($body, ENT_QUOTES);
        $reg_str = "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/";
?>
<!DOCTYPE html>
<html lang="ja">
    <?php
    $error = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($post['name'] === '') {
            $error['name'] = 'blank';
        } elseif (mb_strlen($post['name']) > 10) {
            $error['name'] = 'length';
        } else {
            $error['name'] = 'ok';
        }
        
        if ($post['kana'] === '') {
            $error['kana'] = 'blank';
        } elseif (mb_strlen($post ['kana']) > 10) {
            $error['kana'] = 'length';
        } else {
            $error['kana'] = 'ok';
        }
        
        if ($post['tel'] === '') {
            $error['tel'] = 'ok';
        } elseif (!preg_match("/^(0{1}\d{9,10})$/", $post["tel"])) {
            $error['tel'] = 'num';
        } else {
            $error['tel'] = 'ok';
        }
        
        if ($post['email'] === '') {
            $error['email'] = 'blank';
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'email';
        } else {
            $error['email'] = 'ok';
        }
        
        if ($post['body'] === '') {
            $error['body'] = 'blank';
        } else {
            $error['body'] = 'ok';
        }
       
        
        if ($error['name'] == 'ok' && $error["kana"] == 'ok' && $error["tel"] == 'ok'
        && $error['email'] == 'ok' && $error['body'] == 'ok') {
            $_SESSION['form'] = $post;
            header('Location: confirm.php');
            exit();
        } else {
            if (isset($_SESSION['form'])) {
                $post = $_SESSION['form'];
            }
        }
    }
    
    ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Casteria</title>
  <link rel="stylesheet" type="text/css" href="../css/base.css">
  <link rel="stylesheet" type="text/css" href="public/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script defer src="../js/index.js"></script>
    </head>
    <body>
        <?php
         include './header.php';
        ?>  
        <section>
            <div id="box">
        <h2>お問い合わせ</h2>
                <form method="POST" action="" name="mailform">
                <div class="boxinner">
<dl class="inquiry">
    <dt>
        <label for="name">氏名</label>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($error['name'] == 'blank') {
                echo '<div style="color:red;">氏名を記入してください。</div>';
            } elseif ($error['name'] == 'length') {
                echo '<div style="color:red;">10文字以内でご入力してください。</div>';
            }
        }
        ?>
    </dt>
    <dd>
        <input type="text" id="name" name="name" placeholder="山田太郎">
    </dd>
    <dt>
        <label for="kana">フリガナ</label>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($error['kana'] == 'blank') {
                echo '<div style="color:red;">フリガナを記入してください。</div>';
            } elseif ($error['kana'] == 'length') {
                echo '<div style="color:red;">10文字以内でご入力してください。</div>';
            }
        }
        ?>
    </dt>
    <dd>
        <input type="text" id="kana" name="kana" placeholder="ヤマダタロウ">
    </dd>
    <dt>
        <label for="tel">電話番号</label>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($error['tel'] == 'num') {
                echo '<div style="color:red;">電話番号は0-9の数字のみでご入力ください。</div>';
            }
        }
        ?>
    </dt>
    <dd>
        <input type="text" id="tel" name="tel" placeholder="09012345678">
    </dd>
    <dt>
        <label for="email">メールアドレス</label>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($error['email'] == 'blank') {
                echo '<div style="color:red;">メールアドレスを記入してください。</div>';
            } elseif ($error['email'] == 'email') {
                   echo '<div style="color:red;">メールアドレスは正しくご入力ください。</div>';
            }
        }
        ?>
    </dt>
    <dd>
        <input type="text" id="email" name="email" placeholder="test@test.co.jp">
    </dd>
        </dl> 
            <h3>
                <label for="content">
                    お問い合わせ内容をご記入ください
                </label>
            </h3>
    <dl>
    <textarea name="body" id="body"></textarea>
        <dd>
            <button type="submit" id="send" onclick="return check()">送　信</button>
        </dd>
        </dl>
                </div>
                </form>
            </div>
            <script>
        function check() {
             if (mailform.email.value=="" || mailform.name.value=="" || mailform.kana.value=="" || mailform.tel.valeu=="" || mailform.body.value=="")
             {
               alert("氏名は必須入力です。10文字以内でご入力ください。\nフリガナは必須入力です。\n10文字以内でご入力ください。\n電話番号は0-9の数字のみでご入力ください。\nメールアドレスは正しくご入力ください。\nお問い合わせ内容は必須入力です。");
               return false;
            } else {
               return true;
           }
           }
            </script>
        </section>
        <table border="1">
            <tr>
                <th>氏名</th>
                <th>フリガナ</th>
                <th>電話番号</th>
                <th>メールアドレス</th>
                <th>お問い合わせ内容</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            foreach ($date as $row) {
                ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['kana'] ?></td>
                <td><?php echo $row['tel'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo nl2br($row['body']) ?></td>
                <td>
            <form action="update.php" method="post" name="editform">
                    <input type="submit" value="編集">
                    <input type="hidden" name="id" value="<?=$row['id']?>">
                </form>
                </td>
                <td>
                <form action="delete.php" method="post">
                    <input type="submit" value="削除" id="del">
                    <input type="hidden" name="id" value="<?=$row['id']?>">
                </form>   
                </td>
            </tr>
                <?php
            }
            ?>
            <script>
             $('#del').click(function() {
                if(!window.confirm('削除しますか')) {
                    return false;
                    } 
                       });
            </script>
        </table>
        <?php
        include './footer.php';
        ?>
        <style>
            dd button {
        background-color: #fff;
        color: red;
        border-color: red;
    }
            section {
       
        margin-top: 30px;
    }
            table {
        margin-bottom: 30px;
        width: 100%;
    }
            section form {
        margin-left: 20%;
    }
            h2 {
       margin-left: 20%;
    }
            textarea {
        width: 500px;
        height: 150px;
                resize: none;
    }
           dd button {
        width: 189.21px;
        margin-top: 15px;
        margin-bottom: 5px;
    }
            dd button:hover{
                background-color: red;
                color: #fff;
            }
    </style>
    </body>
</html>
