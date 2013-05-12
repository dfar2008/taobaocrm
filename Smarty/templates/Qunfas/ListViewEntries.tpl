{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
{if $smarty.request.ajax neq ''}
&#&#&#{$ERROR}&#&#&#
{/if}

     <input id="viewname" name="viewname" type="hidden" value="">

				<!-- List View Master Holder starts -->
				<table border=0 cellspacing=0 cellpadding=0 width=100% class="lvtBg">
				  <tr>
				   <td>
              		   <table border=0 cellspacing=1 cellpadding=3 width=100% class="lvt small">
                          <tr>
                          	<td bgcolor="#EFEFEF" align="center"  width="15%" valign="top">
                              <table cellspacing="0" cellpadding="3" border="0">
								<tbody>
                                <tr height="25">
                                <td>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                 <p>
                                  1.选择分组，添加该分组所有客户至接收人手机。<br><br>
                           		  2.如果没有你需要的分组，可自行创建新分组。<br><br>
                                  3.测试发送给自己不需要添加接收人，只需在"帐号设置"中设置手机号即可。
                                  且最好不选择模板。<br><br>
                                  4.群发前，可输入自己的手机号和姓名，测试发送。
                                  例如: <b>13166337788(张三)</b><br><br>
                                  5.手机号码为空的客户，不显示<br><br>
                                  6.<b>5天</b>内发送过1次短信或<b>一月</b>内发送过4次短信的客户，自动过滤。
                                  </p>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                            <td  valign="top" bgcolor="#EFEFEF" align="center" width="20%">
                              <table cellspacing="0" cellpadding="3" border="0">
								<tbody>
                                <tr>
                                <td>
                                <p align="center">
                                <b>
                                &nbsp;接收人手机
                                <br>
                                </b>
                                <font color="#808080">每行一个号码</font>
                                </p>
                                </td>
                                </tr>
                                <tr>
                                <td valign="top">
                                <p align="center">
                                <textarea style="line-height: 150%;width: 240px; height: 299px;" cols="35" name="dst" rows="8" id="receiveaccountinfo" readonly="readonly"></textarea>
                                </p>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                             </td>
                            <td valign="top" bgcolor="#EFEFEF" align="center" width="20%">
                                <table cellspacing="0" cellpadding="3" border="0">
                                <tbody>
                                <tr>
                                <td>
                                <p align="center">
                                <b>
                                <font color="#000000">&nbsp;短信内容</font> <br>
                                </b>
                                可供选择短信模板:
                                <select name="dxmb" onchange="setSendContent(this);">
                                <option value="">---不使用---</option>
                                {foreach item=tpl from=$QUNFATMPS}
                               	 <option value="{$tpl[2]}">{$tpl[1]}</option>
                                {/foreach}
                                </select>
                                
                                <input class="crmButton create small" type="button" onclick="window.open('index.php?module=Qunfas&action=QunfasAjax&file=CreateTmps','CreateTmps','top=100,left=200,height=315,width=500,scrollbars=yes,menubar=yes,addressbar=no,status=yes')" name="profile" value="新增模版"></p>
                                </td>
                                </tr>
                                <tr>
                                <td valign="top">
                                <p align="center">
                                <textarea style="line-height: 150%; width: 337px; height: 299px;" cols="35" name="msg" rows="8" id="sendmessageinfo" readonly="readonly"></textarea>
                                </p>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                            <td valign="top" bgcolor="#EFEFEF" align="left">
                                <table cellspacing="0" cellpadding="3" border="0" height="100%;">
                                <tbody>
                                <tr>
                                <td>
                                 <p>
                                  <font color="#FF0000">注意：</font>（您使用本系统发送短信，就表明您同意并接受以下内容）<br><br>

    1.不得发送包含以下内容、文字的短信息内容：非法的、骚扰性的、中伤他人的、辱骂性的、恐吓性的、伤害性的、庸俗的、淫秽的信息；教唆他人构成犯罪行为的信息；危害国家安全的信息；及任何不符合国家法律、国际惯例、地方法律规定的信息。<br><br>
    2.不能违反运营商规定，不得发送竞争对手产品的广告，不能按手机号段形式进行广告业务的宣传等，不能发送与本行业无关和移动运营商限制和禁止发送的短信内容，特别是广告类信息，群发短信等，对违反此声明产生的一切后果由发送者及其单位承担。<br><br>
    3.最好不要在晚22:00至早7:00时段发送短信，以免引起客户反感。<br>
                                  </p>
                                </td>
                                </tr>
                                <tr  valign="bottom">
                                <td valign="bottom" style="text-align:center; vertical-align:bottom;padding-top:50px;">
                                <!--<input type="button" name="button" value="测试发送给自己"  onclick="SendMessToSelf('Qunfas');return false;" ><-->
                                 <input type="button" name="savebutton" value="&nbsp;&nbsp;&nbsp;&nbsp;群发&nbsp;&nbsp;&nbsp;&nbsp; "  class="small crmbutton save" onclick="SendMessToAll('Qunfas');return false;" />
                                </td>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                            </tr>
               		   </table>
		           </td>
		   	      </tr>
	           </table>
