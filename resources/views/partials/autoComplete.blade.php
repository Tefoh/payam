<script>
    var autoComplete = new Vue({
        el: '#app',

        data () {
            return {
                value: @if(! isset($usersGetByUrl)) null @else[@foreach($usersGetByUrl as $user)'{{ $user }}',@endforeach]@endif,
                options: [@foreach($userList as $user)'{{$user}}', @endforeach],
                friends: []
            }
        }
    })
</script>