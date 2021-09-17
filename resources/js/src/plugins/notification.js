import Vue from 'vue'
import Notifications from 'vue-notification'

Vue.use(Notifications);

Vue.prototype.$notification = {
    error(text) {
        Vue.prototype.$notify({
            text,
            type: 'error'
        })
    }
}
