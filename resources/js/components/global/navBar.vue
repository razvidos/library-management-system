<template>
    <v-chip v-for="route in routes">
        <router-link :to="route.to">{{ route.name }}</router-link>
    </v-chip>
</template>

<script setup>
const routes = [
    {name: 'Home', to: {name: 'home'}},
    {name: 'Books', to: {name: 'books'}},
];

</script>
