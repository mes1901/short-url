<template>
    <div class="card">
        <div class="card-header">
            Make your URL-link shorter
        </div>
        <div class="card-body">
            <form
                @submit.prevent="checkForm"
            >
                <div v-if="errors.length">
                    <ul>
                        <li
                            class="text-danger"
                            v-for="error in errors"
                        >
                            {{ error }}
                        </li>
                    </ul>
                </div>
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control"
                        v-model="hrefField"
                        placeholder="Enter URL-link"
                    >
                </div>
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control"
                        v-model="slugField"
                        placeholder="Enter your slug"
                    >
                </div>
                <button
                    class="btn btn-primary"
                    type="submit"
                >
                    Create Link
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    const urlRegex = /(https?:\/\/)?(www\.)?[-a-zA-Z0-9@:%._~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_.~#()?&//=]*)/;

    export default {
        name: 'AddUrlForm',
        data: function () {
            return {
                hrefField: '',
                slugField: '',
                errors: [],
            }
        },
        props: {
            newUrl: {
                type: String
            }
        },
        methods: {
            clearInputs() {
                this.hrefField = '';
                this.slugField = '';
            },
            checkForm() {
                this.errors = [];
                if (!this.hrefField) {
                    this.errors.push('Field Url-link is required');
                } else if (!urlRegex.test(this.hrefField)) {
                    this.errors.push('Url must be correct');
                }

                if (!this.slugField) {
                    this.errors.push('Field slug is required');
                } else if (this.slugField.length < 6 || this.slugField.length > 32) {
                    this.errors.push('Incorrect slug length');
                }

                if(!this.errors.length) {
                    axios.post('/urls', {
                        href: this.hrefField,
                        slug: this.slugField
                    }).then(response => {
                        this.$emit('newUrlAdded', response.data);
                        this.clearInputs();
                    }).catch(error => {
                        window.alert(error.response.data.message);
                    });
                }
            }
        }
    }
</script>