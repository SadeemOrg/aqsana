<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">

            <input type="date" v-model="selectedDate" @change="onChange"
                class="w-full form-control form-input form-input-bordered" />
            <div class="flex gap-x-6 items-center ">
                <p class="pt-3"> المشروع</p>
                <v-select dir="rtl" :options="Sectors" label="project_name" v-model="value2" :reduce="item => item.id"
                    class="w-full  border-md  mt-4 pt-3" :clearable="false" :searchable="true" >
                    <template #no-options>
                        <span>عذرًا، لا توجد خيارات مطابقة</span>
                    </template></v-select>
            </div>



        </template>
    </default-field>
</template>


<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

export default {
    components: {
        vSelect
    },
    data() {
        return {
            projectshow: false,
            items: [],
            Sectors: [],
            selectedDate: null,
            value2: null,
            noOptionsMessage: "sssss"
        };
    },

    mixins: [FormField, HandlesValidationErrors],

    props: ["resourceName", "resourceId", "field"],

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            if (this.field.value['key2'] === null) {
                let today = new Date();
                let year = today.getFullYear();
                let month = (today.getMonth() + 1).toString().padStart(2, '0'); // Months are zero indexed
                let day = today.getDate().toString().padStart(2, '0');
                this.field.value['key2'] = today;
            }
            const dateObject = new Date(this.field.value['key2']);
            // Format the Date object to the desired string
            this.selectedDate = dateObject.toISOString().split('T')[0] || '2024-01-1';
            this.onChange22(this.selectedDate);
        },

        onChange(event) {
            const selectedYear = new Date(event.target.value).getFullYear();
            axios
                .post("/get-project", {
                    Year: selectedYear
                })
                .then(response => {
                    this.Sectors = response.data;
                });

            if (this.Sectors.value != 0) {
                this.projectshow = true;
            } else {
                this.projectshow = false;
            }
        },

        onChange22(event) {
            const selectedYear = new Date(event).getFullYear();
            axios
                .post("/get-project", {
                    Year: selectedYear
                })
                .then(response => {
                    this.Sectors = response.data;
                    this.value2 = this.field.value['key1'] || "";
                });
            if (this.Sectors.value != 0) {
                this.projectshow = true;
            } else {
                this.projectshow = false;
            }
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            const data = {
                key1: this.selectedDate,
                key2: this.value2
            };
            formData.append(this.field.attribute, JSON.stringify(data) || '')
        },
    },

    beforeMount() {
        this.setInitialValue();
    }
};
</script>