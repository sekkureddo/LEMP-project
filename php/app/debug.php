<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Debug Page</h1>";

// Проверка базового PHP
echo "<h3>PHP Info:</h3>";
echo "PHP Version: " . PHP_VERSION . "<br>";
echo "Memory Limit: " . ini_get('memory_limit') . "<br>";

// Проверка расширений
echo "<h3>PHP Extensions:</h3>";
echo "PDO MySQL: " . (extension_loaded('pdo_mysql') ? '✅ Loaded' : '❌ Missing') . "<br>";

// Проверка переменных окружения
echo "<h3>Environment Variables:</h3>";
$env_vars = [
    'MYSQL_HOST' => getenv('MYSQL_HOST'),
    'MYSQL_DB' => getenv('MYSQL_DB'), 
    'MYSQL_USER' => getenv('MYSQL_USER'),
    'MYSQL_PASS' => getenv('MYSQL_PASS')
];

foreach ($env_vars as $key => $value) {
    echo "$key: " . ($value ? $value : '❌ NOT SET') . "<br>";
}

// Проверка подключения к БД
echo "<h3>Database Connection:</h3>";
try {
    $host = $env_vars['MYSQL_HOST'] ?: 'mysql';
    $db = $env_vars['MYSQL_DATABASE'] ?: 'guestbook';
    $user = $env_vars['MYSQL_USER'] ?: 'user';
    $pass = $env_vars['MYSQL_PASSWORD'] ?: 'secretik';
    
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Connection successful!<br>";
    
    // Проверим таблицы
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables: " . (count($tables) ? implode(', ', $tables) : 'None') . "<br>";
    
    // Если таблицы нет - создадим
    if (!in_array('messages', $tables)) {
        $pdo->exec("CREATE TABLE messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        echo "✅ Table 'messages' created<br>";
        
        // Добавим тестовое сообщение
        $pdo->exec("INSERT INTO messages (name, message) VALUES ('Admin', 'Welcome to guestbook!')");
        echo "✅ Test message added<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "<br>";
}

echo "<h3>Superglobals:</h3>";
echo "POST data: ";
print_r($_POST);
echo "<br>ENV data: ";
print_r($_ENV);
?>