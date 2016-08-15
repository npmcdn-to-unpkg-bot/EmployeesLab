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
        </style>


    </head>

    <body>
        <div id="app" class="ui container">
            <header id="title" class="ui header center aligned">@{{ message }}</header>
            <div class="ui center aligned">
                <div id="search" class="ui fluid icon input">
                    <input name="query" v-model="searchQuery" placeholder="Search...">
                    <i class="search icon"></i>
                </div>
                <vuetable
                    :fields="fields"
                    api-url="api/employees"
                    data-path="data"
                    pagination-path=""
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
                message: 'Laravel 5 + Vue.js'
            },
            methods: {
                formatDate: function(value,fmt) {
                    if (value == null) return ''
                    fmt = (typeof fmt == 'undefined') ? 'D MMM YYYY' : fmt
                    return moment(value).format(fmt)
                }
            }
        })
        </script>
    </body>

</html>
