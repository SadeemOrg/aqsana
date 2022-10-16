<template>
    <default-field
        :field="field"
        :errors="errors"
        :show-help-text="showHelpText"
    >
        <template slot="field">
<p > القطاع  </p>
            <select
                class="w-full form-control form-input form-input-bordered mt-4 mb-4 "
                name="LeaveType"
                @change="onChange($event)"
                v-model="key"
            >
             <option v-for="item in Sectors" :key="item.id" :value="item.id">
                    {{ item.text}}</option
                >
            </select>
            <p class=""> المشروع  </p>
  <!-- <select  @change="onChange($event)"
                class="w-full form-control form-input form-input-bordered mt-4"
                name="LeaveTypde"
            >
                <option v-for="item in Sectors" :key="item.id" :value="item.id">
                    {{ item.id }}</option
                >
            </select> -->
            <select
                :id="field.name"
                v-model="value"
                class="w-full form-control form-input form-input-bordered mt-4"
                name="LeaveTypde"
            >
                <option
                    v-for="item in items"
                    :key="item.project_type"
                    :value="item.id"
                >
                    {{ item.project_name }}</option
                >
            </select>

        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";

export default {
    data() {
        return {
            items: [{ message: "Foo" }, { message: "Bar" }],
            Sectors:  [{ id: "Foo" }, { id: "Bar" }],
        };
    },

    mixins: [FormField, HandlesValidationErrors],

    props: ["resourceName", "resourceId", "field"],

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || "";
        },

        onChange(event) {
            axios
                .post("/first", {
                    project_id: event.target.value
                })
                .then(response => {
                    //  alert(response.data),axios
                    this.items = response.data;
                });
        },
        Sectors: function() {
            // console.log("dddjdskk");
            // alert("dd");
            //    alert("dd");
            // axios.post("/Sectors").then(response => {
            //     this.Sectors = response.data;
            // });
        },

        getUnits: function() {
            // alert("ss");
            axios.post("/Sectors").then(response => {
                // alert(this.Sectors);
                this.Sectors = response.data;
            });
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || "");
        }
    },
    // created() {
    //     this.Sectors();
    // },
    beforeMount() {
        this.getUnits();
    }
};
</script>
