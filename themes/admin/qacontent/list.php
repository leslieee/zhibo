﻿<?php $this->load->view($cfg['tpl_admin'] . 'public/header')?>
<script>
function DrawImage(ImgD,iwidth,iheight){
    //参数(图片,允许的宽度,允许的高度)
    var image=new Image();
    image.src=ImgD.src;
    if(image.width>0 && image.height>0){
    if(image.width/image.height>= iwidth/iheight){
        if(image.width>iwidth){  
        ImgD.width=iwidth;
        ImgD.height=(image.height*iwidth)/image.width;
        }else{
        ImgD.width=image.width;  
        ImgD.height=image.height;
        }
        ImgD.alt=image.width+"×"+image.height;
        }
    else{
        if(image.height>iheight){  
        ImgD.height=iheight;
        ImgD.width=(image.width*iheight)/image.height;        
        }else{
        ImgD.width=image.width;  
        ImgD.height=image.height;
        }
        ImgD.alt=image.width+"×"+image.height;
        }
    }
}
</script>
<div class="so_main">
  <div class="page_tit">问答内容</div>

  <div id="searchContent_div" style="display:none;">
  	<div class="page_tit">搜索内容 [ <a href="javascript:void(0);" onclick="searchContent();">隐藏</a> ]</div>
	
	<div class="form2">
	 <form id="form3" name="form3" action="<?php echo site_url("admin/qacontent");?>" method="post">
    <dl class="lineD">
      <dt>问题搜索：</dt>
      <dd>
        <input name="questioncontent" id="questioncontent" type="text" value="<?php echo $questioncontent?>">
      </dd>
    </dl>
	<dl class="lineD">
      <dt>回答搜索：</dt>
      <dd>
        <input name="answercontent" id="answercontent" type="text" value="<?php echo $answercontent?>">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>提问时间：</dt>
      <dd>
        <input type="text" name="question_btime" id="question_btime" value="<?php echo $question_btime?>" /> ~ <input type="text" name="question_etime" id="question_etime" value="<?php echo $question_etime?>" />&nbsp;&nbsp;YYYY-MM-DD
      </dd>
    </dl>
	<dl class="lineD">
      <dt>回答时间：</dt>
      <dd>
        <input type="text" name="answer_btime" id="answer_btime" value="<?php echo $answer_btime?>" /> ~ <input type="text" name="answer_etime" id="answer_etime" value="<?php echo $answer_etime?>" />&nbsp;&nbsp;YYYY-MM-DD
      </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" class="btn_b"  value="确定" />
    </div>
	</form>
  </div>
  </div>
  <!-------- 个人会员列表 -------->
  <div class="Toolbar_inbox">
  	<div class="page right"></div>
	<a  class="btn_a"  onclick="delmore()"><span>删除问答</span></a>
	<a href="javascript:void(0);" class="btn_a" onclick="searchContent();">
		<span class="searchContent_action">搜索内容</span>
	</a>
  </div>
  <div class="list">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
		<input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
    	<label for="checkbox"></label>
	</th>
    <th class="line_l" width="5%">ID</th>
	<th class="line_l" width="10%">提问帐号</th>
	<th class="line_l" >问题</th>
	<th class="line_l" width="10%">提问时间</th>
	<th class="line_l" width="10%">回答时间</th>
    <th class="line_l" width="5%">操作</th>
  </tr>
	  </tr>
	  <form id="form1" name="form1" action="" method="post">
		<?php if(!empty($list)) {?>
	  <?php foreach ($list as $k=>$v) {?>
	  <tr overstyle='on' id="user_1">
	  	<td><input type="checkbox" name="questionid[]" id="checkbox2" onclick="checkon(this)" value="<?php echo $v['questionid']; ?>"></td>
		<td><?php echo $v['questionid']; ?></td>
		<td><?php echo $v['questionname']; ?></td>
		<td><?php echo str_replace('<img ', '<img  onLoad="DrawImage(this,200,100)"', $v['questioncontent']); ?></td>
		<td><?php echo date("m-d H:i:s", $v['ctime']); ?></td>
		<td><?php if (!empty($v['mtime'])) { echo date("m-d H:i:s", $v['mtime']);} else {echo "未回答";} ?></td>
	    <td>
			<a href="<?php echo site_url('admin/qacontent/detail/'.$v['questionid'])?>" class="sgbtn">查看</a>
			<a href="javascript:delContent(<?php echo $v['questionid']; ?>);" class="sgbtn">删除</a>
					</td>
			</tr>
		<?php } }?>
		</form>
	</table>
  </div>

<td colspan="9"><div class="page">记录:<?php if(!empty($pagecount)){  echo $pagecount;} ?> 条&nbsp;&nbsp;<?php if(!empty($page)){ echo $page;}?></div></td>

  <div class="Toolbar_inbox">
  	<div class="page right"></div>
	<a  class="btn_a"  onclick="delmore()"><span>删除问答</span></a>
	<a href="javascript:void(0);" class="btn_a" onclick="searchContent();">
		<span class="searchContent_action">搜索内容</span>
	</a>
  </div>

<script type="text/javascript">
//鼠标移动表格效果
	$(document).ready(function(){
		$("tr[overstyle='on']").hover(
		  function () {
		    $(this).addClass("bg_hover");
		  },
		  function () {
		    $(this).removeClass("bg_hover");
		  }
		);
	});
	
	function checkon(o){
		if( o.checked == true ){
			$(o).parents('tr').addClass('bg_on') ;
		}else{
			$(o).parents('tr').removeClass('bg_on') ;
		}
	}
	
	function checkAll(o){
		if( o.checked == true ){
			$('input[name="questionid[]"]').attr('checked','true');
			$('tr[overstyle="on"]').addClass("bg_on");
		}else{
			$('input[name="questionid[]"]').removeAttr('checked');
			$('tr[overstyle="on"]').removeClass("bg_on");
		}
	}

	//获取已选择内容的ID数组
	function getChecked() {
		var uids = new Array();
		$.each($('table input:checked'), function(i, n){
			uids.push( $(n).val() );
		});
		return uids;
	}

	//搜索内容
	var isSearchHidden = 1;
	function searchContent() {
		if(isSearchHidden == 1) {
			$("#searchContent_div").slideDown("fast");
			$(".searchContent_action").html("搜索完毕");
			isSearchHidden = 0;
		}else {
			$("#searchContent_div").slideUp("fast");
			$(".searchContent_action").html("搜索内容");
			isSearchHidden = 1;
		}
	}
	
	function folder(type, _this) {
		$('#search_'+type).slideToggle('fast');
		if ($(_this).html() == '展开') {
			$(_this).html('收起');
		}else {
			$(_this).html('展开');
		}
		
	}

function delContent(questionid)
{
	var submit = function (v, h, f) {
		if (v == 'ok')
			$.get("<?php echo site_url('admin/qacontent/del');?>"+"/"+questionid, 
			function(d){
				var data = eval('('+d+')');
				wshow(data);

			});
			
		else if (v == 'cancel')
//			jBox.tip(v, 'info');
		return true; //close
	};

	$.jBox.confirm("确定删除该内容吗？", "提示", submit);

}

function delmore()
{
	var submit = function (v, h, f) {
		if (v == 'ok')
			postdata('form1', "<?php echo site_url('admin/qacontent/delmore');?>", 'wshow');
		else if (v == 'cancel')
			return true;
	}

	$.jBox.confirm("确定删除该内容吗？", "提示", submit);

}


</script>
<?php $this->load->view($cfg['tpl_admin'] . 'public/footer')?>
