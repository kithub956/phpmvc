<?php
 session_start();
require('database.php');
require('./Controllers/controller.php');
$controller = new ContactController();
$result = $controller->Varup();
?>

<!DOCTYPE html>
<html>
<?php
   $error = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if ($result['name'] === '') {
           $error['name'] = 'blank';
    } elseif (mb_strlen($result['name']) > 10) {
           $error['name'] = 'length';
    } else {
           $error['name'] = 'ok';
    }

    if ($result['kana'] === '') {
        $error['kana'] = 'blank';
    } elseif (mb_strlen($result ['kana']) > 10) {
        $error['kana'] = 'length';
    } else {
        $error['kana'] = 'ok';
    }

    if ($result['tel'] === '') {
        $error['tel'] = 'ok';
    } elseif (!preg_match("/^(0{1}\d{9,10})$/", $result["tel"])) {
        $error['tel'] = 'num';
    } else {
        $error['tel'] = 'ok';
    }

    if ($result['email'] === '') {
        $error['email'] = 'blank';
    } elseif (!filter_var($result['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'email';
    } else {
        $error['email'] = 'ok';
    }
    if ($result['body'] === '') {
        $error['body'] = 'blank';
    } else {
        $error['body'] = 'ok';
    }
   
    
    if ($error['name'] == 'ok' && $error["kana"] == 'ok' && $error["tel"] == 'ok'
    && $error['email'] == 'ok' && $error['body'] == 'ok' && !empty($_POST['name'])) {
        $_SESSION = $_POST;
        header("Location:edit.php");
    } else {
    }
}
?>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="update.css">
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
                        echo '<div style="color:red;margin-left:40px;">氏名を記入してください。</div>';
                    } elseif ($error['name'] == 'length') {
                        echo '<div style="color:red;margin-left:40px;">10文字以内でご入力してください。</div>';
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
                        echo '<div style="color:red;margin-left:40px;">フリガナを記入してください。</div>';
                    } elseif ($error['kana'] == 'length') {
                        echo '<div style="color:red;margin-left:40px;">10文字以内でご入力してください。</div>';
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
                        echo '<div style="color:red;margin-left:40px;">電話番号は0-9の数字のみでご入力ください。</div>';
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
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($error['email'] == 'blank') {
                        echo '<div style="color:red;margin-left:40px;">メールアドレスを記入してください。</div>';
                    } elseif ($error['email'] == 'email') {
                        echo '<div style="color:red;margin-left:40px;">メールアドレスは正しくご入力ください。</div>';
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
<style>
        dd {
        margin-left:0px;
        }
        .sub {
        background-color: #fff;
        color: red;
        border-color: red;
        }
        dl {
        margin-top: 30px;
        }
        form {
        margin-left: 20%;
        }
        textarea {
        width: 500px;
        height: 150px;
                resize: none;
        }
        .sub {
        width: 189.21px;
        margin-top: 15px;
        margin-bottom: 5px;
        }
    </style>
</body>
</html>