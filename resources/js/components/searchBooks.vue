<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="6" sm="8">
                <v-text-field v-model="searchTerm" label="Search" placeholder="Enter search term"/>
            </v-col>
            <v-col cols="12" md="3" sm="4">
                <v-btn color="primary" dark @click="search">Search</v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            searchTerm: ''
        }
    },
    methods: {
        search() {
            this.$emit('search', this.searchTerm)
        }
    }
}
</script>
