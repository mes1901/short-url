<template>
    <div>
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <p class="h4">Your URL-links</p>
                </tr>
            </thead>
            <tbody>
                <tr v-for="url, index in urlList">
                    <td>
                        <p>
                            <a
                                class="font-weight-bold h5"
                                :href="url.short_href"
                                target="_blank"
                            >
                                {{ url.short_href }}
                            </a>
                        </p>
                        <p class="m-0">{{ url.href }}</p>
                        <p class="small m-0">{{ url.date }}</p>
                    </td>
                    <td class="d-flex justify-content-end">
                        <button
                            class="btn btn-success mr-3"
                            @click="showStat(url.id)"
                        >
                            Statistic
                        </button>
                        <button
                                class="btn btn-danger mr-3"
                                @click="deleteUrl(url.id, index)"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <UrlStatistic
                v-show="modalShow"
                @close="modalShow=false"
        >
            <h5 slot="stat">Redirects count: {{redirects}}</h5>
        </UrlStatistic>
    </div>
</template>

<script>
    import AddUrlForm from '../components/AddUrlForm.vue';
    import UrlStatistic from '../components/UrlStatistic.vue';

    export default {
        name: 'UrlList',
        components: {
            AddUrlForm,
            UrlStatistic,
        },

        data: function () {
            return {
                urlList: [],
                redirects: null,
                modalShow: false,
            }
        },
        props: {
            newUrl: {
                type: Object
            }
        },
        watch: {
            newUrl: function(newVal) {
                this.urlList.unshift(newVal);
            }
        },
        mounted() {
            axios.get('/urls')
                .then(response => {
                    this.urlList = response.data.reverse();
                }).catch(error => {
                    window.alert(error.response.data.message);
            })
        },
        methods: {
            deleteUrl(id, index) {
                if(confirm("Do you really want to remove link?")) {
                    axios.delete('/urls/' + id)
                        .then(() => {
                            this.urlList.splice(index, 1);
                        }).catch(error => {
                            window.alert(error.response.data.message);
                    });
                }
            },
            showStat(id) {
                axios.get('urls/stat/' + id)
                    .then(response => {
                        this.redirects = response.data;
                        this.modalShow = true;
                    }).catch(error => {
                        window.alert(error.response.data.message);
                });
            },
        }
    }
</script>