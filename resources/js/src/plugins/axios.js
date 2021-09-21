import Vue from 'vue'
import axios from 'axios';

const URL_BASE = process.env.MIX_BASE_URL;
const instance = axios.create({
    baseURL: URL_BASE,
    headers: {
        common: {
            'X-Requested-With': 'XMLHttpRequest'
        },
    },
});

Vue.prototype.$api = instance;
