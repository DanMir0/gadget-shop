<script setup>

import GContainer from "@/components/GContainer.vue";
</script>

<template>
    <g-container>
        <div class="about-us">
            <div class="block-wrapper">
                <div class="map">
                    <h2>Наш офис</h2>
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d194.82496764940115!2d84.9620023032552!3d56.46444731477038!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x432693522d8a5b21%3A0x6c89ff24e3caf63a!2z0YPQuy4g0JLQtdGA0YjQuNC90LjQvdCwLCAyNy82LCDQotC-0LzRgdC6LCDQotC-0LzRgdC60LDRjyDQvtCx0LsuLCDQoNC-0YHRgdC40Y8sIDYzNDAzNA!5e0!3m2!1sru!2s!4v1753284531455!5m2!1sru!2s"
                            allowfullscreen=""
                            loading="lazy"
                            style="border:0;"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="address-wrapper">
                        <div class="address-icon"></div>
                        <div class="address">
                            <span>ул.Вершинина, 27/6, Томск, Томская обл., Россия</span><br/>
                            <small>1 этаж, 1 кабинет</small>
                        </div>
                    </div>

                </div>
                <div class="social-media">
                    <a href="https://vk.com/"><img alt="Вконтакте" src="../images/VK.svg"></a>
                    <a href="https://web.telegram.org/"><img alt="Telegram" src="../images/Telegram.svg"></a>
                    <a href="https://www.whatsapp.com/?lang=ru_RU"><img alt="Whatsapp" src="../images/Whatsapp.svg"></a>
                    <a href="http://instagram.com/"><img alt="Instagram" src="../images/Instagram.svg"></a>
                </div>
            </div>

            <div class="phone">
                <div class="phone-icon"></div>
                <a href="tel:+77777777777">+7 777 777 77 77</a>
            </div>
        </div>
    </g-container>
</template>

<style scoped>
.phone {
    margin-top: 44px;
    display: flex;
    align-items: center;
    gap: 28px;
}

.phone-icon {
    width: 30px;
    height: 30px;
    background-repeat: no-repeat;
    background-image: url("../images/phone-about-us.svg");
}

.phone a {
    font-weight: 600;
    font-size: 25px;
}

.phone a:hover {
    color: #FFA542;
    text-decoration: underline;
}

.address {
    font-size: 18px;
}

.address span {
    font-weight: 600;
}

.address small {
    color: #838383;
}

.address-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
}

.address-icon {
    width: 24px;
    height: 26px;
    background-image: url("../images/map.svg");
    background-repeat: no-repeat;
}

.about-us {
    display: flex;
    flex-direction: column;
    margin: 20px 0;
}

.block-wrapper {
    display: flex;
    gap: 20px;
    justify-content: space-between;
}

.map {
    background: #fff;
    border-radius: 30px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    padding: 20px;
}

.map h2 {
    margin-top: 20px;
}

.map-container {
    width: 1000px;
    margin: 20px 0;
}

.map-container iframe {
    height: 550px;
    width: 100%;
}

.social-media {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 14px;
    max-height: 480px;
}

.social-media a {
    background: #ffffff;
    width: 110px;
    height: 110px;
    border-radius: 30px;
    padding: 28px;
}

.social-media a:hover {
    background-color: #FFA542;
}

.social-media img {
    width: 100%;
    height: 100%;
}

@media (max-width: 1220px) {
    .map-container {
        width: 100%;
    }

    .map-container iframe {
        height: 400px;
    }

    .about-us {
        align-items: center;
    }

    .block-wrapper {
        flex-direction: column;
    }

    .social-media {
        flex-direction: row;
        flex-wrap: wrap;
    }

    .social-media a {
        width: 170px;
        height: 160px;
    }

    .phone {
        margin-top: 34px;
    }

    .phone a {
        font-size: 20px;
    }

    @media (max-width: 576px) {
        .map-container iframe {
            height: 300px;
        }

        .map {
            padding: 10px;
        }

        .map h2 {
            font-size: 20px;
        }

        .address {
            font-size: 16px;
        }

        .address-wrapper {
            gap: 8px;
        }

        .phone {
            align-items: flex-start;
            gap: 10px;
            margin-top: 20px;
        }

        .phone-icon {
            background-image: url("../images/phone-about-us-small.svg");
        }
    }
}
</style>
