<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <select
                :id="field.attribute"
                v-model="value.resource"
                class="w-full form-control form-select"
                :class="errorClasses"
                @change="typeChanged"
            >
                <option value="" selected>{{ __('Choose an option') }}</option>

                <option v-for="resource in field.resources" :value="resource.resource">
                    {{ resource.label }}
                </option>
                <option value="external">{{ __('External Link') }}</option>
            </select>

            <div v-if="value.resource && value.resource != 'external'" class="mt-3">
                <multiselect
                    v-model="selected"
                    :options="resources"
                    label="display"
                    track-by="display"
                    @input="updateSelected()"
                />
            </div>

            <div v-if="value.resource && value.resource == 'external'" class="mt-3">
                <input
                    type="text"
                    class="w-full form-control form-input form-input-bordered"
                    v-model="value.id">
            </div>
        </template>
    </default-field>
</template>

<script>
import Multiselect from 'vue-multiselect'
import { FormField, HandlesValidationErrors } from 'laravel-nova'
export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    components: { Multiselect },


    data() {
        return {
            resources: [],
            type: '',
            selected: null,
            external: '',
            inited: false,
        }
    },


    mounted() {
        this.$nextTick(() => {
            this.type = this.value.resource || '';

            if(this.value.id) {
                this.selected = {
                    value: this.value.id
                };
                this.typeChanged();
            }

        })
    },

    methods: {
        typeChanged() {
            if(this.value.resource && this.value.resource != 'external') {
                let res = this.field.resources.find(resource => resource.resource == this.value.resource);
                this.resources = [];
                if (res.key) {
                    Nova.request().get('/nova-vendor/link/' + res.key).then(({ data }) => {
                        this.resources = data;
                        if (this.selected) {
                            let find = data.find(resource => resource.value == this.selected.value);
                            if (find) {this.selected = find};
                        }
                    })
                }
            }
        },

        fill(formData) {
            let value = JSON.stringify(this.value);
            formData.append(this.field.attribute, value)
        },

        updateSelected() {
            if(this.selected)
                this.value = {
                    id: this.selected.value,
                    resource: this.value.resource,
                };
        },
    },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
