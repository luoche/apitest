;(function(){
    
    $(function(){
        
        $('#main-nav').find('li').on('click', function(){
            var index = $(this).index();
            $(this).addClass('active').siblings('li').removeClass('active');
            $('.tab-block').eq(index).fadeIn(100).siblings('.tab-block').hide();
        });
        
        /*删除当前行*/
        $('table').on('click', '.remove-row', function(){
            $(this).parent().parent().remove();
        });
        
        $('.add-row').on('click', function(){
            var id = $(this).attr('data-id'),
                _html;
            var _type = '<option value="INT" >INT</option><option value="STRING">STRING</option><option value="CHAR">CHAR</option><option value="VARCHAR">VARCHAR</option><option value="TEXT">TEXT</option><option value="TINYINT">TINYINT</option><option value="DATETIME">DATETIME</option><option value="BLOB">BLOB</option>';
            if(id == 1) {
                _html = '<tr><td><input type=text class=form-control name="PostParam_name[]" placeholder="接口名称"><td><select class=form-control name="PostParam_type[]">'+_type+'</select><td><select class=form-control name="PostParam_is_required[]"><option value=1 selected>是<option value=0>否</select><td><input type=text class=form-control name="PostParam_detail[]" placeholder="示例值"><td><input type=text class=form-control name="PostParam_value[]" placeholder="描述"><td><span class="remove-row">x</span></td>';
            }
            if(id == 2) {
                _html = '<tr><td><input type=text class=form-control name="ReturnParam_name[]" placeholder="接口名称"><td><select class=form-control name="ReturnParam_type[]">'+_type+'</select><td><select class=form-control name="ReturnParam_is_required[]"><option value=1 selected>是<option value=0>否</select><td><input type=text class=form-control name="ReturnParam_detail[]" placeholder="示例值"><td><input type=text class=form-control name="ReturnParam_value[]" placeholder="描述"><td><span class="remove-row">x</span></td>';
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
		
		showChildNav();
        createIframe();
        resizeWin();
        $(window).resize();
        addAPI();

    });
	
	function showChildNav(){
        /*展开子导航*/
        $('.nav-item').bind('click',function(){
            if($(this).next().is(':hidden')){
                $(this).find('i').removeClass('icon-angle-right').addClass('icon-angle-down');
                $(this).next().slideDown(300);
            }else{
                $(this).find('i').removeClass('icon-angle-down').addClass('icon-angle-right');
                $(this).next().slideUp(100);
            }
            return false;
        });
    }
    
    function createIframe(){
        $('.child-nav').on('click', 'a', function(){
            var url = $(this).attr('href');
            $('#api-box').attr('src', url);
            return false;
        })
    }
    
    function resizeWin(){
        $(window).resize(function(){
            var window_h = $(window).height(),
                header_h = $('header').height(),
                iframe_h = window_h-header_h-20;
            $('.api-content').css('height',iframe_h);
            $('#api-box').css('height',iframe_h);
        })
    }

    function searchForm(){
        $('#btn-submit-search').on('click', function(){

            var key_value = $('.key-word').val();
            if(!key_value){
                alert('请输入搜索内容！');
                return false;
            }
            $.post('http://www.apitest.com/web/index.php?r=index/api-test', 'key='+key_value, function(data){
                $('#api-box').attr('src',data.url);
            },'json');

            return false;;

        });
    }
    
    function addAPI(){
        $('.btn-add-api').on('click', function(){
            var url = $(this).attr('href');
            $('#api-box').attr('src', url);
            return false;
        });
    }

    
})()
