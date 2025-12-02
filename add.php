<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IT-Термины</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <!-- Шапка -->
    <div class="header">
        <h1>IT-Термины</h1>
        <nav>
            <a href="index.php">Главная</a>
            <a href="add.php">Добавить термин</a>
        </nav>
    </div>

    <div class="main-content">
        <?php
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            include 'db.php';
            
            
            $term = mysqli_real_escape_string($mysql, $_POST['term']);
            $definition = mysqli_real_escape_string($mysql, $_POST['definition']);
            $image_url = mysqli_real_escape_string($mysql, $_POST['image_url']);
            
            
            $sql = "INSERT INTO tech_terms (term, definition, image_url) 
                    VALUES ('$term', '$definition', '$image_url')";
            
            if (mysqli_query($mysql, $sql)) {
                $message = "Термин '$term' успешно добавлен!";
                $success = true;
            } else {
                $message = "Ошибка: " . mysqli_error($mysql);
                $success = false;
            }
            
            mysqli_close($mysql);
            ?>
            
            <!-- Результат добавления -->
            <div class="result-section">
                <h2><?php echo $success ? 'Успешно!' : 'Ошибка'; ?></h2>
                <div class="message <?php echo $success ? 'success' : 'error'; ?>">
                    <?php echo $message; ?>
                </div>
                <div class="nav-links">
                    <a href="add.php" class="nav-btn">Добавить еще</a>
                    <a href="index.php" class="nav-btn">На главную</a>
                </div>
            </div>
            
            <?php
        } else {

            ?>
            
            <div class="form-section">
                <h2>Добавить новый IT-термин</h2>
                
                <form method="POST" action="add.php">
                    <div class="form-group">
                        <label>Термин:</label>
                        <input type="text" name="term" required placeholder="Например: JavaScript">
                    </div>
                    
                    <div class="form-group">
                        <label>Определение:</label>
                        <textarea name="definition" rows="5" required placeholder="Описание термина..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>URL изображения:</label>
                        <input type="url" name="image_url" required placeholder="https://example.com/image.png">
                        <small>Пример: https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg</small>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="submit" class="submit-btn">Добавить</button>
                        <a href="index.php" class="back-btn">Отмена</a>
                    </div>
                </form>
            </div>
            
            <?php
        }
        ?>
    </div>
    
    <!-- Футер -->
    <div class="footer">
        <p>Лабораторная работа №5: Подключение к базе данных с помощью PHP.</p>
        <p>Выполнил студент группы 241-361: Мария Андрианова</p>
    </div>
</body>
</html>