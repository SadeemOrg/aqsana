<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <sl-vue-tree ref="tree"
                v-model="nodes"
                v-show="nodes.length"
                @input="updateValue"
                v-on-clickaway="clearSelected"
                class="mb-3">
                <template slot="title" slot-scope="{ node }">
                    {{ getTitle(node) }}
                </template>

                <template slot="sidebar" slot-scope="{ node }">
                    <span class="inline-flex items-center h-full px-1" @click="editNode(node)">
                        <icon type="edit" class="w-4"></icon>
                    </span>

                    <span class="inline-flex items-center h-full px-1 hidden" @click="deleteNode(node)">
                        <icon type="delete" class="w-4"></icon>
                    </span>
                </template>
            </sl-vue-tree>

            <button class="btn btn-default btn-white mr-3 hidden" @click.prevent="addNode()">
                {{ __('New') }}
            </button>

            <modal v-if="showModal" @modal-close="showModal = !showModal">
                <div class="card p-4 shodow" style="width: 900px">

                    <div v-if="action == 'add'" class="text-grey-darkest text-3xl font-light">
                        {{ __('New') }}
                    </div>
                    <div v-else class="text-grey-darkest text-3xl font-light">
                        {{ __('Edit') }}
                    </div>

                    <div class="mt-6">
                        <component v-for="field in fields"
                            :key="field.key"
                            :is="'form-' + field.component"
                            :ref="field.attribute"
                            :field="field"
                            :errors="errors">
                        </component>
                    </div>

                    <div class="text-right mt-6">
                        <a @click="showModal = !showModal" tabindex="0" class="btn btn-link dim cursor-pointer text-80 ml-auto mr-6">
                          Cancel
                        </a>
                        <button @click.prevent="submit()" class="btn btn-default btn-primary">
                            <template v-if="action == 'add'">{{ __('Create') }}</template>
                            <template v-else>{{ __('Update') }}</template>
                        </button>
                    </div>
                </div>
            </modal>
        </template>
    </default-field>
</template>

<script>
import SlVueTree from 'sl-vue-tree';
import { mixin as clickaway } from 'vue-clickaway'
import { FormField, HandlesValidationErrors } from 'laravel-nova'
export default {
    components: { SlVueTree },
    mixins: [HandlesValidationErrors,FormField, clickaway],

    data() {
        return {
            nodes: [],
            showModal: false,
            action: 'add',
            fields: null,
            nodePath: null,
        }
    },

    created() {
        this.fields = this.field.fields;
        this.nodes = this.field.value;
    },

    methods: {
        fill(formData) {
            this.clearSelected();
            formData.append(this.field.attribute, JSON.stringify(this.field.value));
        },

        addNode() {
            this.action = 'add';
            this.fields = this.clone(this.field.fields);
            this.showModal = true;
        },

        editNode(node) {
            this.action = 'edit';
            this.fields = this.clone(this.field.fields);
            this.nodePath = node.path;
            this.showModal = true;

            this.$nextTick(() => {
                this.fields.forEach(field => {
                    // this.$refs[field.attribute][0].setValue(node.data[field.attribute]);
                    this.$refs[field.attribute][0].value = node.data[field.attribute];
                });
            })
        },

        deleteNode(node) {
            this.$refs.tree.remove([node.path]);
        },

        submit() {
            if (this.action == 'add') {
                let data = {};

                this.fields.forEach(field => {
                    // data[field.attribute] = this.$refs[field.attribute][0].getValue();
                    data[field.attribute] = this.$refs[field.attribute][0].value;
                });

                this.nodes.push({
                    data: data,
                    children: [],
                });
            }

            else {
                let data = {};

                this.fields.forEach(field => {
                    data[field.attribute] = this.$refs[field.attribute][0].value;
                    // data[field.attribute] = field.value;
                });

                this.$refs.tree.updateNode(this.nodePath, {
                    data: data,
                })
            }

            this.showModal = false;
        },

        updateValue() {
            this.field.value = this.nodes;
        },

        getTitle(node) {
            return node.data[this.field.title] || 'untitled';
        },

        clearSelected() {
            this.clearNodeSelected(this.nodes);
        },

        clearNodeSelected(nodes) {
            nodes.forEach(node => {
                node.isSelected = false;
                if (node.children && node.children.length) {
                    this.clearNodeSelected(node.children);
                }
            });
        },

        clone(object) {
            return JSON.parse(JSON.stringify(object));
        },
    }
}
</script>

<style>
.sl-vue-tree {
    position: relative;
    cursor: default;
    -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
    -khtml-user-select: none; /* Konqueror HTML */
    -moz-user-select: none; /* Firefox */
    -ms-user-select: none; /* Internet Explorer/Edge */
    user-select: none;
}

.sl-vue-tree.sl-vue-tree-root {
    border: 1px solid rgb(9, 22, 29);
    background-color: rgb(9, 22, 29);
    color: rgba(255, 255, 255, 0.5);
    border-radius: 3px;
}

.sl-vue-tree-root > .sl-vue-tree-nodes-list {
    overflow: hidden;
    position: relative;
    padding-bottom: 4px;
}

.sl-vue-tree-selected > .sl-vue-tree-node-item {
    background-color: #13242d;
    color: white;
}

.sl-vue-tree-node-item:hover,
.sl-vue-tree-node-item.sl-vue-tree-cursor-hover {
    color: white;
}

.sl-vue-tree-node-item {
    position: relative;
    display: flex;
    flex-direction: row;

    padding-left: 10px;
    padding-right: 10px;
    line-height: 28px;
    border: 1px solid transparent;
}


.sl-vue-tree-node-item.sl-vue-tree-cursor-inside {
    border: 1px solid rgba(255, 255, 255, 0.5);
}

.sl-vue-tree-gap {
    width: 25px;
    min-height: 1px;
}

.sl-vue-tree-toggle {
    display: inline-block;
    text-align: left;
    width: 20px;
}

.sl-vue-tree-sidebar {
    margin-left: auto;
}

.sl-vue-tree-cursor {
    position: absolute;
    border: 1px solid rgba(255, 255, 255, 0.5);
    height: 1px;
    width: 100%;
}

.sl-vue-tree-drag-info {
    position: absolute;
    background-color: rgba(0,0,0,0.5);
    opacity: 0.5;
    margin-left: 20px;
    padding: 5px 10px;
}

.rtl .sl-vue-tree-sidebar {
    margin-left: 0;
    margin-right: auto;
}
</style>
