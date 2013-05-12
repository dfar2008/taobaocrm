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

{*<!-- module header -->*}
<script language="JavaScript" type="text/javascript" src="include/js/ListView.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/search.js"></script>
<script language="JavaScript" type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>


		{include file='Buttons_List.tpl'}
                                <div id="searchingUI" style="display:none;">
                                        <table border=0 cellspacing=0 cellpadding=0 width=100%>
                                        <tr>
                                                <td align=center>
                                                <img src="{$IMAGE_PATH}searching.gif" alt="Searching... please wait"  title="Searching... please wait">
                                                </td>
                                        </tr>
                                        </table>

                                </div>
                        </td>
                </tr>
                </table>
        </td>
</tr>
</table>
{*<!-- Contents -->*}
<table class="list_table" style="margin-top: 2px;" border="0" cellpadding="3" cellspacing="1" width="100%">
<tbody>
  <tr>
    <td  colspan=3 bgcolor="#ffffff" valign="top">

<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
  <tr>
	<td valign="top" width=100% style="padding:2px;">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
          <td width=85% align="left" valign=top>
           <!-- PUBLIC CONTENTS STARTS-->
          <div id="ListViewContents">
                {include file="Sfasettings/ListViewEntries.tpl"}
          </div>
          </td>
	    </tr>
	  </table>
    </td>
   </tr>
   <tr>
   	<td>

         <table  cellpadding="5" border="0" bgcolor="#F3F3F3">
          <tbody><tr>
            <td width="100%" style="line-height: 200%;"><font color="#666666">关于SFA的说明：<br/>
              1.<b>SFA的作用</b>：使销售人员对所管理的客户按</font><font color="#CC0066"><b>统一的业务规范</b>进行有序的推进</font><font color="#666666">；在销售过程中，通过调用预先设置好的SFA跟单方案，建立详细的跟踪计划并自动生成人员工作计划表，实现规范的标准化跟单过程。通过合理运用SFA，可以大幅降低销售人员的跟单压力，具体的销售行为可建立在有序而精准的基础上。<br/>
              2.<b>SFA的组成</b>：首先是SFA方案，它和企业的销售方法以及客户的具体情况有密切的关系。方案来源于对历史销售跟单过程的总结和提取，简单地说，就是："</font><font color="#CC0066">什么时候、做什么事情，最有利于跟单推进"</font><font color="#666666">，我们把这个叫做</font><font color="#CC0066">SFA事件</font><font color="#666666">，</font><font color="#CC0066">一组事件序列构成SFA方案</font><font color="#666666">。不同的方案适用于不同类型、不同阶段或者购买不同类商品的客户。<br/>

              3.<b>SFA实例</b>：<br/>
              1）婴幼儿用品销售公司【</font><font color="#CC0066">时间推进型</font><font color="#666666">】：某顾客来购物时，销售人员会记下这个客户宝宝的生日、性别和联系方式。即可进入SFA过程序列；到宝宝7天的时候，要给客户打电话，提醒检查黄疸消退情况，并告知免费专家热线，和客户建议一个比较好的情感沟通。宝宝满月时，发问候短信，并致电推荐给宝宝作脚印纪念，理发和胎毛笔服务。到了百天，要及时给客户赠送各种辅食的试用装，并提醒拍摄百天纪念照。半岁时，询问是否要给宝宝换折叠伞车…<br/>
              2）出国留学咨询公司【</font><font color="#CC0066">事件推进型</font><font color="#666666">】：在办理高中生出国留学业务过程，分7个步骤的SFA序列：1.根据学生学习成绩、留学意向、消费水平等因素，为学生推荐备选学校。2.等学生确定好学校、专业后，签约并辅助他报名。3.帮助学生整理提交相关申请材料，并提交申请4.当收到录取通知书后，通知学生准备签证材料，进行签证申请。5.签证通过后，对将要出国的学生进行系统的行前培训和心理辅导。6.最后则是出境和留学目的地接机的准备。这个过程中的每个步骤都需要客观条件，比如：收到通知书，签证通过等。<br/>
              3）多数企业属于</font><font color="#CC0066">时间和事件推进的混合型SFA</font></td>

          </tr>
        </tbody></table>
        
    </td>
   </tr>
</table>
<!-- New List -->
</td></tr></tbody></table>
<script type="text/javascript" language="javascript">
{literal}
function confirmqiyong(url,yong)
{
	if(confirm("确认"+yong+"该方案吗?"))
	{
	window.location.href=url;
	}
} 
{/literal}
</script>