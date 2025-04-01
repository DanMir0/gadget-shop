<script setup>
// import {useRoute, useRouter} from "vue-router";
//
// const route = useRoute();
// const router = useRouter();
//
// const currentLanguage = route.params.lang || 'ru';
</script>

<template>
    <div class="footer">
        <div class="footer-preview">
            <router-link to=""><img alt="logo" class="footer-img" src="../images/logo2-removebg-preview.png"/>
            </router-link>
            <p class="footer-title">Ninja Devices</p>
        </div>
        <div class="footer-group">
            <nav>
                <ul class="footer-links">
                    <li><router-link to="" class="link">Избранное</router-link></li>
                    <li><router-link to="" class="link">Корзина</router-link></li>
                    <li><router-link to="" class="link">Контакты</router-link></li>
                </ul>
            </nav>
        </div>
        <div class="footer-group">
            <nav class="footer-about">
                <ul>
                    <li><router-link to="" class="link">Условия сервиса</router-link></li>
                </ul>
            </nav>
            <div class="footer-language">
                <img alt="Иконка планеты" src="../images/RU.svg">
<!--                // ru-->
                <router-link to="#" class="language">Рус</router-link>
                <!--                // en-->
                <router-link to="#" class="language">Eng</router-link>
            </div>
        </div>
        <div class="footer-social">
            <a href="https://vk.com/"><img alt="Вконтакте" src="../images/VK.svg"></a>
            <a href="https://web.telegram.org/"><img alt="Telegram" src="../images/Telegram.svg"></a>
            <a href="https://www.whatsapp.com/?lang=ru_RU"><img alt="Whatsapp" src="../images/Whatsapp.svg"></a>
            <a href="http://instagram.com/"><img alt="Instagram" src="../images/Instagram.svg"></a>
        </div>

    </div>
</template>

<style scoped>
.footer {
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: #FFFFFF;
    padding: 60px 15px;
    justify-content: space-around;
}

.footer-preview {
    display: flex;
    align-items: center;
    align-content: center;
}

.footer-img {
    height: 150px;
}

.footer-title {
    font-size: 40px;
    font-weight: bold;
}


.footer-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.link {
    font-size: 23px;
}

.link:hover {
    color: #FFA542;
}

.footer-group {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 106px;
    height: 100%;
}

.footer-language {
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.language {
    font-size: 17px;
}

.language:hover {
    color: #FFA542;
}

.footer-social {
    display: flex;
    align-items: center;
    gap: 17px;
}
</style>
