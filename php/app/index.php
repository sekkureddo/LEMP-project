<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = $_ENV['MYSQL_HOST'] ?? 'mysql';
$db =  $_ENV['MYSQL_DATABASE'] ?? 'guestbook'; 
$user = $_ENV['MYSQL_USER'] ?? 'user';
$pass = $_ENV['MYSQL_PASSWORD'] ?? 'secretik';

$pdo = new PDO(
    "mysql:host=$host;dbname=$db;charset=utf8mb4",
    $user,
    $pass
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_POST['name'] ?? false) {
    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
    $stmt->execute([$_POST['name'], $_POST['message']]);
    header("Location: /");
    exit;
}

$messages = $pdo->query("SELECT *, DATE_FORMAT(created_at, '%d.%m.%Y %H:%i') as fmt_date FROM messages ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Гостевая книга • LEMP Docker</title>
    <style>
        body {font-family: system-ui, sans-serif; max-width: 800px; margin: 40px auto; padding: 20px; background:#f8f9fa;}
        input, textarea {width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 6px;}
        button {background:#0066ff; color:white; padding:12px 24px; border:none; border-radius:6px; font-size:16px;}
        .msg {background:white; padding:16px; margin:12px 0; border-radius:8px; box-shadow:0 1px 4px rgba(0,0,0,0.1);}
    </style>
</head>
<body>
<h1>Гостевая книга (полностью в Docker)</h1>
<form method="post">
    <input type="text" name="name" placeholder="Твоё имя" required>
    <textarea name="message" placeholder="Сообщение" required></textarea>
    <button>Отправить</button>
</form>

<hr>

<?php foreach ($messages as $m): ?>
<div class="msg">
    <strong><?=htmlspecialchars($m['name'])?></strong> 
    <small><?=htmlspecialchars($m['fmt_date'])?></small><br>
    <?=nl2br(htmlspecialchars($m['message']))?>
</div>
<?php endforeach; ?>
</body>
</html>