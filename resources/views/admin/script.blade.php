<!--   Core JS Files   -->
<script src="{{ asset('resources/assets/js/jquery.js') }}"></script>
<script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('resources/assets/js/wangEditor.min.js') }}"></script>
<!--  Checkbox, Radio & Switch Plugins -->
<script src="{{ asset('resources/assets/js/bootstrap-checkbox-radio-switch.js') }}"></script>
<!--  Charts Plugin -->
<script src="{{ asset('resources/assets/js/chartist.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('resources/assets/js/bootstrap-notify.js') }}"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{ asset('resources/assets/js/light-bootstrap-dashboard.js') }}"></script>
<!-- uploadify -->
<script src="{{ asset('resources/assets/uploadify/jquery.uploadify.min.js') }}"></script>
<!-- echats -->
<script src="https://cdn.bootcss.com/echarts/3.5.0/echarts.common.min.js"></script>
<!-- layer.js -->
<script src="{{ asset('resources/assets/js/layer.js') }}"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="{{ asset('resources/assets/js/demo.js') }}"></script>

<script type="text/javascript">
    $(function(){
        // dashboard
        @if(!empty($isHome))
            var myChart = echarts.init(document.getElementById('main'));

            var article_title = [];
            var view_counts = [];

            @foreach($articles as $article)
                article_title.push('{{ $article->article_title }}')
                view_counts.push('{{ $article->article_view_counts }}')
            @endforeach

            console.log(view_counts)
            // 指定图表的配置项和数据
            var option = {
                color: ['#3398D3'],
                tooltip: {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis : [{
                    type : 'category',
                    data : article_title,
                    axisTick: {
                        alignWithLabel: true
                    }
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                    name: '浏览量',
                    type: 'bar',
                    data: view_counts
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        @endif

        if ($('#file_upload') != undefined && $('#province') != undefined && $('#editor') != undefined) {
            // 地区
            $.get("{{ url('api/areas') }}", function (res) {
                console.log(res)
                $.each(res.provinces, function (i, province) {
                    var option = `
                        <option value="${ province.province_id }">
                            ${ province.province_name }
                        </option`
                    $('#province').append(option)
                })

                $("#province").change(function () {
                    var selValue = $(this).val()
                    $("#city option:gt(0)").remove()

                    $.each(res.cities, function (i, city) {
                        if (city.province_id == selValue) {
                            var option = `
                                <option value="${ city.city_id }">
                                    ${ city.city_name }
                                </option`
                            $("#city").append(option);
                        }
                    })
                })

                $("#city").change(function () {
                    var selValue = $(this).val()
                    $("#area option:gt(0)").remove()

                    $.each(res.areas, function (i, area) {
                        if (area.city_id == selValue) {
                            var option = `
                                <option value="${ area.area_id }">
                                    ${ area.area_name }
                                </option`
                            $("#area").append(option);
                        }
                    })
                })
            })

            // 图片上传
            $('#file_upload').uploadify({
                'formData': {
                    'timestamp': "{{ time() }}",
                    '_token': "{{csrf_token()}}"
                },
                'buttonText': '选择图片',
                'swf': "{{ asset('resources/assets/uploadify/uploadify.swf') }}",
                'uploader': "{{ url('upload') }}",
                'onUploadSuccess': function (file, data, responce) {
                    $('#image_url').val(data);
                    $('#image_view').attr('src', '/' + data);
                }
            });

            //editor
            var editor = new wangEditor('editor');
            editor.config.menus = [
                'source', 'bold', 'underline', 'italic', 'strikethrough', 'forecolor', 'quote', 'fontsize', 'head',
                'unorderlist', 'orderlist', 'alignleft', 'aligncenter', 'alignright','link', 'unlink', 'table', 'emotion'
            ];
            editor.create();
        }

    })

    // 删除
    function Delete(url, id, method) {
        layer.confirm('确定删除？', function(index) {
            $.post(url, {
                _token: '{{ csrf_token() }}',
                id: id,
                _method: method
            }, function (res) {
                layer.msg(res.msg, {offset: '200px'})
                if(res.code === 0) {
                    window.location.href = window.location.href;
                }
            })
            layer.close(index)
        })
    }

    // 搜索文章
    function Search(_this) {
        var search_text = _this.parent('li').prev('li').find('input').val()
        window.location.href = "{{ url('admin/article/list') }}?search_text=" + search_text;
    }

    // 处理事务
    function handleAffair(affair_id) {
        $.post("{{ url('admin/affair/handle') }}", {
            affair_id: affair_id,
            _token: '{{ csrf_token() }}'
        }, function (res) {
            layer.msg(res.msg, {offset: '200px'})
            console.log(res)
            if (res.code === 0) {
                window.location.href = window.location.href
            }
        })
    }

</script>
