<template>
<v-container>
        <v-row>
            <v-col cols="12" md="4">
                <router-link to="/expenditures/create">
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
            <v-col cols="12" md="6"></v-col>
            <v-col cols="12" md="2" align="end">
                <v-autocomplete
                    v-model="query.product_id"
                    :items="products"
                    dense
                    filled
                    label="Product"
                    required
                    item-value="id"
                    item-text="name"
                    :clearable="true"
                    @click:clear="load"
                    @change="load"
                ></v-autocomplete>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-data-table
                    :headers="headers"
                    :items="expenditures"
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
    name: 'expenditure-list',
    data() {
        return {
            expenditures: [],
            query: {
                product_id: null,
                page: 1
            },
            searchInput: null,
            headers: [
                { text: 'ID', value: 'id' },
                { text: 'Product', value: 'product.name' },
                { text: 'Quantity', value: 'quantity' },
                { text: 'Measure', value: 'measure.name' },
                { text: 'Price', value: 'price' },
                { text: 'Action', value: 'action', width: '5%'}
            ],
            products: [],
            total: 0
        }
    },
    components: {Pagination},
    created() {
        this.load();
        this.getProducts();
    },
    methods: {
        load() {
            if (this.query.product_id) {
                this.query.page = 1;
            }

            this.$api.get('expenditure', {params: this.query})
            .then(response => {
                this.expenditures = response.data.data;
                this.total = response.data.total;

            }, error => this.$notify({type: 'error', text: error}));
        },
        edit(id) {
            this.$router.push({name: 'expenditure-update', params: {id: id}});
        },
        remove(id) {
            this.$api.delete(`expenditure/${id}`)
            .then(response => {
                if (response.data) {
                    this.$notify({type: 'success', text: 'Deleted successfully!'});
                    this.load();
                } else {
                    this.$notify({type: 'error', title: response.data.message, text: response.data.details})
                }

            }, error => this.$notify({type: 'error', text: error}));
        },
        getProducts() {
            this.$api.get('products')
            .then(response => {
                this.products = response.data;
            }, error => console.log(error))
        },
        pagination(page) {
            this.query.page = page;
            this.load();
        }
    }
}
</script>
