<?php /* Smarty version 2.6.18, created on 2012-12-21 17:01:01
         compiled from RelatedListNew.tpl */ ?>
<script language="JavaScript" type="text/javascript" src="modules/PriceBooks/PriceBook.js"></script>
<script type="text/javascript" src="modules/<?php echo $this->_tpl_vars['MODULE']; ?>
/<?php echo $this->_tpl_vars['SINGLE_MOD']; ?>
.js"></script>
<?php echo '
<script>
function getTabViewForRelated(ID){ 
	var typeid = document.getElementById("typeid").value;
	document.getElementById(typeid).className="tablink";
	document.getElementById(ID).className="tablink selected";
	document.getElementById(typeid+"1").style.display = "none";
	document.getElementById(ID+"1").style.display = "";
	document.getElementById("typeid").value = ID;
}

function editProductListPrice(id,pbid,price)
{
        $("status").style.display="inline";
        new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: \'action=ProductsAjax&file=EditListPrice&return_action=DetailView&return_module=PriceBooks&module=Products&parenttab=Settings&record=\'+id+\'&pricebook_id=\'+pbid+\'&listprice=\'+price,
                        onComplete: function(response) {
                                        $("status").style.display="none";
                                        $("editlistprice").innerHTML= response.responseText;
                        }
                }
        );
}

function gotoUpdateListPrice(id,pbid,proid)
{
        $("status").style.display="inline";
        $("roleLay").style.display = "none";
        var listprice=$("list_price").value;
                new Ajax.Request(
                        \'index.php\',
                        {queue: {position: \'end\', scope: \'command\'},
                                method: \'post\',
                                postBody: \'module=Products&action=ProductsAjax&file=UpdateListPrice&ajax=true&return_action=DetailView&return_module=PriceBooks&record=\'+id+\'&pricebook_id=\'+pbid+\'&product_id=\'+proid+\'&list_price=\'+listprice,
                                onComplete: function(response) {
                                        $("status").style.display="none";
                                        $("RLContents").innerHTML= response.responseText;
                                }
                        }
                );
}
'; ?>


function loadCvList(type,id) {
        if(type === 'Accounts')
	{
		if($("account_cv_list").value != 'None')
		{
		$("account_list_button").innerHTML = '<input title="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" type="button"  name="button" onclick="window.location.href=\'index.php?action=LoadList&module=Campaigns&return_action=DetailView&return_id='+id+'&list_type='+type+'&cvid='+$("account_cv_list").value+'\'">';
		}
	}
	if(type === 'Contacts')
	{
		if($("cont_cv_list").value != 'None')
		{
		$("contact_list_button").innerHTML = '<input title="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" type="button"  name="button" onclick="window.location.href=\'index.php?action=LoadList&module=Campaigns&return_action=DetailView&return_id='+id+'&list_type='+type+'&cvid='+$("cont_cv_list").value+'\'">';
		}
	}
	if(type === 'Leads')
	{
		if($("lead_cv_list").value != 'None')
		{
			$("lead_list_button").innerHTML = '<input title="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['MOD']['LBL_LOAD_LIST']; ?>
" type="button"  name="button" onclick="window.location.href=\'index.php?action=LoadList&module=Campaigns&return_action=DetailView&return_id='+id+'&list_type='+type+'&cvid='+$("lead_cv_list").value+'\'">';
		}
	}

	
}
</script>

<!-- Contents -->
<div id="editlistprice" style="position:absolute;width:300px;"></div>
		<!-- PUBLIC CONTENTS STARTS-->
		
			<!-- Account details tabs -->
			<tr>
				<td valign=top align=left >
					<div class="small" style="padding:5px">
		                	<table border=0 cellspacing=0 cellpadding=3 width=100% >
						<tr>
							<td valign=top align=left>
							<!-- content cache -->
								<table border=0 cellspacing=0 cellpadding=0 width=100%>
									<tr>
										<td >
										   <!-- General details -->
												<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'RelatedListsHidden.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
												<div id="RLContents">
					                                 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'RelatedListContents.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                        		</div>
												</form>
										   
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
	<!-- PUBLIC CONTENTS STOPS-->

<script>
function OpenWindow(url)
{
	openPopUp('xAttachFile',this,url,'attachfileWin',380,375,'menubar=no,toolbar=no,location=no,status=no,resizable=no');	
}
</script>
