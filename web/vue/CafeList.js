export default {
    props: ['cafes'],
    template: `
        <div>
            <h1>Список кафе</h1>
            <button @click="selectRandomCafe">Выбрать случайное кафе</button>
            <ul>
                <li v-for="cafe in cafes" :key="cafe.id" @click="selectCafe(cafe)">
                    {{ cafe.name }}
                </li>
            </ul>
        </div>
    `,
    methods: {
        selectRandomCafe() {
            const randomIndex = Math.floor(Math.random() * this.cafes.length);
            this.$emit('select-cafe', this.cafes[randomIndex]);
        },
        selectCafe(cafe) {
            this.$emit('select-cafe', cafe);
        }
    }
};
