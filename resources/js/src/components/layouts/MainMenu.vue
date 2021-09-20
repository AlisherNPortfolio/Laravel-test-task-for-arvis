<template>
    <div class="navbar-nav">
        <template v-for="(menu, idx) in menuItems">
            <router-link
            :key="idx"
            :to="menu.link"
            class="nav-item nav-link"
            >{{ menu.name }}</router-link>
        </template>
    </div>
</template>
<script>
export default {
    name: 'main-menu',
    data() {
        return {
            menuItems: [
                { name: 'Home', link: '/' },
                { name: 'Expenditures', link: '/expenditures' },
                { name: 'Measures', link: '/measures' },
                { name: 'Products', link: '/products' }
            ]
        }
    }
}
</script>
