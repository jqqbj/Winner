<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">
function onRepwd(){
	$.messager.progress();
	$("#addFormRe").form('submit',{
		url:'__URL__/repwd/id/<?php echo ($id); ?>/go/1',
		onSubmit: function(){
			var isValid = $(this).form('validate');
			if (!isValid){
				$.messager.progress('close');
			}
			return isValid;
		},
		success:function(data){
			$.messager.progress('close');
			if(data==1){
				$.messager.alert('提示','修改密码成功！','info',function(){
					var sa = '<?php echo (C("SUBMIT_ACTION")); ?>';
					if(sa==1){
						cancel['Repwd'].dialog('close');
						cancel['Repwd'] = null;
					}
				});
			}else if(data==-1){
				$.messager.alert('提示','确认密码不正确！','warning');
			}else{
				$.messager.alert('提示','修改密码失败！','warning');
			}
		}
	});
}

function onReset(){
	cancel['Repwd'].dialog('close');
	cancel['Repwd'] = null;
}
</script>
<div class="con-tb">
<form id="addFormRe" method="post">
 <table class="infobox" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="23%"><label for="username">账号</label></td>
    <td width="77%"><?php echo ($info["username"]); ?></td>
  </tr>
  <?php if(C('MORE_COMY')){ ?><tr>
    <td width="23%"><label for="company_id">公司</label></td>
    <td width="77%"><?php echo ($info["user_comy"]["0"]["name"]); ?></td>
  </tr><?php } ?>
  <tr>
    <td width="23%"><label for="part_id">部门</label></td>
    <td width="77%"><?php echo ($info["user_part"]["0"]["name"]); ?></td>
  </tr>
  <tr>
    <td width="23%"><label for="email">邮箱</label></td>
    <td width="77%"><?php echo ($info["email"]); ?></td>
  </tr>
  <tr>
    <td width="23%"><label for="password">密码</label></td>
    <td width="77%"> <input name="password" type="password" class="easyui-validatebox"  size="20" data-options="required:true" /></td>
  </tr>
  <tr>
    <td width="23%"><label for="password2">确认密码</label></td>
    <td width="77%"> <input name="password2" type="password" class="easyui-validatebox"  size="20" data-options="required:true" /></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="center"><a href="javascript:void(0);" onclick="javascript:onRepwd()" id="su" class="easyui-linkbutton" data-options="iconCls:'icon-save'">修改</a> &nbsp; <a href="javascript:void(0);" onclick="javascript:onReset()" id="re" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'">关闭</a></td>
  </tr>
 </table>
</form>
</div>