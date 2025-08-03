<script setup>
import {useLangStore} from "@/stores/lang.js";
import {computed} from "vue";
import {useI18n} from "vue-i18n";

const props = defineProps(['selectedCategory', 'selectedSlug', 'categoryTranslations']);
const langStore = useLangStore()
const categoryName = computed(() => props.categoryTranslations[props.selectedSlug]?.[langStore.currentLang])
const {t} = useI18n()
</script>

<template>
    <nav class="breadcrumbs">
        <router-link :to="{
                            name: 'Products',
                            params: { lang: langStore.currentLang },
                            query: { page: 1 }
                          }"
                     :class="{active: selectedCategory === 'Все'}" class="breadcrumb-link center">{{ t('products.title') }}
        </router-link>
        <span v-if="categoryName !== 'Все'">
            / <router-link :class="{active: selectedCategory !== 'Все'}"
                           :to="{
                                name: 'Products',
                                params: {
                                    lang: langStore.currentLang,
                                    category: selectedSlug
                                },
                                query: { page: 1 }
                                }"
                           class="breadcrumb-link center">
            {{ categoryName }}
        </router-link>
        </span>
    </nav>
</template>

<style scoped>
.breadcrumbs {
    font-size: 20px;
    display: flex;
    gap: 5px;
}

.breadcrumb-link {
    text-decoration: none;
    position: relative;
    color: #777;
}

.breadcrumb-link:after {
    position: absolute;
    content: '';
    bottom: 0;
    display: block;
    width: 0;
    height: 1px;
    background: #FFA542;
    transition: .3s;
}

.breadcrumb-link.center:after {
    left: 50%;
    transform: translateX(-50%);
}

.breadcrumb-link:hover:after {
    width: 100%;
}

.breadcrumb-link:hover {
    color: #FFA542;
}

.active {
    color: #FFA542;
}
</style>

