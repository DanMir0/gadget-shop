<script setup>
import {computed, onMounted, ref, watch} from "vue";
import axios from "axios";

const count = ref(0)
const orders = ref([])
const showModal = ref(false)
const selectedOrderId = ref(null)
const sortKey = ref(null)
const sortOrder = ref(1)

// Функция сортировки
function sortBy(key) {
    if (sortKey.value === key) {
        sortOrder.value *= -1; // смена порядка сортировки
    } else {
        sortKey.value = key;
        sortOrder.value = 1;
    }
}

// Получение значения по вложенному ключу
function getNestedValue(obj, path) {
    return path.split('.').reduce((acc, key) => acc && acc[key], obj);
}

// Вычисляемый массив отсортированных заказов
const sortedOrders = computed(() => {
    if (!sortKey.value) return orders.value;

    return [...orders.value].sort((a, b) => {
        const aVal = getNestedValue(a, sortKey.value);
        const bVal = getNestedValue(b, sortKey.value);

        if (aVal < bVal) return -1 * sortOrder.value;
        if (aVal > bVal) return 1 * sortOrder.value;
        return 0;
    });
});

async function getOrders() {
    try {
        const response = await axios.get('/api/get-orders')
        orders.value = response.data
    } catch (e) {

    }
}

function openModal(orderId) {
    showModal.value = !showModal.value
    selectedOrderId.value = orderId
}

async function confirmDelete(orderID) {
    await axios.delete(`/admin/orders/${orderID}`)
    await getOrders()
    showModal.value = false
}

async function saveOrder(orderId, orderStatus) {
    const data = {
        status: orderStatus
    }

    await axios.put(`/admin/orders/${orderId}`, data)
}

onMounted(async () => {
    await getOrders()
})

</script>

