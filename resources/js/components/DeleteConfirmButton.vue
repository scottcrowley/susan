<template>
    <div>
        <div v-show="showModal" class="fixed flex bg-smoke-darker pin z-40 overflow-auto" @click.self="close">
            <div class="relative bg-white w-full max-w-sm m-auto mt-32 flex-col rounded flex z-50" ref="messageDiv">
                <div class="bg-blue p-3 rounded-t">
                    <p class="font-medium text-lg text-white">
                        <slot name="title"></slot>
                    </p>
                    <span class="h-6 w-6 absolute pin-t pin-b pin-r mt-2 mr-2" @click="close">
                        <svg class="fill-current text-white hover:text-grey-darkest" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                        </svg>
                    </span>
                </div>
                <div class="px-6 py-8">
                    <p class="leading-normal text-grey-darker">
                        <slot></slot>
                    </p>
                </div>
                <div class="flex w-full px-6 py-4 justify-end">
                    <button class="btn mr-3" autofocus @click="doAction('cancel')">No</button>
                    <button class="btn is-blue" @click="doAction('delete')">Yes</button>
                </div>
            </div>
        </div>

        <button :class="classList" v-text="label" @click="showModal = true"></button>
    </div>
</template>

<script>
    export default {
        props: ['classes', 'label', 'dataSet'],

        data() {
            return {
                classList: this.classes,
                showModal: false,
                data: this.dataSet
            }
        },

        methods: {
            close() {
                this.showModal = false;
            },

            doAction(action) {
                this.close();
                if (action == 'delete') {
                    this.doDelete(); 
                }
            },

            doDelete() {
                axios.delete('/admin/cards/' + this.data.id)
                    .then(function(response) {
                        if (response.status == 204) {
                            window.location.href = '/admin/cards';
                        }
                    })
                    .catch(function(error) {
                        if (error.response) {
                            // The request was made and the server responded with a status code
                            // that falls out of the range of 2xx
                            console.log('Data', error.response.data);
                            console.log('Status', error.response.status);
                            console.log('Headers', error.response.headers);
                        } else if (error.request) {
                            // The request was made but no response was received
                            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                            // http.ClientRequest in node.js
                            console.log('Request', error.request);
                        } else {
                            // Something happened in setting up the request that triggered an Error
                            console.log('Error', error.message);
                        }
                        console.log('Config', error.config);
                    });
            }
        }
    }
</script>