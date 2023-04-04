<template>
    <v-container>
        <v-form ref="form" v-model="valid">
            <v-text-field v-model="title" label="Title" required/>
            <v-text-field v-model="ISBN" label="ISBN" required/>
            <v-text-field v-model="publish_date" label="Publish Date" required/>

            <v-select
                v-model="selectedAuthor"
                :items="authors"
                item-title="full_name"
                item-value="id"
                label="Author"
                required/>
            <v-select
                v-model="selectedGenre"
                :items="genres"
                chips
                item-title="name"
                item-value="id"
                label="Genre"
                multiple
                required/>
            <v-btn :disabled="!valid" @click="submit">Create Book</v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            valid: false,
            title: '',
            ISBN: '',
            publish_date: null,
            selectedAuthor: null,
            selectedGenre: null,
            authors: [],
            genres: [],
        };
    },
    created() {
        this.loadAuthors();
        this.loadGenres();
    },
    methods: {
        async loadAuthors() {
            const response = await this.$http.get('/api/authors');
            this.authors = response.data.map(author => ({
                ...author,
                full_name: `${author.first_name} ${author.last_name}`
            }));
        },
        async loadGenres() {
            const response = await this.$http.get('/api/genres');
            this.genres = response.data;
        },
        async submit() {
            const payload = {
                title: this.title,
                ISBN: this.ISBN,
                publish_date: this.publish_date,
                author_id: this.selectedAuthor,
                genre_ids: this.selectedGenre,
            };
            const response = await this.$http.post('/api/books', payload);
            this.$router.push({name: 'books.show', params: {id: response.data.id}});
        },
    },
};
</script>
