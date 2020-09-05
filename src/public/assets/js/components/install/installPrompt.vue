<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>{{ $t('main.Select User as Administrator') }} </label>
                    <multiselect
                            v-model="prompdata.user"
                            :options="options"
                            @search-change="get_users"
                            label="name" track-by="id"
                    ></multiselect>
                    <template v-if="value">
                        <input type="hidden" class="form-control" v-model="value.id">
                    </template>
                    <template v-else>
                        <input type="hidden" class="form-control" value="">
                    </template>
                    <div class="desc">{{ $t('main.Selected user will have the administrative access for the system, which means he will access to all the features') }}</div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-success" @click="install" :value="$t('main.Install')">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect';
    import 'vue-multiselect/dist/vue-multiselect.min.css'
    import axios from 'axios';

    var searchTimeOut;
    export default {
        name: 'installPrompt',
        components:  {
            Multiselect
        },
        props: {
            routes: {
                type: Object
            }
        },
        data: function () {
            return {
                test2: 'This is test 2',
                options: [],
                value: null,
                prompdata: {
                    user: null
                }
            }
        },
        methods: {
            get_users(searchQuery, id) {
                if( searchQuery == '' ) return;
                clearTimeout(searchTimeOut);
                let _this = this;
                searchTimeOut = setTimeout( function () {
                    axios.get(_this.routes.get_users, {
                        params: {
                            user_query: searchQuery
                        }
                    })
                        .then(function (res) {
                            _this.options = res.data;
                        });
                },1000);
            },
            install() {
                let _this = this;
                axios.post(_this.routes.install,{
                    promptdata: _this.prompdata
                })
                    .then(function (res) {
                        if( res.data.success ) {

                        }
                    })
            }
        }
    };
</script>