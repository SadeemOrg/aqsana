<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">
            <div>
                <table>
                    <tr>
                        <th>اسم الباص</th>
                        <th>عدد المقاعد</th>
                        <th> عدد المقاعد المحجوزة</th>
                        <th> عدد المقاعد المتبقية</th>


                    </tr>


                    <tr v-for="item in Bus " :key="item.id">
                        <td>{{ item.bus_number }}</td>
                        <td>{{ item.number_of_seats }}</td>
                        <td>{{ item.number_of_seats - item.number_of_people }}</td>
                        <td>{{ item.number_of_people }}</td>

                    </tr>
                </table>
            </div>
        </template>
    </default-field>

</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    data() {
        return {
            Bus: [],
        };
    },
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        getBus: function () {
            axios.post("/getBus", {
                id: this.value,

            }).then(response => {
                this.Bus = response.data;
                console.log("sss", this.Bus);
            });

        },
        setInitialValue() {
            this.value = this.field.value || '',
                this.getBus();
        },

        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },
    },
    // beforeMount() {
    // },
}
</script>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #dddddd;
    text-align: right;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
