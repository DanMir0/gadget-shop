<script setup>
import {useRoute, useRouter} from "vue-router";
import {useLangStore} from "@/stores/lang.js";

const router = useRouter()
const route = useRoute()
const langStore = useLangStore();

function switchLanguage(newLang) {
    if (newLang === route.params.lang) return

    langStore.setLang(newLang)

    const newRoute = {
        ...route,
        params: { ...route.params, lang: newLang },
    };

    router.push(newRoute)
}
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
                    <li>
                        <router-link :to="{name: 'Favorites', }" class="link">Избранное</router-link>
                    </li>
                    <li>
                        <router-link :to="{name: 'Cart'}" class="link">Корзина</router-link>
                    </li>
                    <li>
                        <router-link :to="{name: 'AboutUs'}" class="link">Контакты</router-link>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="footer-group">
            <nav class="footer-about">
                <ul>
                    <li>
                        <router-link :to="{name: 'TermsOfUse'}" exact-active-class="active" class="link">Условия сервиса</router-link>
                    </li>
                </ul>
            </nav>
            <div class="footer-language">
                <img alt="Иконка планеты" src="../images/RU.svg">
                <!--                // ru-->
                <button @click="switchLanguage('ru')" :class="{ active: route.params.lang === 'ru'}" class="language">Рус</button>
                <!--                // en-->
                <button @click="switchLanguage('en')" :class="{ active: route.params.lang === 'en'}" class="language">Eng</button>
            </div>
        </div>
        <div class="footer-social">
            <a href="https://vk.com/"><img class="footer-social-img" alt="Вконтакте" src="../images/VK.svg"></a>
            <a href="https://web.telegram.org/"><img class="footer-social-img" alt="Telegram" src="../images/Telegram.svg"></a>
            <a href="https://www.whatsapp.com/?lang=ru_RU"><img class="footer-social-img" alt="Whatsapp" src="../images/Whatsapp.svg"></a>
            <a href="http://instagram.com/"><img class="footer-social-img" alt="Instagram" src="../images/Instagram.svg"></a>
        </div>

    </div>
</template>

<style scoped>
.active {
    color: #FFA542;
    text-decoration: underline 1px solid #FFA542;
}

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

@media (max-width: 1200px) {
    .footer {
        flex-direction: column;
        gap: 40px;
        padding: 35px 10px;
    }

    .footer-group {
        min-height: 70px;
    }
}

@media (max-width: 768px) {
    .footer {
        flex-direction: column;
        gap: 40px;
        padding: 20px 10px;
    }

    .footer-title {
        font-size: 28px;
    }

    .link {
        font-size: 18px;
    }
}

@media (max-width: 500px) {
    .footer-preview {
        flex-direction: column;
    }

    .footer-img {
        height: 80px;
    }

    .footer-title {
        font-size: 24px;
    }

    .link {
        font-size: 16px;
    }

    .footer-social-img {
        width: 22px;
    }
}
</style>
