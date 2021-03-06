<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">
$(function(){
	var th = $(".top").height();
	th = 111-th;
	var wh = $(window).height()-th;
	
	$("#Menu").treegrid({
		//title:'菜单列表',	
		idField:'id',
		height:wh,
		treeField:'text',
		autoRowHeight:false,
		singleSelect:true,
		striped:true,
		rownumbers:true,
		method:'get',
		url:'__ACTION__/json/1',
		fitColumns:true,
		nowrap:Number('<?php echo (C("DATA_NOWRAP")); ?>'),
		onBeforeLoad: function () {  
			
		},
		onDblClickRow:function(e,rowIndex,rowData){
			var se = $(this).treegrid('getSelected');
			var idd = se['id'];
			$("#addMenu").dialog({
				title:'编辑菜单',
				resizable:true,
				width:500,
				height:330,
				href:'__URL__/add/act/edit/id/'+idd,
				onOpen:function(){
					cancel['Menu'] = $(this);
				},
				onClose:function(){
					//$(this).dialog('destroy');
					//$("#Menu").treegrid('reload');
					cancel['Menu'] = null;
				}
			});
		},
		toolbar:[{
		iconCls: 'icon-add',
			text : '新增',
			handler: function(){
				$("#addMenu").dialog({
					title:'新增菜单',
					resizable:true,
					width:500,
					height:330,
					href:'__URL__/add/act/add',
					onOpen:function(){
						cancel['Menu'] = $(this);
					},
					onClose:function(){
						//$(this).dialog('destroy');
						//$("#Menu").treegrid('reload');
						cancel['Menu'] = null;
					}
				});
			}
		},'-',{
			iconCls: 'icon-edit',
			text : '编辑',
			handler: function(){
				var se = $("#Menu").treegrid('getSelected');
				var idd = se['id'];
				$("#addMenu").dialog({
					title:'编辑菜单',
					resizable:true,
					width:500,
					height:330,
					href:'__URL__/add/act/edit/id/'+idd,
					onOpen:function(){
						cancel['Menu'] = $(this);
					},
					onClose:function(){
						//$(this).dialog('destroy');
						//$("#Menu").treegrid('reload');
						cancel['Menu'] = null;
					}
				});
			}
		},'-',{
			iconCls: 'icon-cancel',
			text : '删除',
			handler: function(){
				var se = $("#Menu").treegrid('getSelected');
				var idd = se['id'];
				$.messager.confirm('提示','确定删除吗！',function(r){
					if(r==true){
						$.messager.progress();
						$.get('__URL__/del/id/'+idd, function(data){
							$.messager.progress('close');
							if(data==1){
								$.messager.alert('提示','刪除数据成功！','info',function(){
									$("#Menu").treegrid('reload');
								});
							}else if(data==0){
								$.messager.alert('提示','刪除数据失败！','warning');
							}else{
								//alert(data);
								$.messager.alert('提示','您没有刪除权限！','warning');
							}
						});
					}
				});	
			}
		},'-',{
			iconCls: 'icon-json',
			text : '更新缓存',
			handler: function(){
				$.get('__URL__/json', function(data){
					if(data==1){
						$.messager.alert('提示','更新缓存成功！','info');
					}else{
						//alert(data);
						$.messager.alert('提示','更新缓存失败！','warning');
					}
				});
			}
		},'-',{
			iconCls: 'icon-reload',
			text : '重载',
			handler: function(){
				$("#Menu").treegrid('reload');
			}
		}],
		columns:[[   
			{field:'text',title:'菜单名称',width:190},   
			{field:'code',title:'识别码',width:100},   
			{field:'url',title:'链接',width:260},   
			{field:'iconCls',title:'标题图片',width:100},
			{field:'state',title:'展开状态',width:70},
			{field:'levels',title:'查看权限',width:90},
			{field:'view',title:'开启用户',width:80},
			{field:'status',title:'状态',width:60},
			{field:'sort',title:'排序',width:50},
			{field:'role',title:'配置文件',width:70},
		]]
	});
});

function openWin(id){
	$("#addMenu").dialog({
		title:'权限配置文件',
		resizable:true,
		width:800,
		height:430,
		href:'__URL__/role/id/'+id,
		onOpen:function(){
			cancel['MenuRole'] = $(this);
		},
		onClose:function(){
			//$(this).dialog('destroy');
			//$("#Menu").treegrid('reload');
			cancel['MenuRole'] = null;
		}
	});
}
</script>
<div class="con" id="MenuCon" onselectstart="return false;" style="-moz-user-select:none;">
	<table id="Menu"></table>
</div>
<div id="addMenu"></div>