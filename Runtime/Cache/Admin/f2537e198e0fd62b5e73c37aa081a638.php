<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">
$(function(){
	var th = $(".top").height();
	th = 138-th
	var wh = $(window).height()-th;
	var cw = $(window).width()-177;
	whs = 125;
	$("#newcomm").panel({
		title:'系统更新',
		doSize:true,
		height:whs,
		collapsible:true
	});
	
	$("#comm").panel({
		title:'系统信息',
		doSize:true,
		collapsible:true
	});
	
	whs = wh-25-125-116;
	$("#copy").panel({
		title:'程序团队',
		doSize:true,
		height:whs,
		collapsible:true
	});

	whs = wh-25;
	$("#info").panel({
		title:'信息总计',
		doSize:true,
		height:whs,
		collapsible:true
	});
});

$(function(){ 
var $this = $(".renav"); 
var scrollTimer; 
$this.hover(function(){ 
clearInterval(scrollTimer); 
},function(){ 
scrollTimer = setInterval(function(){ 
scrollNews( $this ); 
}, 3800 ); 
}).trigger("mouseout"); 
}); 
function scrollNews(obj){ 
var $self = obj.find("ul:first"); 
var lineHeight = $self.find("li:first").height(); 
$self.animate({ "margin-top" : -lineHeight +"px" },600 , function(){ 
$self.css({"margin-top":"0px"}).find("li:first").appendTo($self); 
});
}

function toShowNotice(id){
	var has = $("#detailFormNotice").length;
	if(!has){
		$("<div/>").dialog({
			title:'公告详情',
			resizable:true,
			width:720,
			height:480,
			href:'__GROUP__/Notice/detail/id/'+id,
			onOpen:function(){
				cancel['NoticeDetail'] = $(this);
			},
			onClose:function(){
				$(this).dialog('destroy');
				cancel['NoticeDetail'] = null;
			}
		});
	}
}


