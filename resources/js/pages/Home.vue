<script setup>
import {ref} from "vue";
import router from "@/router/router.js";

const slides = ref([
    {image: "/images/slider/slide3.jpg", title: "Скидка на аксессуары при покупки смартфона"},
    {image: "/images/slider/slide3.jpg", title: "Скидка на аксессуары при покупки смартфона"},
    {image: "/images/slider/slide3.jpg", title: "Скидка на аксессуары при покупки смартфона"},
])

const currentIndex = ref(0)

function nextSlide() {
    currentIndex.value = (currentIndex.value + 1) % slides.value.length
}

function prevSlide() {
    currentIndex.value = (currentIndex.value - 1 + slides.value.length) % slides.value.length
}

function goToSlide(index) {
    currentIndex.value = index
}

// Touch support
let startX = 0

const startTouch = (e) => {
    startX = e.touches[0].clientX
}

const moveTouch = (e) => {
    const endX = e.touches[0].clientX
    const diff = startX - endX

    if (Math.abs(diff) > 50) {
        if (diff > 0) nextSlide()
        else prevSlide()
    }
}

function goToProduct() {
    router.push('/products')
}

</script>

<template>
    <header class="hero">
        <div class="hero-content">
            <h1>Добро пожаловать в TechnoTop</h1>
            <p>Лучшие гаджеты и аксессуары — всё в одном месте</p>
            <g-button class="hero-btn" @click="goToProduct">Перейти в каталог</g-button>
        </div>
    </header>
    <div class="slider" @touchstart="startTouch" @touchmove="moveTouch">
        <div class="slides" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
            <div class="slide" v-for="(slide, index) in slides" :key="index">
                <img :src="slide.image" :alt="slide.title"/>
            </div>
        </div>
        <div class="navigation">
            <button @click="prevSlide">←</button>
            <button @click="nextSlide">→</button>
        </div>
        <div class="dots">
      <span
          v-for="(slide, index) in slides"
          :key="index"
          :class="{ active: index === currentIndex }"
          @click="goToSlide(index)"
      ></span>
        </div>
    </div>

    <g-container>
        <g-new-products></g-new-products>

        <section class="why-us mt-120">
            <h2>Почему выбирают нас?</h2>
            <div class="reasons">
                <div class="reason">
                    <img class="" src="../images/reliability.png" alt="Иконка надежности">
                    Надёжность и гарантия на всё
                </div>
                <div class="reason">
                    <img class="" src="../images/delivery.png" alt="Иконка доставка">
                    Доставка по всей России
                </div>
                <div class="reason">
                    <img class="" src="../images/24-hours-support.png" alt="Иконка поддержки">
                    Быстрая поддержка 24/7
                </div>
            </div>
        </section>

        <section class="testimonials mt-120">
            <h2>Отзывы наших клиентов</h2>
            <div class="testimonial-list">
                <div class="testimonial">
                    <p>“Очень доволен сервисом! Смартфон пришел быстро и в отличной упаковке.”</p>
                    <strong>— Иван, Москва</strong>
                </div>
                <div class="testimonial">
                    <p>“Цены супер! Нашёл тут редкий аксессуар, который нигде не было.”</p>
                    <strong>— Алина, Казань</strong>
                </div>
                <div class="testimonial">
                    <p>“Цены супер! Нашёл тут редкий аксессуар, который нигде не было.”</p>
                    <strong>— Алина, Казань</strong>
                </div>
            </div>
        </section>

        <div class="partners mt-120">
            <h2 class="partners-title">Наши партнеры</h2>
            <div class="partners-slide">
                <img src="../images/partner1.jpg" alt="Intel">
                <img src="../images/partner2.webp" alt="AMD">
                <img src="../images/partner3.png" alt="ASUS">
                <img src="../images/partner4.webp" alt="Nvidia">
            </div>
        </div>

        <div class="values mt-120">
            <h2 class="values-title">Наши ценности</h2>
            <p class="values-description">Наша миссия — сделать топ 1 магазин электронной технике в мире.</p>
            <div class="values-wrapper">
                <div class="values-product">
                    <img src="../images/ic-like.svg" alt="Icon">
                    <h3>Качество</h3>
                    <p>Предоставляем высочайшее качество</p>
                </div>
                <div class="values-product">
                    <img src="../images/Group.svg" alt="Icon">
                    <h3>Безопасность</h3>
                    <p>Имея большой опыт в работе, предоставляем полную безопастность </p>
                </div>
                <div class="values-product">
                    <img src="../images/ic-hand.svg" alt="Icon">
                    <h3>Скорость</h3>
                    <p>Быстрая доставка, безупречное качество товаров, идеальный сервис — всё это показывает, что
                        магазин ценит время и комфорт покупателей.</p>
                </div>
            </div>
        </div>
    </g-container>
</template>


<style scoped>
.testimonials {
    padding: 80px 20px;
    background-color: #ffffff;
    text-align: center;
}

.testimonials h2 {
    font-size: 36px;
    margin-bottom: 30px;
}

