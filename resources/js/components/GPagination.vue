<script setup>
import router from "@/router/router.js";
import {computed} from "vue";

const props = defineProps(['currentPage', 'lastPage', 'visiblePages', 'selectedSlug'])

function changePage(page) {
    if (page >= 1 && page <= props.lastPage) {
        router.push({
            query: {
                page,
                category: props.selectedSlug || undefined // ✅ Учитываем категорию
            }
        });
    }
}

const visiblePages = computed(() => {
    const pages = [];

    // Покажем по одной странице до и после текущей
    for (let i = props.currentPage - 1; i <= props.currentPage + 1; i++) {
        if (i > 1 && i < props.lastPage) {
            pages.push(i);
        }
    }

    return pages;
});
</script>

<template>
    <div class="pagination" v-if="lastPage > 1">
        <button
            @click="changePage(currentPage - 1)"
            :disabled="currentPage === 1"
            class="pagination-button"
            aria-label="Назад"
        >
            ◀
        </button>

        <!-- Always show page 1 -->
        <button
            @click="changePage(1)"
            class="pagination-button"
            :class="{ active: currentPage === 1 }"
        >
            1
        </button>

        <!-- Left ellipsis -->
        <span v-if="currentPage > 3" class="pagination-ellipsis">...</span>

        <!-- Pages around current -->
        <button
            v-for="page in visiblePages"
            :key="page"
            @click="changePage(page)"
            class="pagination-button"
            :class="{ active: currentPage === page }"
        >
            {{ page }}
        </button>

        <!-- Right ellipsis -->
        <span v-if="currentPage < lastPage - 2" class="pagination-ellipsis">...</span>

        <!-- Always show last page if it's not 1 -->
        <button
            v-if="lastPage > 1"
            @click="changePage(lastPage)"
            class="pagination-button"
            :class="{ active: currentPage === lastPage }"
        >
            {{ lastPage }}
        </button>

        <button
            @click="changePage(currentPage + 1)"
            :disabled="currentPage === lastPage"
            class="pagination-button"
            aria-label="Вперед"
        >
            ▶
        </button>
    </div>
</template>

<style scoped>
.pagination {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 30px;
}

.pagination-button {
    padding: 8px 14px;
    font-size: 16px;
    border-radius: 8px;
    border: 2px solid #000;
    background-color: #fff;
    color: #000;
    cursor: pointer;
    transition: all 0.2s ease;
    min-width: 36px;
}

.pagination-button:hover:not(:disabled) {
    background-color: #000;
    color: #fff;
}

.pagination-button.active {
    background-color: #000;
    color: #fff;
}

.pagination-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-ellipsis {
    display: flex;
    align-items: center;
    font-size: 16px;
    color: #666;
}

/* 📱 Мобильные */
@media (max-width: 480px) {
    .pagination {
        gap: 6px;
        margin-top: 20px;
    }

    .pagination-button {
        padding: 6px 10px;
        font-size: 13px;
        border-radius: 6px;
        min-width: 30px;
    }

    .pagination-ellipsis {
        font-size: 14px;
    }
}

/* 💻 Планшеты */
@media (max-width: 768px) {
    .pagination-button {
        padding: 7px 12px;
        font-size: 14px;
        border-radius: 7px;
    }
}
</style>
