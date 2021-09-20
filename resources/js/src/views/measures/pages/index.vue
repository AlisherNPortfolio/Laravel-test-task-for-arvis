<template>
<v-container>
        <v-row>
            <v-col cols="12" md="4">
                <router-link to="/measures/create">
                    <v-btn
                        class="mx-2"
                        small
                        color="secondary"
                    >
                        <v-icon dark>
                            mdi-plus
                        </v-icon>
                        Add
                    </v-btn>
                </router-link>
            </v-col>
            <v-col cols="12" md="8">

            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-data-table
                    :headers="headers"
                    :items="measures"
                    :hide-default-footer="true"
                    class="elevation-1"
                    >
                    <template v-slot:[`item.action`]="{ item }">
                        <v-icon
                            small
                            class="mr-2"
                            @click="edit(item.id)">
                                mdi-pencil
                        </v-icon>
                        <v-icon
                            small
                            @click="remove(item.id)">
                                mdi-delete
                        </v-icon>
                    </template>
                </v-data-table>
                <pagination
                    :total="this.total"
                    :perPage="10"
                    @paginate="pagination($event)">
                </pagination>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import Pagination from './../../../components/shared-components/Pagination';

export default {
    name: 'measures-list',
    data() {
        return {
            measures: [],
            query: {
                page: 1
            },
            headers: [
                { text: 'ID', value: 'id' },
                { text: 'Name', value: 'name' },
                { text: 'Action', value: 'action', width: '5%'}
            ],
            total: 0
        }
    },
    components: {Pagination},
    created() {
        this.load();
    },
    methods: {
        load() {
            this.$api.get('measure', {params: this.query})
            .then(response => {
                this.measures = response.data.data;
                this.total = response.data.total;

            }, error => this.$notify({type: 'error', text: error}));
        },
        edit(id) {
            this.$router.push({name: 'measure-update', params: {id: id}});
        },
        remove(id) {
            this.$api.delete(`measure/${id}`)
            .then(response => {
                if (response.data) {
                    this.$notify({type: 'success', text: 'Deleted successfully!'});
                    this.load();
                } else {
                    this.$notify({type: 'error', title: response.data.message, text: response.data.details})
                }

            }, error => this.$notify({type: 'error', text: error}));
        },
        pagination(page) {
            this.query.page = page;
            this.load();
        }
    }
}
</script>
