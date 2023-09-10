const app = Vue.createApp({
    data() {
        return {
            cafes: [],
            selectedCafe: null,
            comments: []
        };
    },
    methods: {
        randomSelect() {
            const randomIndex = Math.floor(Math.random() * this.cafes.length);
            this.selectedCafe = this.cafes[randomIndex];
            this.loadComments(this.selectedCafe.id);
        },
        selectCafe(cafe) {
            this.selectedCafe = cafe;
            this.loadComments(cafe.id);
        },
        loadComments(cafeId) {
            fetch(`/cafe/view-comments?id=${cafeId}`)
            .then(response => response.json())
            .then(data => {
                this.comments = data;
            })
            .catch(error => {
                console.error('Error loading comments:', error);
            });
        },
        addNewComment(newComment) {
            console.log('Adding new comment:', newComment);  // Для отладки
            fetch('/cafe/create-comment?id=' + this.selectedCafe.id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ text: newComment })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data);  // Для отладки
                if (data.status === 'success') {
                    this.loadComments(this.selectedCafe.id);  // Обновляем список комментариев
                } else {
                    console.error('Error adding comment:', data.message);
                }
            })
            .catch(error => {
                console.error('Error adding comment:', error);
            });
        }
        
        
    },
    mounted() {
        fetch('https://bandaumnikov.ru/api/test/site/get-index')
        .then(response => response.json())
        .then(data => {
            this.cafes = data.data;
        })
        .catch(error => {
            console.error('Error fetching cafes:', error);
        });
    }
});

// Компонент для списка комментариев
app.component('comment-list', {
    props: ['comments'],
    template: `
        <div>
            <h3>Комментарии:</h3>
            <ul>
                <li v-for="comment in comments" :key="comment.id">
                    {{ comment.text }}
                </li>
            </ul>
        </div>
    `
});

// Компонент для добавления комментария
app.component('add-comment-form', {
    data() {
        return {
            newComment: ''
        };
    },
    methods: {
        addComment() {
            this.$emit('add-comment', this.newComment);
            this.newComment = '';
        }
    },
    template: `
        <div>
            <h3>Добавить комментарий:</h3>
            <form @submit.prevent="addComment">
                <textarea v-model="newComment"></textarea>
                <button type="submit" class="button">Добавить коммент</button>
            </form>
        </div>
    `
});

app.mount('#vue-app');
