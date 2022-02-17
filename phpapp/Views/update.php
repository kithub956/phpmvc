<?php
session_start();
require('database.php');
require('../Controllers/controller.php');
$controller = new ContactController();
$result = $controller->Varup();
$isupVali = $controller->upvali($_POST);
if ($isupVali['name'] == 'ok' && $isupVali["kana"] == 'ok' && $isupVali["tel"] == 'ok'
      && $isupVali['email'] == 'ok' && $isupVali['body'] == 'ok') {
    $_SESSION = $_POST;
    header("Location:edit.php");
    exit();
} else {
    $error = $isupVali;
}
if (empty($_POST['name'])) {
    $error['tel'] = 'ok';
    $error['email'] = 'ok';
}
var_dump($error);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/update.css">
</head>
<body>
    <dl>
        <form action="" method="post" name="editform">
                <input type="hidden" name="id" value="<?php if (!empty($result['id'])) {
                    echo(htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'));
                                                      }?>">
                <dt>
                <label>氏名</label>
                </dt>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($error['name'] == 'blank') {
                        echo '<div style="color:red;">氏名を記入してください。</div>';
                    } elseif ($error['name'] == 'length') {
                        echo '<div style="color:red;">10文字以内でご入力してください。</div>';
                    }
                }
                ?>
                <dd>
                <input type="text" name="name" value="<?php if (!empty($result['name'])) {
                    echo(htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8'));
                                                      }?>">
                </dd>
                <dt>
                <label>フリガナ</label>
                </dt>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($error['kana'] == 'blank') {
                        echo '<div style="color:red;">フリガナを記入してください。</div>';
                    } elseif ($error['kana'] == 'length') {
                        echo '<div style="color:red;">10文字以内でご入力してください。</div>';
                    }
                }
                ?>
                <dd>
                <input type="text" name="kana" value="<?php if (!empty($result['kana'])) {
                     echo(htmlspecialchars($result['kana'], ENT_QUOTES, 'UTF-8'));
                                                      }?>">
                </dd>
                <dt>
                <label>電話番号</label>
                </dt>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($error['tel'] == 'num') {
                        echo '<div style="color:red;">電話番号は0-9の数字のみでご入力ください。</div>';
                    }
                }
                ?>
                <dd><input type="text" name="tel" value="<?php if (!empty($result['tel'])) {
                    echo(htmlspecialchars($result['tel'], ENT_QUOTES, 'UTF-8'));
                                                         }?>">
                </dd>
                <dt>
                <label>メールアドレス</label>
                </dt>
                <?php
                var_dump($error['email']);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($error['email'] == 'blank') {
                        echo '<div style="color:red;">メールアドレスを記入してください。</div>';
                    } elseif ($error['email'] == 'email') {
                        echo '<div style="color:red;">メールアドレスは正しくご入力ください。</div>';
                    }
                }
                ?>
                <dd><input type="text" name="email" value="<?php if (!empty($result['email'])) {
                    echo(htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8'));
                                                           }?>">
                </dd>
                <dt>
                <label>お問い合わせ内容</label>
                </dt>
                <dd>
                    <textarea name="body" id="body"><?php if (!empty($result['body'])) {
                        echo(htmlspecialchars($result['body'], ENT_QUOTES, 'UTF-8'));
                                                    }?>
                                                           </textarea>
                </dd>
            <input type="submit" value="実　行" class="sub" onclick="return check()">
        </form>
        <script>
            function check() {
             if (editform.email.value=="" || editform.name.value=="" || editform.kana.value=="" || editform.tel.valeu=="" || editform.body.value=="")
             {
               alert("氏名は必須入力です。10文字以内でご入力ください。\nフリガナは必須入力です。\n10文字以内でご入力ください。\n電話番号は0-9の数字のみでご入力ください。\nメールアドレスは正しくご入力ください。\nお問い合わせ内容は必須入力です。");
               return false;
            } else {
               return true;
           }
           }
           </script>
</dl>
</body>
</html>