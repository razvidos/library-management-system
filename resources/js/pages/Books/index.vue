<template>
    <v-container>
        <router-link :to="{ name: 'books.create' }" class="btn btn-primary">Add Book</router-link>

        <search-books @search="searchBooks"/>

        <v-row v-if="isLoading" align="center" class="fill-height ma-0" justify="center">
            <v-progress-circular class="mx-auto" indeterminate size="100"></v-progress-circular>
        </v-row>

        <v-container v-if="!isLoading">
            <v-card
                v-for="book in books"
                :key="book.id"
                class="my-4"
            >
                <v-card-title>{{ book.title }}</v-card-title>
                <v-card-subtitle>{{ book.author.first_name + ' ' + book.author.last_name }}</v-card-subtitle>
                <v-card-text>ISBN: {{ book.ISBN }}</v-card-text>
                <v-card-text>{{ formatDate(book.publish_date) }}</v-card-text>
                <v-card-text>
                    <v-chip v-for="(genre, index) in book.genres" :key="index" color="primary">
                        {{ genre.name }}
                    </v-chip>
                </v-card-text>
                <v-card-actions>
                    <v-btn color="primary" @click="showBook(book.id)">Show</v-btn>
                    <v-btn color="warning" @click="editBook(book.id)">Edit</v-btn>
                    <v-btn color="error" @click="deleteBook(book.id)">Delete</v-btn>
                </v-card-actions>
            </v-card>
        </v-container>
        <v-pagination
            v-model="currentPage"
            :length="lastPage"
            @input="loadPage"
        ></v-pagination>
    </v-container>
</template>

<script>
import searchBooks from "../../components/searchBooks.vue"

export default {
    components: {searchBooks,},
    data() {
        return {
            isLoading: true,
            books: [],
            total: 0,
            perPage: 10,
            currentPage: 1,
            searchTerm: '',
        };
    },
    mounted() {
        this.loadPage(this.currentPage);
    },
    computed: {
        lastPage() {
            return Math.ceil(this.total / this.perPage);
        },
    },
    methods: {
        searchBooks(searchTerm) {
            this.searchTerm = searchTerm;
            this.loadPage();
        },
        loadPage(pageNumber) {
            this.isLoading = true;

            this.$http.get('/api/books', {
                params: {
                    perPage: this.perPage,
                    page: pageNumber,
                    searchTerm: this.searchTerm,
                },
            })
                .then(response => {
                    this.books = response.data.books;
                    this.total = response.data.total;
                    this.perPage = response.data.perPage;
                    this.currentPage = response.data.currentPage;
                    this.isLoading = false;
                })
                .catch(error => {
                    console.error(error);
                    this.isLoading = false;
                });
        },
        showBook(bookId) {
            this.$router.push({name: 'books.show', params: {id: bookId}});
        },
        editBook(bookId) {
            this.$router.push({name: 'books.edit', params: {id: bookId}});
        },
        deleteBook(bookId) {
            this.$http.delete(`/api/books/${bookId}`)
                .then(response => {
                    this.loadPage(this.currentPage);
                })
                .catch(error => console.error(error));
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            const year = date.getFullYear();
            const month = date.toLocaleString('default', {month: 'long'});
            const day = date.getDate();
            return `${month} ${day}, ${year}`;
        },
    },
    watch: {
        currentPage(newPage) {
            this.loadPage(newPage);
        },
    }
};
</script>