<template>
    <g-admin-menu :to="{}" :showBtn="false"></g-admin-menu>
    <div class="orders-wrapper">
        <table class="orders-table">
            <thead>
            <tr>
                <th @click="sortBy('id')" class="text-center">
                    ID
                    <span v-if="sortKey === 'id'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('address.full_name')" class="text-center">
                    ФИО
                    <span v-if="sortKey === 'address.full_name'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('address.city')" class="text-center">
                    Город
                    <span v-if="sortKey === 'address.city'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('address.street')" class="text-center">
                    Улица
                    <span v-if="sortKey === 'address.street'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('address.house')" class="text-center">
                    Дом
                    <span v-if="sortKey === 'address.house'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('address.apartment')" class="text-center">
                    Квартира
                    <span v-if="sortKey === 'address.apartment'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('address.phone')" class="text-center">
                    Телефон
                    <span v-if="sortKey === 'address.phone'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('address.comments')" class="text-center">
                    Комментарий
                    <span v-if="sortKey === 'address.phone'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th class="text-center">Товар</th>
                <th @click="sortBy('total_price')" class="text-center">
                    Итого
                    <span v-if="sortKey === 'total_price'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('status')" class="text-center">
                    Статус
                    <span v-if="sortKey === 'status'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('created_at')" class="text-center">
                    Дата создания
                    <span v-if="sortKey === 'created_at'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th @click="sortBy('updated_at')" class="text-center">
                    Дата редактирования
                    <span v-if="sortKey === 'updated_at'">{{ sortOrder === 1 ? '↑' : '↓' }}</span>
                </th>
                <th class="text-center">Действия</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="order in sortedOrders" :key="order.id">
                <td>{{ order.id }}</td>
                <td>{{ order.address.full_name ?? 'Неизвестно' }}</td>
                <td>{{ order.address.city ?? '—' }}</td>
                <td>{{ order.address.street ?? '—' }}</td>
                <td>{{ order.address.house ?? '—' }}</td>
                <td>{{ order.address.apartment ?? '—' }}</td>
                <td>{{ order.address.phone ?? '—' }}</td>
                <td>{{ order.address.comments ?? '—' }}</td>
                <td>
                       <span v-for="item in order.items" :key="item.id">
                     {{ item.product.name.ru }} (x{{ item.quantity }})
                </span>
                </td>
                <td>{{ order.total_price }} ₽</td>
                <td>
                    <select v-model="order.status">
                        <option>Новый</option>
                        <option>В пути</option>
                        <option>Доставлен</option>
                    </select>
                </td>
                <td>{{ new Date(order.created_at).toLocaleDateString() }}</td>
                <td>{{ new Date(order.updated_at).toLocaleDateString() }}</td>
                <td class="column-center">
                    <svg @click="openModal(order.id)" fill="#00000" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 50 50"
                         width="20px"
                         height="20px">
                        <path
                            d="M 21 0 C 19.355469 0 18 1.355469 18 3 L 18 5 L 10.1875 5 C 10.0625 4.976563 9.9375 4.976563 9.8125 5 L 8 5 C 7.96875 5 7.9375 5 7.90625 5 C 7.355469 5.027344 6.925781 5.496094 6.953125 6.046875 C 6.980469 6.597656 7.449219 7.027344 8 7 L 9.09375 7 L 12.6875 47.5 C 12.8125 48.898438 14.003906 50 15.40625 50 L 34.59375 50 C 35.996094 50 37.1875 48.898438 37.3125 47.5 L 40.90625 7 L 42 7 C 42.359375 7.003906 42.695313 6.816406 42.878906 6.503906 C 43.058594 6.191406 43.058594 5.808594 42.878906 5.496094 C 42.695313 5.183594 42.359375 4.996094 42 5 L 32 5 L 32 3 C 32 1.355469 30.644531 0 29 0 Z M 21 2 L 29 2 C 29.5625 2 30 2.4375 30 3 L 30 5 L 20 5 L 20 3 C 20 2.4375 20.4375 2 21 2 Z M 11.09375 7 L 38.90625 7 L 35.3125 47.34375 C 35.28125 47.691406 34.910156 48 34.59375 48 L 15.40625 48 C 15.089844 48 14.71875 47.691406 14.6875 47.34375 Z M 18.90625 9.96875 C 18.863281 9.976563 18.820313 9.988281 18.78125 10 C 18.316406 10.105469 17.988281 10.523438 18 11 L 18 44 C 17.996094 44.359375 18.183594 44.695313 18.496094 44.878906 C 18.808594 45.058594 19.191406 45.058594 19.503906 44.878906 C 19.816406 44.695313 20.003906 44.359375 20 44 L 20 11 C 20.011719 10.710938 19.894531 10.433594 19.6875 10.238281 C 19.476563 10.039063 19.191406 9.941406 18.90625 9.96875 Z M 24.90625 9.96875 C 24.863281 9.976563 24.820313 9.988281 24.78125 10 C 24.316406 10.105469 23.988281 10.523438 24 11 L 24 44 C 23.996094 44.359375 24.183594 44.695313 24.496094 44.878906 C 24.808594 45.058594 25.191406 45.058594 25.503906 44.878906 C 25.816406 44.695313 26.003906 44.359375 26 44 L 26 11 C 26.011719 10.710938 25.894531 10.433594 25.6875 10.238281 C 25.476563 10.039063 25.191406 9.941406 24.90625 9.96875 Z M 30.90625 9.96875 C 30.863281 9.976563 30.820313 9.988281 30.78125 10 C 30.316406 10.105469 29.988281 10.523438 30 11 L 30 44 C 29.996094 44.359375 30.183594 44.695313 30.496094 44.878906 C 30.808594 45.058594 31.191406 45.058594 31.503906 44.878906 C 31.816406 44.695313 32.003906 44.359375 32 44 L 32 11 C 32.011719 10.710938 31.894531 10.433594 31.6875 10.238281 C 31.476563 10.039063 31.191406 9.941406 30.90625 9.96875 Z"/>
                    </svg>
                    <svg @click="saveOrder(order.id, order.status)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="0 0 24 24" width="24px" height="24px">
                        <polygon points="9,19.4 3.3,13.7 4.7,12.3 9,16.6 20.3,5.3 21.7,6.7 "/>
                    </svg>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div v-if="showModal" class="modal-overlay">
        <div class="modal">
            <h3>Подтверждение</h3>
            <p>Вы уверены, что хотите удалить заказ №{{ selectedOrderId }}?</p>
            <div class="modal-actions">
                <g-button @click="confirmDelete(selectedOrderId)" class="btn-del">Удалить</g-button>
                <g-button @click="openModal" class="btn-cancel">Отмена</g-button>
            </div>
        </div>
    </div>

</template>

<style scoped>
.text-center {
    text-align: center !important;
}

.column-center {
    display: flex;
    justify-content: center;
}

.orders-wrapper {
    margin: 30px 40px 60px 40px;
    overflow-x: auto;
}

.orders-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
}

.orders-table th,
.orders-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    font-size: 14px;
}

.orders-table th {
    background: #f8fafc;
    font-weight: 600;
    color: #374151;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.03em;
}

.orders-table tbody tr:hover {
    background: #f9fafb;
    transition: background 0.2s;
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.modal {
    background: white;
    padding: 20px;
    border-radius: 10px;
    max-width: 400px;
    width: 90%;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
}

.modal-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.btn-cancel {
    background-color: #777;
    color: #fff;
}
</style>
