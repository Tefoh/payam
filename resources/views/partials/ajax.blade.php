<script>
    var ajax = new Vue({
        el: '#app',
        data() {
            return {
                checkedMessages: [],
                stared: null,
                starClass: [],
                labels: '',
                labelClass: ''
            }
        },
        methods: {
            star(id) {
                this.stared = id;
                if ($('#' + id + ' a').hasClass('starred')) {
                    this.starClass.pop(id);
                    axios.post('{{ route('star') }}', {
                        data: this.stared
                    })
                } else {
                    this.starClass.push(id);
                    axios.post('{{ route('stared') }}', {
                        data: this.stared
                    })
                }
            },
            label(label) {
                this.labels = label;

                axios.post('{{ route('ajax') }}', {
                    data: this.checkedMessages,
                    label: this.labels
                }).then(response => {
                    let list = this.checkedMessages;
                    var labelClass = this.labels;
                    $.each(list, function (id, labels) {
                        if (labelClass == 'important') {
                            $('#label-' + labels).children().html('مهم');
                            $('#label-' + labels).children().removeClass('label-warning').removeClass('label-success').removeClass('label-danger');
                            $('#label-' + labels).children().addClass('label-primary');
                        } else if (labelClass == 'work') {
                            $('#label-' + labels).children().html('کاری');
                            $('#label-' + labels).children().removeClass('label-primary').removeClass('label-warning').removeClass('label-danger');
                            $('#label-' + labels).children().addClass('label-success');
                        } else if (labelClass == 'personal') {
                            $('#label-' + labels).children().html('شخصی');
                            $('#label-' + labels).children().removeClass('label-primary').removeClass('label-success').removeClass('label-warning');
                            $('#label-' + labels).children().addClass('label-danger');
                        } else if (labelClass == 'document') {
                            $('#label-' + labels).children().html('سند');
                            $('#label-' + labels).children().removeClass('label-primary').removeClass('label-success').removeClass('label-danger');
                            $('#label-' + labels).children().addClass('label-warning');
                        }
                    })
                })

            },
            read() {
                axios.post('{{ route('ajax') }}', {
                    read: this.checkedMessages
                }).then(response => {
                    let list = this.checkedMessages;
                    $.each(list, function (id, reads) {
                        $('#mail-' + reads).removeClass('unread');
                    })
                })
            },
            deleteMessage() {
                axios.post('{{ route('ajax') }}', {
                    deleting: this.checkedMessages
                }).then(response => {
                    let list = this.checkedMessages;
                    $.each(list, function (id, deletes) {
                        $('#mail-' + deletes).addClass('hidden');
                    })
                })
            },
            unread() {
                axios.post('{{ route('ajax') }}', {
                    unread: this.checkedMessages
                }).then(response => {
                    let list = this.checkedMessages;
                    $.each(list, function (id, unreads) {
                        $('#mail-' + unreads).addClass('unread');
                    })
                })
            },
            undo() {
                axios.post('{{ route('ajax') }}', {
                    undo: this.checkedMessages
                }).then(response => {
                    let list = this.checkedMessages;
                    $.each(list, function (id, undo) {
                        $('#mail-' + undo).addClass('hidden');
                    })
                })
            },
            drop() {
                axios.post('{{ route('ajax') }}', {
                    drop: this.checkedMessages
                }).then(response => {
                    let list = this.checkedMessages;
                    $.each(list, function (id, drop) {
                        $('#mail-' + drop).addClass('hidden');
                    })
                })
            }
        },
    })
</script>