<?php
include 'db.php';

$result = mysqli_query($mysql, "SELECT * FROM tech_terms ORDER BY id");
$row_count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
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
        
        <!-- Таблица терминов -->
        <div class="section">
            <h2>Таблица терминов (<?php echo $row_count; ?> записей)</h2>
            
            <?php if ($row_count > 0): ?>
            <div class="table-container">
                <table class="data-table">
                    <tr>
                        <th>Термин</th>
                        <th>Определение</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><strong><?php echo $row['term']; ?></strong></td>
                        <td><?php echo $row['definition']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <?php else: ?>
            <p class="no-data">Нет данных в базе. Добавьте первый термин.</p>
            <?php endif; ?>
        </div>
        
        <!-- Галерея изображений -->
        <div class="section">
            <h2>Галерея IT-терминов</h2>
            <p>Наведите курсор на изображение для просмотра названия</p>
            
            <div class="gallery">
                <?php
                mysqli_data_seek($result, 0);
                
                if ($row_count > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="gallery-item">
                    <img src="<?php echo $row['image_url']; ?>" 
                         alt="<?php echo $row['term']; ?>"
                         title="<?php echo $row['term']; ?>">
                </div>
                <?php
                    }
                }
                mysqli_free_result($result);
                mysqli_close($mysql);
                ?>
            </div>
        </div>
        
        <!-- Ссылка на добавление -->
        <div class="nav-links">
            <a href="add.php" class="nav-btn">Добавить новый термин</a>
        </div>
    </div>
    
    <!-- Футер -->
    <div class="footer">
        <p>Лабораторная работа №5: Подключение к базе данных с помощью PHP.</p>
        <p>Выполнил студент группы 241-361: Мария Андрианова</p>
    </div>
</body>
</html>