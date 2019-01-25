<script>
    var autoComplete = new Vue({
        el: '#app',

        data () {
            return {
                value: null,
                options: [@foreach($userList as $user)'{{$user}}', @endforeach]
            }
        }
    })
</script>