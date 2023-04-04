<template>
    <v-container>
        <v-card v-if="book">
            <v-card-title>{{ book.title }}</v-card-title>
            <v-card-subtitle>{{ book.author.first_name + ' ' + book.author.last_name }}</v-card-subtitle>
            <v-card-text>ISBN: {{ book.ISBN }}</v-card-text>
            <v-card-text>Publish Date {{ formatDate(book.publish_date) }}</v-card-text>
            <v-card-text>{{ book.genres.map(genre => genre.name).join(', ') }}</v-card-text>
            <v-card-actions>
                <v-btn color="warning" @click="editBook">Edit</v-btn>
                <v-btn color="error" @click="deleteBook">Delete</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            book: null,
            loading: true
        };
    },
    created() {
        this.loadBook();
    },
    methods: {
        loadBook() {
            const id = this.$route.params.id;
            this.$http.get(`/api/books/${id}`)
                .then(response => {
                    this.book = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error);
                    this.loading = false;
                });
        },
        editBook() {
            const id = this.$route.params.id;
            this.$router.push({name: 'books.edit', params: {id: id}});
        },
        deleteBook() {
            const id = this.$route.params.id;
            if (confirm('Are you sure you want to delete this book?')) {
                this.$http.delete(`/api/books/${id}`)
                    .then(response => {
                        this.$router.push({name: 'books'});
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            const year = date.getFullYear();
            const month = date.toLocaleString('default', {month: 'long'});
            const day = date.getDate();
            return `${month} ${day}, ${year}`;
        },
    }
};
</script>
