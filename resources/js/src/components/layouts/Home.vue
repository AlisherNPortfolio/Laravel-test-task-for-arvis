<template>
    <v-app>
        <v-main>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse">
                    <main-menu/>
                </div>
            </nav>
            <router-view></router-view>
        </v-main>
        <notification />
    </v-app>
</template>
<script>
import Notification from './../shared-components/Notification';
import MainMenu from './MainMenu';

export default {
    name: 'Home',
    components: {Notification, MainMenu}
}
</script>