function onCheckVer(){
	$.messager.progress();
	var url = 'http://'+window.location.host;
	var x = $.getJSON("http://server.piocms.com/dwuss/index.php/Admin/project/upload?callback=?",{mode:'Winner', serial:'<?php echo $serial ?>', ver:'<?php echo $ver[0] ?>' ,domain:url, key:'e1a111321d2cc0c2ba779e7ccd43994d'}, function(data){
		//alert(data.version);
		$.messager.progress('close');
		$.get('__URL__/upver',function(ver){
			$("#vertext").html(ver);
		});
		if(data.soft=='False'){
			$.messager.alert('提示','当前已经是最新版本！','info');
		}else{
			$.messager.confirm('提示','以检测到新的版本，是否下载？',function(r){
				if(r){
					document.location = '__URL__/downver/soft/'+data.soft;
				}
			});
		}
		return;
	});
	$.messager.progress('close');
}
</script>
<div class="con3">
<div class="panel-border">
<table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr style="height:26px;">
        <td>
         <span class="vol up-font-over">
          <div class="renav_tit">公告：</div>
          <div class="renav" style="line-height:26px;"> 
            <ul style="margin-top: 0px;"> 
            <?php if(is_array($ninfo)): foreach($ninfo as $key=>$t): ?><li><a href="javascript:toShowNotice('<?php echo ($t["id"]); ?>')"><?php echo ($t["title"]); ?>&nbsp;/&nbsp;<?php echo ($t["addtime"]); ?></a> </li><?php endforeach; endif; ?>
            </ul> 
          </div>
          
         </span>
        </td>
  </tr>
  <tr>
    <td width="56%" valign="top">
      <div id="newcomm">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td width="18%" height="96" valign="middle"><img style="margin-left:3px;" src="__ITEM__/__ADMIN.IMG__/main-logo.jpg" width="92" height="92" /></td>
        <td width="82%" valign="middle">
         <p style="font-weight:bold; color:#039" id="vertext">当前版本：<?php echo ($ver["0"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;最后检测时间：<?php echo ($ver["1"]); ?></p>
         <p style="margin-top:12px"><a href="javascript:void(0);" onclick="javascript:onCheckVer()" id="su" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">检查更新</a></p>
        </td>
       </tr>
      </table>
      </div>
        
      <div class="tb-line"></div>
        
      <div id="comm" style="padding:2px">
        <table class="infobox table-border" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr style="height:23px; line-height:23px;">
            <td width="18%">服务器名称</td>
            <td width="32%"><?php echo $_SERVER['SERVER_NAME']; ?></td>
            <td width="18%">服务器IP</td>
            <td width="32%"><?php echo strstr($_SERVER['SERVER_SOFTWARE'],'Microsoft')?$_SERVER['LOCAL_ADDR']:$_SERVER['SERVER_ADDR']; ?></td>
            </tr>
          <tr style="height:23px; line-height:23px;">
            <td width="18%">服务器域名</td>
            <td width="32%"><?php echo $_SERVER['HTTP_HOST']; ?></td>
            <td width="18%">操作系统</td>
            <td width="32%"><?php echo PHP_OS; ?></td>
            </tr>
          <tr style="height:23px; line-height:23px;">
            <td width="18%">PHP版本</td>
            <td width="32%"><?php echo PHP_VERSION; ?></td>
            <td width="18%">运行状态</td>
            <td width="32%"><?php echo C('CFG_ON')==1?"运行中":"维护中"; ?></td>
            </tr>
          </table>
        </div>
        
        <div class="tb-line"></div>
        
        <div id="copy" style="padding:2px">
          <table class="infobox table-border" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr style="height:23px; line-height:23px;">
            <td width="29%">主程序开发</td>
            <td><a href="http://www.d-winner.com/" target="_blank">梦赢科技</a>、<a href="http://www.95era.com/" target="_blank">九五时代</a></td>
            </tr>
           <tr style="height:23px; line-height:23px;">
            <td width="29%">QQ交流群</td>
            <td><a href="http://shang.qq.com/wpa/qunwpa?idkey=4de623d1a4e4a0b640bdf76ad7bc9693653341d5490f9ab075e60f8c9467b654" target="_blank">286914596</a></td>
            </tr>
          <tr style="height:23px; line-height:23px;">
            <td width="29%">赞助商</td>
            <td><a href="http://www.075595.com/" target="_blank">95数据中心</a></td>
            </tr>
          <tr style="height:23px; line-height:23px;">
            <td width="29%">特别鸣谢</td>
            <td>ThinkPHP、EasyUI、Kindeditor、My97</td>
            </tr>
          </table>
        </div>
    </td>
   
    <td width="44%" valign="top">
      <div id="info" style="padding:2px;">
        <table class="infobox table-border" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr style="height:23px; line-height:23px;">
            <td width="29%">用户总数</td>
            <td class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('User_table') ?></td>
            </tr>
          <tr style="height:23px; line-height:23px;">
            <td width="29%">角色总数</td>
            <td class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('User_group_table') ?></td>
            </tr>
          <?php if(C('MORE_COMY')){ ?><tr style="height:23px; line-height:23px;">
            <td width="29%">子公司总数</td>
            <td class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('User_company_table','type=0') ?></td>
            </tr><?php } ?>
          <tr style="height:23px; line-height:23px;">
            <td width="29%">部门总数</td>
            <td class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('User_part_table') ?></td>
            </tr>
          <tr style="height:23px; line-height:23px;">
            <td width="29%">公告总数</td>
            <td class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('Notice_table') ?></td>
            </tr>
          </table>
      </div>
    </td>
    </tr>
</table>
</div>
<div align="center" style="line-height:16px; color:#A7A7A7;">Copyright © 2010-2015 程序由 <a style="line-height:16px; color:#A7A7A7;" href="http://www.95era.com/" target="_blank">九五时代</a> 设计开发</div>
</div>