.testimonial-list {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
}

.testimonial {
    max-width: 300px;
    background: #f4f4f4;
    padding: 20px;
    border-radius: 10px;
    font-style: italic;
}

.mt-120 {
    margin-top: 120px;
}

.why-us {
    padding: 80px 20px;
    background: #f8f8f8;
    text-align: center;
}

.why-us h2 {
    font-size: 36px;
    margin-bottom: 30px;
}

.reasons {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.reason {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: white;
    padding: 40px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    font-size: 18px;
    width: 300px;
}

.reason img {
    width: 50px;
    margin-bottom: 8px;
}

.hero {
    background: url('/images/header2.png') no-repeat center center;
    background-size: cover;
    height: 1200px; /* На весь экран */
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hero-content {
    background: rgba(0, 0, 0, 0.6);
    display: inline-block;
    padding: 40px;
    border-radius: 12px;
}

.hero h1 {
    font-size: 48px;
    margin-bottom: 20px;
}

.hero p {
    font-size: 20px;
    margin-bottom: 30px;
}

.hero-btn {
    background: #ff6b00;
    border: none;
    padding: 12px 24px;
    font-size: 18px;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s;
}

.hero-btn:hover {
    background: #e65c00;
}

.slider {
    position: relative;
    overflow: hidden;
    max-width: 80%;
    border-radius: 12px;
    margin: 120px auto 0 auto;
}

.slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
    width: 100%;
}

.slide {
    min-width: 100%;
    box-sizing: border-box;
}

.slide img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
}

/* Навигация */
.navigation {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    padding: 0 20px;
}

.navigation button {
    background: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    font-size: 1.5rem;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
}

/* Точки */
.dots {
    display: flex;
    justify-content: center;
    margin-top: 10px;
    position: absolute;
    z-index: 10;
    top: 93%;
    left: 50%;
}

.dots span {
    width: 10px;
    height: 10px;
    background: gray;
    border-radius: 50%;
    margin: 0 4px;
    cursor: pointer;
    transition: background 0.3s;
}

.dots span.active {
    background: black;
}

/* Партнеры */
.partners {
    background: #f8f8f8;
    padding: 80px 20px;
    display: flex;
    flex-direction: column;
    gap: 40px;
    margin-bottom: 120px;
    align-items: center;
}

.partners-title {
    font-size: 36px;
    text-align: center;
    font-weight: bold;
}

.partners-slide {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 40px;
    width: 100%;
    max-width: 1200px;
    justify-items: center;
    align-items: center;
}

.partners-slide img {
    width: 280px;
    height: 200px;
    object-fit: contain;
    background-color: white;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, filter 0.3s ease;
}

.values {
    background: #f8f8f8;
    padding: 80px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 100px;
}

.values-wrapper {
    margin-top: 34px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Было 100px */
    gap: 40px;
    width: 100%;
    max-width: 1200px;
}

.values-product {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.values-product h3 {
    font-size: 26px;
    font-weight: bold;
    margin-top: 24px;
    margin-bottom: 8px;
}

.values-title {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 21px;
}

.values-description {
    font-size: 18px;
}

@media (max-width: 1200px) {
    .slider {
        margin: 60px auto 0 auto;
    }

    .mt-120 {
        margin-top: 60px;
    }

    .hero {
        height: 800px;
    }

    .partners-title,
    .values-title {
        font-size: 36px;
    }

    .values-description {
        font-size: 16px;
        padding: 0 20px;
        text-align: center;
    }

    .partners-slide {
        gap: 20px;
    }

    .partners-slide img {
        width: 200px;
        height: 140px;
    }

    .partners-slide {
        grid-template-columns: repeat(2, 1fr);
        margin: 0 50px;
    }

    .partners-slide img {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .navigation {
        padding: 0
    }

    .navigation button {
        font-size: 0.5rem;
    }

    .mt-120 {
        margin-top: 40px;
    }

    .slider {
        margin: 40px auto 0 auto;
    }

    .hero {
        padding: 0 15px;
        height: 600px;
        background-attachment: scroll; /* фиксированный фон не работает хорошо на мобилках */
    }

    .hero h1 {
        font-size: 32px;
    }

    .hero p {
        font-size: 16px;
    }

    .hero-content {
        padding: 24px;
    }

    .hero-btn {
        font-size: 16px;
        padding: 10px 20px;
    }

    .partners-title,
    .values-title {
        font-size: 28px;
        text-align: center;
    }

    .partners {
        margin-top: 60px;
        margin-bottom: 60px;
        gap: 20px;
        padding: 0 16px;
    }

    .partners-slide {
        grid-template-columns: repeat(1, 1fr);
        gap: 20px;
        margin: 0 20px;
    }

    .partners-slide img {
        width: 100%;
    }

    .values {
        padding: 0 16px;
    }

    .values-wrapper {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .values-product h3 {
        font-size: 22px;
    }

    .values-description {
        font-size: 16px;
    }
}
</style>
