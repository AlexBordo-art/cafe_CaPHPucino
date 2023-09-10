<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe-shop</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="stylesheet" href="./vue/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div id="vue-app" class="container">
        <button class="button" @click="randomSelect">Выбрать случайное кафе</button>
        <ul v-if="!selectedCafe" class="cafe-list">
            <li v-for="cafe in cafes" :key="cafe.id" @click="selectCafe(cafe)" class="cafe-card">
                <img class="cafe-image" :src="cafe.photo" alt="Фото кафе">
                <div class="cafe-content">
                    <div class="cafe-title">{{ cafe.name }}</div>
                </div>
            </li>
        </ul>
        <div v-if="selectedCafe" class="cafe-card">
            <img class="cafe-image" :src="selectedCafe.photo" alt="Фото кафе">
            <div class="cafe-content">
                <h2 class="cafe-title">{{ selectedCafe.name }}</h2>
                <p>Адрес: {{ selectedCafe.address }}</p>
                <p>Ориентир: {{ selectedCafe.landmark }}</p>
                <p>Кухня: {{ selectedCafe.cuisine }}</p>
                <p>Расстояние: {{ selectedCafe.distance }} м</p>
                <p>Время работы: {{ selectedCafe.time }}</p>
                <p>Бизнес-ланч: {{ selectedCafe.business_lunch }}</p>
                <p>Средний чек: {{ selectedCafe.price }} руб.</p>
            </div>
            <add-comment-form v-if="selectedCafe" @add-comment="addNewComment"></add-comment-form>
            <comment-list v-if="selectedCafe" :comments="comments"></comment-list>
        </div>
    </div>
    <script src="./vue/main.js"></script>
</body>

</html>
