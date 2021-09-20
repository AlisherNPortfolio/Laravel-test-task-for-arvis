<template>
    <v-container>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation>
            <v-row>
                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="form.name"
                        :counter="15"
                        :rules="nameRules"
                        label="Measure name"
                        required
                        ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="3">
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
                name: null,
            },
            nameRules: [
                v => !!v || 'Measure name is required',
                v => (v && v.length <= 15) || 'Measure name must be less than 15 characters',
            ],
            valid: true,
            isEdit: false,
            id: null
        }
    },
    created() {
        this.isEditPage();
        this.getMeasureById();
    },
    methods: {
        isEditPage() {
            if (this.$route.params.id) {
                this.isEdit = true;
                this.id = this.$route.params.id;
            }
        },
        getMeasureById() {
            if (this.isEdit) {
                this.$api.get(`measure/${this.id}`)
                .then(response => {
                    this.form = response.data;
                }, error => console.log(error))
            }
        },
        send() {
            if (!this.isEdit) {
                this.add();
            } else {
                this.update()
            }
        },
        add() {
            this.$api.post('measure', this.form)
            .then(response => {
                const res = response.data;
                if (res.success) {
                    this.$notify({type: 'success', title: 'Measure item added successfully!'});
                    this.backHome();
                } else {
                    this.$notify({type: 'error', title: `Code: ${res.code}`, text: res.message})
                }
            }, error => console.log(error))
        },
        update() {
            this.$api.put(`measure/${this.id}`, this.form)
            .then(response => {
                const res = response.data;
                if (res.success) {
                    this.$notify({type: 'success', title: 'Measure item updated successfully!'});
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
