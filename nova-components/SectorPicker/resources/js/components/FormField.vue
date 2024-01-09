<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">

            <input type="date" v-model="selectedDate" @change="onChange"
             class="w-full form-control form-input form-input-bordered"
                />
            <select v-if="projectshow"
                class="w-full form-control form-input form-input-bordered mt-4"
                name="LeaveType"
                v-model="value2"
            >
            <option v-for="item in Sectors" :key="item.id" :value="item.id">
                {{ item.text }}</option>

            </select>


        </template>
    </default-field>
</template>


<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";

export default {
    data() {
        return {

             projectshow: false,
            items: [],
            Sectors: []
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
                this.field.value['key2'] = '2024-01-01';
            }
            const dateObject = new Date(this.field.value['key2']);
            // Format the Date object to the desired string
            this.selectedDate = dateObject.toISOString().split('T')[0] || '2024-01-1';
            this.onChange22(this.selectedDate);

        },

        onChange(event) {
            const selectedYear = new Date(event.target.value).getFullYear();

            axios
                .post("/get-sectors", {
                    Year: selectedYear
                })
                .then(response => {
                    this.Sectors = response.data;


                    console.log(this.Sectors);

                });

                if (this.Sectors.value != 0) {
                this.projectshow = true;
            }
            else {
                this.projectshow = false;
            }



        },
        onChange22(event) {
            const selectedYear = new Date(event).getFullYear();
              axios
                .post("/get-sectors", {
                    Year: selectedYear
                })
                .then(response => {
                    this.Sectors = response.data;

                    this.value2 = this.field.value['key1'] || "";

                    console.log(this.Sectors);

                });

                if (this.Sectors.value != 0) {
                this.projectshow = true;
            }
            else {
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
            formData.append(this.field.attribute,  JSON.stringify(data) || '')
        },
    },
    // created() {
    //     this.Sectors();
    // },
    beforeMount() {
    }
};
</script>

