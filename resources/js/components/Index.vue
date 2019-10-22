<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col col-8">
                <AddUrlForm
                    @newUrlAdded="onChange"
                />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-8">
                <UrlList
                    :newUrl="newUrl"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import AddUrlForm from '../components/AddUrlForm.vue';
    import UrlList from '../components/UrlList.vue';

    export default {
        components: {
            AddUrlForm,
            UrlList,
        },
        data: function () {
            return {
                hrefField: '',
                slugField: '',
                newUrl: null
            }
        },
        methods: {
            onChange(url) {
                this.newUrl = url.data;
            }
        }
    }
</script>