@extends('layouts.blank')

@section('title', '全站搜索')

@push('styles')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .search {
            background-color: #fff;
            margin: 14px 0 -8px;
            height: 44px;
            font-size: 18px;
            text-align: center;
            width: 100%;
        }

        .search-content {
            font-size: 1.5rem;
        }

        .search-content ul {
            list-style: none;
            list-style-type: none;
        }

        @media (min-width: 992px) {
            .search-result, .search {
                width: 71.8%;
            }

            .search-content {
                display: flex;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')

      <div id="search-box" class="container">
          <div class="row">
              <div class="col-md-12 text-center">
                  <h2><a href="/">乱炖</a>搜索</h2>
                  <form action="">
                      <div class="form-group">
                          <input type="text" id="search" class="search" placeholder="输入内容，即可搜索" v-model="search">
                      </div>
                  </form>
              </div>
              <div class="col-md-12 search-content">
                  <div class="list-group search-result">
                      <template v-for="discussion in discussions">
                          <a class="list-group-item" :href="'{{ route('forum') }}/' + discussion.slug" target="_blank">@{{ discussion.title }}</a>
                      </template>
                      <template v-for="link in links">
                          <a class="list-group-item" :href="link.url" target="_blank">@{{ link.title }}</a>
                      </template>
                  </div>
              </div>
          </div>
      </div>

    <div class="footer text-center">
        <p>&copy; 2018</p>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
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
            el: '#search-box',
            data: {
                search: '',
                discussions: [],
                links: [],
            },
            created: function () {
                this.toSearch();
            },
            methods: {
                toSearch: _.debounce(function translate() {
                    var self = this;
                    var q =  self.search;
                    if (! q) {
                        self.discussions = [];
                        self.links = [];
                        return ;
                    }

                    $.getJSON('{{ route('api.search') }}?q=' + q)
                        .done(function (data) {
                            if (! data.message) {
                                self.discussions = data.discussions;
                                self.links = data.links;
                            }
                        });
                }, 250)
            },
            watch: {
                search: function (val, oldVal) {
                    this.toSearch();
                }
            }
        })

    })();
    </script>
@endpush
