<template>
    <v-container>
        <v-form @submit.prevent="updateBook">
            <v-text-field
                v-model="book.title"
                :error-messages="getErrorMessages('title')"
                label="Title"
                required/>
            <v-text-field
                v-model="book.ISBN"
                :error-messages="getErrorMessages('ISBN')"
                label="ISBN"
                required/>
            <v-text-field
                v-model="book.publish_date"
                :error-messages="getErrorMessages('publish_date')"
                label="Publish Date"
                required/>
            <v-select
                v-model="book.author_id"
                :items="authors"
                item-title="first_name"
                item-value="id"
                label="Author"
                :error-messages="getErrorMessages('author_id')"
                required/>
            <v-select
                v-model="selectedGenres"
                :items="genres"
                chips
                item-title="name"
                item-value="id"
                label="Genres"
                :error-messages="getErrorMessages('genre_ids')"
                multiple/>

            <v-btn :disabled="loading" type="submit">Update</v-btn>
            <v-btn :disabled="loading" @click="deleteBook">Delete</v-btn>
            <v-progress-circular v-if="loading" indeterminate size="64"/>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            book: {},
            authors: [],
            genres: [],
            selectedGenres: [],
            loading: false
        }
    },

    async mounted() {
        this.loading = true

        // Fetch book by ID
        const bookId = this.$route.params.id
        const response = await this.$http.get(`/api/books/${bookId}`)
        this.book = response.data

        // Fetch authors and genres for dropdowns
        const [authorsResponse, genresResponse] = await Promise.all([
            this.$http.get('/api/authors'),
            this.$http.get('/api/genres')
        ])

        this.authors = authorsResponse.data.map(author => ({
            ...author,
            full_name: `${author.first_name} ${author.last_name}`
        }))
        this.genres = genresResponse.data

        // Set selected genres based on the book's genres
        this.selectedGenres = this.book.genres.map(g => g.id)

        this.loading = false
    },

    methods: {
        async updateBook() {
            this.loading = true

            try {
                await this.$http.put(`/api/books/${this.book.id}`, {
                    title: this.book.title,
                    author_id: this.book.author_id,
                    ISBN: this.book.ISBN,
                    publish_date: this.book.publish_date,
                    genre_ids: this.selectedGenres
                })

                this.$router.push({name: 'books'})
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error(error);
                }
            }

            this.loading = false
        },

        async deleteBook() {
            this.loading = true
            if (confirm('Are you sure you want to delete this book?')) {
                try {
                    await this.$http.delete(`/api/books/${this.book.id}`)
                    this.$router.push({name: 'books'})
                } catch (error) {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error(error);
                    }
                }
            }

            this.loading = false
        },
        getErrorMessages(field) {
            if (this.errors && this.errors[field]) {
                return this.errors[field];
            }
            return [];
        },
    }
}
</script>
