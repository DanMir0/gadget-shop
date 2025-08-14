<script setup>

</script>

<template>
    <g-container>
        <nav class="menu">
            <ul class="menu-wrapper">
                <router-link :to="{name: 'AdminProducts'}" class="link" exact-active-class="active">Товары</router-link>
                <router-link class="link">Заказы</router-link>
            </ul>
            <div class="menu-group">
                <hr>
                <div class="link-wrapper">
                    <router-link :to="{name: 'AddProduct'}" class="btn-add">Добавить товар</router-link>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </g-container>
</template>

<style scoped>
.link-wrapper {
    display: flex;
    align-items: center;
}

.menu {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    background-color: #f8f9fa;
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
}

.menu-wrapper {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    list-style: none;
    margin: 0;
    padding: 0 20px;
}

.menu-group {
    display: flex;
    gap: 20px;
    margin: 0 10px;
}


.btn-add {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.btn-add:hover {
    background-color: #218838;
}

.link {
    color: #333;
    font-size: 16px;
    padding: 12px 24px;
    border-radius: 6px;
    border: 1px solid transparent;
    text-decoration: none;
    transition: all 0.3s ease;
}

.link:hover {
    background-color: #a6a7a9;
    color: #fff;
}

.active {
    background-color: #666564;
    color: #fff;
}
</style>
