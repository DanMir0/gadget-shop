<script setup>
import {computed, onMounted, ref} from "vue";
import {useRoute} from "vue-router";

const route = useRoute()
const termsData = {
    ru: [
        {
            title: "Условия сервиса",
            description: "Задача организации, в особенности же курс на социально-ориентированный национальный проект требует от нас системного анализа модели развития! Таким образом, постоянное информационно-техническое обеспечение нашей деятельности требует от нас анализа системы масштабного изменения ряда параметров! С другой стороны социально-экономическое развитие напрямую зависит от всесторонне сбалансированных нововведений?"
        },
        {
            title: "Условия доставки",
            description: "Задача организации, в особенности же курс на социально-ориентированный национальный проект требует от нас системного анализа модели развития! Таким образом, постоянное информационно-техническое обеспечение нашей деятельности требует от нас анализа системы масштабного изменения ряда параметров! С другой стороны социально-экономическое развитие напрямую зависит от всесторонне сбалансированных нововведений?"
        },
        {
            title: "Условия возврата",
            description: "Задача организации, в особенности же курс на социально-ориентированный национальный проект требует от нас системного анализа модели развития! Таким образом, постоянное информационно-техническое обеспечение нашей деятельности требует от нас анализа системы масштабного изменения ряда параметров! С другой стороны социально-экономическое развитие напрямую зависит от всесторонне сбалансированных нововведений?"
        },
    ],
    en: [
        {
            title: "Terms of Service",
            description: "The task of the organization, especially the course on the socially-oriented national project requires from us a system analysis of the development model! Thus, the constant information and technical support of our activities requires us to analyze the system of large-scale changes in a number of parameters! On the other hand, the socio-economic development directly depends on comprehensive and balanced innovations?"
        },
        {
            title: "Terms of Delivery",
            description: "The task of the organization, especially the course on the socially-oriented national project requires from us a system analysis of the development model! Thus, the constant information and technical support of our activities requires us to analyze the system of large-scale changes in a number of parameters! On the other hand, the socio-economic development directly depends on comprehensive and balanced innovations?"
        },
        {
            title: "Terms of Returns",
            description: "The task of the organization, especially the course on the socially-oriented national project requires from us a system analysis of the development model! Thus, the constant information and technical support of our activities requires us to analyze the system of large-scale changes in a number of parameters! On the other hand, the socio-economic development directly depends on comprehensive and balanced innovations?"
        }
    ]
}
const langData = computed(() => {
    return ['ru', 'en'].includes(route.params.lang) ? route.params.lang : 'ru'
})
onMounted(() => {
    langData.value = route.params.lang
})
</script>

<template>
    <g-container>
        <div class="terms">
            <div class="terms-block" v-for="(item, key) in termsData[langData]" :key="key">
                <h2 class="terms-title">{{ item.title }}</h2>
                <p class="terms-description ">{{ item.description }}</p>
            </div>
        </div>
    </g-container>
</template>

<style scoped>
.terms {
    display: flex;
    flex-direction: column;
    gap: 33px;
    margin: 60px 0 120px 0;
}

.terms-block {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Увеличенная тень */
    background-color: #FFFFFF;
    border-radius: 36px;
    padding: 28px 30px 40px 31px;
}

.terms-title {
    margin-bottom: 15px;
}

.terms-description {
    font-size: 18px;
    padding-left: 20px;
}
</style>
