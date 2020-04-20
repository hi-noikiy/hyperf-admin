@if(!empty($data['_user']) && !empty($data['_user']['customize_style']))
    @php
        $customize_style = $data['_user']['customize_style'];
    @endphp

<script type="text/javascript">
    $(function () {
        let customize_style = {!! $customize_style !!}
        for (let selector in customize_style) {
            for (let class_name in customize_style[selector]) {
                var separator = '.'
                if (selector == 'body') {
                  separator = ''
                }
                if (customize_style[selector][class_name]) {
                    $("#"+selector+"_"+class_name).attr("checked", true)
                    $(separator+selector).addClass(class_name)
                } else {
                    $("#"+selector+"_"+class_name).attr("checked", false)
                    $(separator+selector).removeClass(class_name)
                }
            }
        }

        //Initialize Select2 Elements
        $('.select2').select2()

        $(".admin-table").DataTable({
            "responsive": true,
            "autoWidth": true,
            "paging": true, // 分页
            "lengthChange": true, // 改变每页条数
            "searching": true, // 搜索
            "ordering": true, // 排序
            "info": true, // 当前页信息
            "processing": true,
            "pageLength": 10,
            "lengthMenu": [10, 25, 50, 75, 100, 200],
            "language": {
                lengthMenu: "显示 _MENU_ 条记录",
                zeroRecords: "抱歉， 没有找到",
                info: "显示第 _START_ 至 _END_ 条，共 _TOTAL_ 条记录",
                infoEmpty: "暂无数据",
                InfoFiltered: "(从 _MAX_ 条数据中检索)",
                search: "搜索：",
                paginate: {
                    first: "首页",
                    previous: "上一页",
                    next: "下一页",
                    last: "最后一页"
                },
                processing: "<div id='status'><i class='fa fa-spinner fa-spin'></i></div>"
            }
        });
    })
</script>
@endif

<script src="/vendor/hyperf-admin/AdminLTE/dist/js/hyperf-admin.js"></script>