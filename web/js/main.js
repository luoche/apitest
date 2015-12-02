;(function(){
    
    $(function(){
        
        $('#main-nav').find('li').on('click', function(){
            var index = $(this).index();
            $(this).addClass('active').siblings().removeClass('active');
            $('.tab-block').eq(index).fadeIn(100).siblings('.tab-block').hide();
        });
        
        /*删除当前行*/
        $('table').on('click', '.remove-row', function(){
            $(this).parent().parent().remove();
        });
        
        /*创建参数第二步骤*/
       /* $('.btn-step-1').on('click', function(){
            $('.creat-api-step-1').hide();
            $('.creat-api-step-2').fadeIn(100);
        });*/
        
        $('.add-row').on('click', function(){
            var id = $(this).attr('data-id'),
                _html;
            var _type = '<option value="INT" selected>INT</option><option value="STRING">STRING</option><option value="CHAR">CHAR</option><option value="VARCHAR">VARCHAR</option><option value="TEXT">TEXT</option><option value="TINYINT">TINYINT</option><option value="DATETIME">DATETIME</option><option value="BLOB">BLOB</option>';
            if(id == 1) {
                _html = '<tr><td><input type=text class=form-control name="PostParam_name[]" placeholder="接口名称"><td><select class=form-control name="PostParam_type[]">'+_type+'</select><td><select class=form-control name="PostParam_is_required[]"><option value=1 selected>是<option value=0>否</select><td><input type=text class=form-control name="PostParam_detail[]" placeholder="示例值"><td><input type=text class=form-control name="PostParam_value[]" placeholder="描述"><td><span class="remove-row">x</span></td>';
            }
            if(id == 2) {
                _html = '<tr><td><input type=text class=form-control name="ReturnParam_name[]" placeholder="接口名称"><td><select class=form-control name="ReturnParam_name[]">'+_type+'</select><td><select class=form-control name="ReturnParam_is_required[]"><option value=1 selected>是<option value=0>否</select><td><input type=text class=form-control name="ReturnParam_detail[]" placeholder="示例值"><td><input type=text class=form-control name="ReturnParam_value[]" placeholder="描述"><td><span class="remove-row">x</span></td>';
            }
            if(id == 3) {
                _html = '<tr><td><input type=text class=form-control id="" name="ErrorMessage_errorcode[]" placeholder="接口名称"><td><input type=text class=form-control id="" name="ErrorMessage_msg[]" placeholder="描述"><td><input type=text class=form-control id="" name="ErrorMessage_solve_answer[]" placeholder="解决方案"><td><span class="remove-row">x</span></td>';
            }
            $('.table-'+id).hide().append(_html).show();
        });
        //cate分类的提交
        $('#form-category-submit').on('click',function(){
           var i_form = $(this).parents('form');
           var url = i_form.attr('action');
           $.post(url,i_form.serialize(),function(data){
                if (parseInt(data.errorcode) == 0) {
                    alert(data.msg);
                } else {
                    alert(data.msg);
                };
           },'json');
        });
        //添加基本信息
        $('#form-baseMessage-submit').on('click',function(){
           var i_form = $(this).parents('form');
           var url = i_form.attr('action');
           $.post(url,i_form.serialize(),function(data){
                alert(data.msg);
                if (parseInt(data.errorcode) == 0) {
                    //传递b_id
                    $('#b_id').val(data.data.b_id);
                    $('.creat-api-step-1').hide();
                    $('.creat-api-step-2').fadeIn(100);
                };
           },'json');
        });



    });
    
})()
