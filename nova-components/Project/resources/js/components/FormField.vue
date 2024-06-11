<template>
    <default-field
        :field="field"
        :errors="errors"
        :show-help-text="showHelpText"
    >
        <template slot="field">
            <p>القطاع</p>
            <select
                class="w-full form-control form-input form-input-bordered mt-4"
                name="LeaveType"
                @change="onChange($event)"
                v-model="key"
            >
               <option  :value="0">
                    مخرجات عامة</option
                >
                <option v-for="item in Sectors" :key="item.sector_id" :value="item.sector_id">
                    {{ item.Sector }}</option
                >
            </select>
            <p  v-if="projectshow" class="mt-4">المشروع</p>
            <!-- <select  @change="onChange($event)"
                class="w-full form-control form-input form-input-bordered mt-4"
                name="LeaveTypde"
            >
                <option v-for="item in Sectors" :key="item.id" :value="item.id">
                    {{ item.id }}</option
                >
            </select> -->
            <select
            v-if="projectshow"
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
            this.value = this.field.value || "";
        },

        onChange(event) {
            axios
                .post("/first", {
                    project_id: event.target.value
                })
                .then(response => {
                    this.items = response.data;
                                 });
                              if ( event.target.value != 0) {
                          this.projectshow = true;
                              }
                              else{
                                 this.projectshow = false;
                              }



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
            axios.post("/SectorsPill").then(response => {
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
