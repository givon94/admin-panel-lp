<template>
    <v-container
        class="fill-height"
    >
        <v-row
            align="center"
            justify="center"
        >
            <div class="block-wrapper content-404">
                <div class="error__404-images"><img class="error-image" src="404-cat-not-found.gif" alt="Ошибка 404 с котиком" /></div>
                <h2 class="h1-404">Страница не найдена</h2>
                <div class="my-2" style="text-align: center;">
                    <v-btn
                            color="primary"
                            text
                            large
                            to="/"
                    >На главную</v-btn>
                </div>
            </div>
        </v-row>
    </v-container>
</template>


<style scoped>
    .h1-404 {
        margin-top: -100px;
        text-align: center;
        font-family: Arial,sans-serif;
        font-size: 2rem;
    }

    .h2-404 {
        top: 110px;
        font-family: Arial,sans-serif;
        padding-bottom: 10px;
        text-align: center;
        font-size: 28px;
        color: #bc2929;
        position: relative;
    }

    .error__404-images {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .error-404__btn {
        width: 240px;
        height: 46px;
        padding-top: 8px;
        display: block;
        margin: 10px auto;
        font-size: 20px;
        text-align: center;
    }

    @media (max-width: 600px) {
        .error404 {
            min-width: 200px!important;
        }

        .error-image {
            max-width: 300px;
        }

        .error-images {
            max-width: 200px;
        }

        .h1-404 {
            margin-top: 0;
        }

        .h2-404 {
            top: 20px;
            max-width: 202px;
            margin-left: auto;
            margin-right: auto;
            padding: 0;
        }
    }
</style>
