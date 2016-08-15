<!DOCTYPE html>
<html>

    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ url('semantic/semantic.css') }}" rel="stylesheet">

        <style>
            #title {
                font-size: 8em;
                font-weight: 100;
                font-family: 'Lato', sans-serif;

            }
            .vuetable {
                margin-top: 1em !important;
            }
        </style>


    </head>

    <body>
        <div id="app" class="ui container">
            <header id="title" class="ui header center aligned">@{{ message }}</header>
            <div class="ui center aligned">
                <div id="search" class="ui fluid icon input">
                    <input name="query" v-model="searchQuery" @keyup.enter="setFilter" placeholder="Search...">
                    <i class="search icon"></i>
                </div>
                <vuetable
                    v-ref:vuetable
                    :fields="fields"
                    api-url="api/employees"
                    data-path="data"
                    pagination-path=""
                    :append-params="moreParams"
                ></vuetable>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.9.3/vue-resource.js" charset="utf-8"></script>
        <script src="https://npmcdn.com/vuetable@1.3.1"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment-with-locales.min.js"></script>
        <script type="text/javascript">
        var columns = [
            {
                name: 'id',
                title: 'ID',
                titleClass: 'center aligned',
                dataClass: 'center aligned',
            },
            {
                name: 'name',
                title: 'Name'
            },
            {
                name: 'address',
                title: 'Address'
            },
            {
                name: 'created_at',
                title: 'Created',
                callback: 'formatDate|MMMM Do YYYY, h:mm:ss a'
            },
            {
                name: 'updated_at',
                title: 'Updated',
                callback: 'formatDate|MMMM Do YYYY, h:mm:ss a'
            }
        ]
        new Vue({
            el: '#app',
            data: {
                fields: columns,
                message: 'Laravel 5 + Vue.js',
                searchQuery: '',
                moreParams:[]
            },
            methods: {
                formatDate: function(value, fmt) {
                    if (value == null) return ''
                    fmt = (typeof fmt == 'undefined') ? 'D MMM YYYY' : fmt
                    return moment(value).format(fmt)
                },
                setFilter: function() {
                    this.moreParams = [
                        'filter=' + this.searchQuery
                    ]
                    this.$nextTick(function() {
                        this.$broadcast('vuetable:refresh')
                    })
                },

                highlight: function(needle, haystack) {
                    return haystack.replace(
                        new RegExp('(' + this.preg_quote(needle) + ')', 'ig'),
                        '<span class="highlight">$1</span>'
                    )
                }
            },
            events:{
                'vuetable:load-success': function(response) {
                    var data = response.data.data
                    if (this.searchQuery !== '') {
                        for (n in data) {
                            data[n].name = this.highlight(this.searchQuery, data[n].name)
                            data[n].address = this.highlight(this.searchQuery, data[n].address)
                        }
                    }
                }
            }
        })
        </script>
    </body>

</html>
