<script type="text/javascript" src="{{ asset('js/vue.min.js') }}"></script>
<script type="text/javascript">
    (function () {
        var _ = {};
        // refer: https://davidwalsh.name/javascript-debounce-function
        _.debounce = function debounce(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this, args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        };

        var app = new Vue({
            el: '#discussion-title',
            data: {
                title: '{{ $discussion->title or old('title') }}',
                translation: '{{ $discussion->slug or old('slug') }}'
            },
            created: function () {
                // this.translate();
            },
            methods: {
                translate: _.debounce(function translate() {
                    var self = this;
                    var q =  self.title;
                    if (!q) {
                        self.translation = '';
                        return ;
                    }
                    $.getJSON('https://fanyi.youdao.com/openapi.do?callback=?&keyfrom=xxxfyj&key=744969857&type=data&doctype=jsonp&version=1.1&q=' + q)
                        .done(function (data) {
                            if (data.errorCode == 0) {
                                self.translation = data.translation[0];
                                return ;
                            }

                            switch (data.errorCode) {
                                case 20:
                                    self.translation = '（要翻译的文本过长，不能超过200个字符）';
                                    break;
                                case 30:
                                    self.translation = '（无法进行有效的翻译）';
                                    break;
                                case 40:
                                    self.translation = '（不支持的语言类型）';
                                    break;
                                case 50:
                                    self.translation = '（无效的key）';
                                    break;
                                case 60:
                                    self.translation = '（无词典结果，仅在获取词典结果生效）';
                                    break;
                                default:
                                    self.translation = '（发生未知错误 ;(）';
                            }
                        });
                }, 250)
            },
            watch: {
                title: function (val, oldVal) {
                    this.translate();
                }
            }
        })

    })();
</script>