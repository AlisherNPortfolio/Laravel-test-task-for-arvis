<template>
    <v-container>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>
            <v-row>
                <v-col cols="12" md="3">
                        <v-autocomplete
                            v-model="form.measure_id"
                            :items="measures"
                            :rules="idRule"
                            dense
                            filled
                            label="Measure"
                            required
                            item-value="id"
                            item-text="name"
                        ></v-autocomplete>
                </v-col>
                <v-col cols="12" md="3">
                        <v-autocomplete
                            v-model="form.product_id"
                            :items="products"
                            :rules="idRule"
                            dense
                            filled
                            label="Product"
                            required
                            item-value="id"
                            item-text="name"
                        ></v-autocomplete>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="form.quantity"
                        :rules="numberRule"
                        label="Quantity"
                        required
                        ></v-text-field>
                </v-col>
                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="form.price"
                        :rules="numberRule"
                        label="Price"
                        required
                        ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="6">
                    <v-row>
                        <v-col align="end">
                            <v-btn
                                depressed
                                color="secondary"
                                @click="backHome()"
                                >
                                Back
                            </v-btn>
                            <v-btn
                                depressed
                                color="primary"
                                @click="send()"
                                >
                                Save
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>
<script>

export default {
    name: 'AddEditMeasure',
    data() {
        return {
            form: {
                measure_id: null,
                product_id: null,
                price: null,
                quantity: null
            },
            products: [],
            measures: [],
            nameRules: [
                v => !!v || 'Measure name is required',
                v => (v && v.length <= 15) || 'Measure name must be less than 15 characters',
            ],
            idRule: [
                v => !!v || 'Field is required'
            ],
            numberRule: [
                v => !!v || 'Field is required',
            ],
            valid: true,
            isEdit: false,
            id: null
        }
    },
    created() {
        this.isEditPage();
        this.getExpenditureById();
        this.getMeasures();
        this.getProducts();
    },
    methods: {
        isEditPage() {
            if (this.$route.params.id) {
                this.isEdit = true;
                this.id = this.$route.params.id;
            }
        },
        getExpenditureById() {
            if (this.isEdit) {
                this.$api.get(`expenditure/${this.id}`)
                .then(response => {
                    this.form = response.data;
                }, error => console.log(error))
            }
        },
        getProducts() {
            this.$api.get('products')
            .then(response => {
                this.products = response.data;
            }, error => console.log(error))
        },
        getMeasures() {
            this.$api.get('measures')
            .then(response => {
                this.measures = response.data;
            }, error => console.log(error))
        },
        send() {
            if (!this.isEdit) {
                this.add();
            } else {
                this.update()
            }
        },
        add() {
            this.$api.post('expenditure', this.form)
            .then(response => {
                const res = response.data;
                if (res.success) {
                    this.$notify({type: 'success', title: 'Expenditure item added successfully!'});
                    this.backHome();
                } else {
                    this.$notify({type: 'error', title: `Code: ${res.code}`, text: res.message})
                }
            }, error => console.log(error))
        },
        update() {
            this.$api.put(`expenditure/${this.id}`, this.form)
            .then(response => {
                const res = response.data;
                if (res.success) {
                    this.$notify({type: 'success', title: 'Expenditure item updated successfully!'});
                    this.backHome();
                } else {
                    this.$notify({type: 'error', title: `Code: ${res.code}`, text: res.message})
                }
            }, error => console.log(error))
        },
        backHome() {
            this.$router.go(-1);
        }
    },
}
</script>
