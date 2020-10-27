<template>
    <v-container>
        <v-layout row>
            {{ currentRouteName }}
        </v-layout>
    </v-container>
</template>


<script>

    export default {
        computed: {
            currentRouteName: function () {
                return this.$route.path;
            }
        }
    }
</script>
