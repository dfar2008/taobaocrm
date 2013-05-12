<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
/*********************************************************************************
 * $Header: /advent/projects/wesat/ec_crm/sugarcrm/include/utils/DetailViewUtils.php,v 1.188 2005/04/29 05:5 * 4:39 rank Exp
 * Description:  Includes generic helper functions used throughout the application.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
global $root_directory;
require_once($root_directory.'include/database/PearDatabase.php');
require_once($root_directory.'include/ComboUtil.php'); //new
require_once($root_directory.'include/utils/CommonUtils.php'); //new


/** This function returns the detail view form ec_field and and its properties in array format.
  * Param $uitype - UI type of the ec_field
  * Param $fieldname - Form ec_field name
  * Param $fieldlabel - Form ec_field label name
  * Param $col_fields - array contains the ec_fieldname and values
  * Param $generatedtype - Field generated type (default is 1)
  * Param $tabid - ec_tab id to which the Field belongs to (default is "")
  * Return type is an array
  */

function getDetailViewOutputHtml($uitype, $fieldname, $fieldlabel, $col_fields,$generatedtype,$tabid='')
{	
	global $log;
	$log->debug("Entering getDetailViewOutputHtml() method ...");
	global $adb;
	global $mod_strings;
	global $app_strings;
	global $current_user;
	//$fieldlabel = from_html($fieldlabel);
	$custfld = '';
	$value ='';
	$arr_data =Array();
	$label_fld = Array();
	$data_fld = Array();
	if($generatedtype == 2) $mod_strings[$fieldlabel] = $fieldlabel;
	if(!isset($mod_strings[$fieldlabel])) {
		$mod_strings[$fieldlabel] = $fieldlabel;
	}
	if($col_fields[$fieldname]=='--None--') $col_fields[$fieldname]='';
    if($uitype == 116)
	{
		$label_fld[] = $mod_strings[$fieldlabel];
        $label_fld[] = $col_fields[$fieldname];
	}
	elseif($uitype == 13)
	{
		$label_fld[] = $mod_strings[$fieldlabel];
		$temp_val = $col_fields[$fieldname];
		$label_fld[] = $temp_val;
		$linkvalue = getComposeMailUrl($temp_val);
		$label_fld["link"] = $linkvalue;
	}
	elseif($uitype == 15 || $uitype == 16 || $uitype == 115 || $uitype == 111) //uitype 111 added for non editable picklist - ahmed
	{
	    $label_fld[] = $mod_strings[$fieldlabel];
	    $label_fld[] = $col_fields[$fieldname];
	}
	elseif($uitype == 10)
	{
		if(isset($app_strings[$fieldlabel])) {
			$label_fld[] = $app_strings[$fieldlabel];
		} elseif(isset($mod_strings[$fieldlabel])) {
			$label_fld[] = $mod_strings[$fieldlabel];
		} else {
			$label_fld[] = $fieldlabel;
		}
		$value = $col_fields[$fieldname];
		$module_entityname = "";
		if($value != '')
		{
			$query = "SELECT ec_entityname.* FROM ec_crmentityrel inner join ec_entityname on ec_entityname.modulename=ec_crmentityrel.relmodule inner join ec_tab on ec_tab.name=ec_crmentityrel.module WHERE ec_tab.tabid='".$tabid."' and ec_entityname.entityidfield='".$fieldname."'";
			$fldmod_result = $adb->query($query);
			$rownum = $adb->num_rows($fldmod_result);
			if($rownum > 0) {
				$rel_modulename = $adb->query_result($fldmod_result,0,'modulename');
				$rel_tablename = $adb->query_result($fldmod_result,0,'tablename');
				$rel_entityname = $adb->query_result($fldmod_result,0,'fieldname');
				$rel_entityid = $adb->query_result($fldmod_result,0,'entityidfield');
				$module_entityname = getEntityNameForTen($rel_tablename,$rel_entityname,$fieldname,$value);
			}

		}
		$label_fld[] = $module_entityname;
		$label_fld["secid"] = $value;
		$label_fld["link"] = "index.php?module=".$rel_modulename."&action=DetailView&record=".$value;
	}
	elseif($uitype == 33) //uitype 33 added for multiselector picklist - Jeri
	{
	    $label_fld[] = $mod_strings[$fieldlabel];
	    $label_fld[] = str_ireplace(' |##| ',', ',$col_fields[$fieldname]);
	}
	elseif($uitype == 17)
	{
		$label_fld[] = $mod_strings[$fieldlabel];
		$label_fld[] = $col_fields[$fieldname];
		//$label_fld[] = '<a href="http://'.$col_fields[$fieldname].'" target="_blank">'.$col_fields[$fieldname].'</a>';
	}
	elseif($uitype == 19)
	{
		//$tmp_value = str_replace("&lt;","<",nl2br($col_fields[$fieldname]));
		//$tmp_value = str_replace("&gt;",">",$tmp_value);
		//$col_fields[$fieldname]= make_clickable($tmp_value);
		$label_fld[] = $mod_strings[$fieldlabel];
		$label_fld[] = $col_fields[$fieldname];
	}
	elseif($uitype == 20 || $uitype == 21 || $uitype == 22 || $uitype == 24) // Armando LC<scher 11.08.2005 -> B'descriptionSpan -> Desc: removed $uitype == 19 and made an aditional elseif above
	{
		//$col_fields[$fieldname]=nl2br($col_fields[$fieldname]);
		$label_fld[] = $mod_strings[$fieldlabel];
		$label_fld[] = $col_fields[$fieldname];
	}
	elseif($uitype == 51 || $uitype == 50 || $uitype == 73)
	{
		$account_id = $col_fields[$fieldname];
		$account_name = "";
		if($account_id != '')
		{
			$account_name = getAccountName($account_id);
		}
		//Account Name View
		$label_fld[] = $mod_strings[$fieldlabel];
		$label_fld[] = $account_name;
		$label_fld["secid"] = $account_id;
		$label_fld["link"] = "index.php?module=Accounts&action=DetailView&record=".$account_id;
	}
	elseif($uitype == 52 || $uitype == 77  || $uitype == 101)
	{
		$label_fld[] = $mod_strings[$fieldlabel];
		$user_id = $col_fields[$fieldname];
		$user_name = getUserName($user_id);
		$label_fld[] =$user_name;
	}
	elseif($uitype == 53)
	{
		$user_id = $col_fields[$fieldname];
		$user_name = getUserName($user_id);
		$label_fld[] =$mod_strings[$fieldlabel];
		$label_fld[] =$user_name;

	}
	elseif($uitype == 1004) //display creator in editview page
	{
		if(isset($mod_strings[$fieldlabel])) {
			$label_fld[] = $mod_strings[$fieldlabel];
		} else {
			$label_fld[] = $fieldlabel;
		}
		$value = $col_fields[$fieldname];
		$label_fld[] = getUserName($value);
	}
	elseif($uitype == 55)
        {
		if($tabid == 4)
           {
                   $query="select ec_contactdetails.imagename from ec_contactdetails where contactid=".$col_fields['record_id'];
                   $result = $adb->query($query);
                   $imagename=$adb->query_result($result,0,'imagename');
                   if($imagename != '')
                   {

                           $imgpath = "test/contact/".$imagename;
                           $label_fld[] =$mod_strings[$fieldlabel];
			   //This is used to show the contact image as a thumbnail near First Name field
                           //$label_fld["cntimage"] ='<div style="position:absolute;height=100px"><img class="thumbnail" src="'.$imgpath.'" width="60" height="60" border="0"></div>&nbsp;'.$mod_strings[$fieldlabel];
                   }
                   else
                   {
                         $label_fld[] =$mod_strings[$fieldlabel];
                   }

           }
           else
           {
                   $label_fld[] =$mod_strings[$fieldlabel];
           }
           $value = $col_fields[$fieldname];
           $sal_value = $col_fields["salutationtype"];
           if($sal_value == '--None--')
           {
                   $sal_value='';
           }
          $label_fld["salut"] = $sal_value;
          $label_fld[] = $value;
		//$label_fld[] =$sal_value.' '.$value;
        }
	elseif($uitype == 56)
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$value = $col_fields[$fieldname];
		if($value == 1)
		{
			//Since "yes" is not been translated it is given as app strings here..
			$display_val = $app_strings['yes'];
		}
		else
		{
			$display_val = '';
		}
		$label_fld[] = $display_val;
	}
	elseif($uitype == 57)
    {
		 $label_fld[] =$mod_strings[$fieldlabel];
	     $contact_id = $col_fields[$fieldname];
		 $contact_name = "";
	     if(trim($contact_id) != '')
	     {
			   $contact_name = getContactName($contact_id);
	     }
         $label_fld[] = $contact_name;
		 $label_fld["secid"] = $contact_id;
		 $label_fld["link"] = "index.php?module=Contacts&action=DetailView&record=".$contact_id;
    }
    elseif($uitype == 154)
    {
		 $label_fld[] =$mod_strings[$fieldlabel];
	     $cangkusid = $col_fields[$fieldname];
		 $cangkuname = "";
	     if(trim($cangkusid) != '')
	     {
			   $cangkuname = getCangkuName($cangkusid);
	     }
         $label_fld[] = $cangkuname;
		 $label_fld["secid"] = $cangkusid;
		 $label_fld["link"] = "index.php?module=Cangkus&action=DetailView&record=".$cangkusid;
    }
     elseif($uitype == 155)
    {
		 $label_fld[] =$mod_strings[$fieldlabel];
	     $cangkusid = $col_fields[$fieldname];
		 $cangkuname = "";
	     if(trim($cangkusid) != '')
	     {
			   $cangkuname = getCangkuName($cangkusid);
	     }
         $label_fld[] = $cangkuname;
		 $label_fld["secid"] = $cangkusid;
//		 $label_fld["link"] = "index.php?module=Cangkus&action=DetailView&record=".$cangkusid;
    }
	elseif($uitype == 58)
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$campaign_id = $col_fields[$fieldname];
		if($campaign_id != '')
		{
			$campaign_name = getCampaignName($campaign_id);
		}
		$label_fld[] = $campaign_name;
		$label_fld["secid"] = $campaign_id;
		$label_fld["link"] = "index.php?module=Campaigns&action=DetailView&record=".$campaign_id;

	}
	elseif($uitype == 59)
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$product_id = $col_fields[$fieldname];
		if($product_id != '')
		{
			$product_name = getProductName($product_id);
		}
		//Account Name View
		$label_fld[] = $product_name;
		$label_fld["secid"] = $product_id;
		$label_fld["link"] = "index.php?module=Products&action=DetailView&record=".$product_id;

	}
        elseif($uitype == 61)
		{
			global $adb;
			$label_fld[] =$mod_strings[$fieldlabel];

			if($tabid ==10)
			{
				$attach_result = $adb->query("select * from ec_seattachmentsrel where crmid = ".$col_fields['record_id']);
				for($ii=0;$ii < $adb->num_rows($attach_result);$ii++)
				{
					$attachmentid = $adb->query_result($attach_result,$ii,'attachmentsid');
					if($attachmentid != '')
					{
						$attachquery = "select * from ec_attachments where attachmentsid=".$attachmentid;
						$result = $adb->query($attachquery);
						$attachmentsname = $adb->query_result($result,0,'name');
						if($attachmentsname != '')
							$custfldval = '<a href = "index.php?module=uploads&action=downloadfile&return_module='.$col_fields['record_module'].'&fileid='.$attachmentid.'&entityid='.$col_fields['record_id'].'">'.$attachmentsname.'</a>';
						else
							$custfldval = '';
					}
					$label_fld['options'][] = $custfldval;
				}
			}else
			{
				$result = $adb->query("select * from ec_seattachmentsrel where crmid = ".$col_fields['record_id']);
				$attachmentid=$adb->query_result($result,0,'attachmentsid');
				if($col_fields[$fieldname] == '' && $attachmentid != '')
				{
					$attachquery = "select * from ec_attachments where attachmentsid=".$attachmentid;
					$result = $adb->query($attachquery);
					$col_fields[$fieldname] = $adb->query_result($result,0,'name');
				}

				//This is added to strip the crmid and _ from the file name and show the original filename
				$org_filename = ltrim($col_fields[$fieldname],$col_fields['record_id'].'_');
				if($org_filename != '')
					$custfldval = '<a href = "index.php?module=uploads&action=downloadfile&return_module='.$col_fields['record_module'].'&fileid='.$attachmentid.'&entityid='.$col_fields['record_id'].'">'.$org_filename.'</a>';
				else
					$custfldval = '';
			}
			$label_fld[] =$custfldval;
		}
	elseif($uitype == 69)
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		if($tabid==14)
		{
			$images=array();
			$image_array = array();
			$imagepath_array = array();
			$query = "select productname, ec_attachments.path, ec_attachments.attachmentsid, ec_attachments.name from ec_products left join ec_seattachmentsrel on ec_seattachmentsrel.crmid=ec_products.productid inner join ec_attachments on ec_attachments.attachmentsid=ec_seattachmentsrel.attachmentsid where (ec_attachments.type like '%image%' or ec_attachments.type like '%img%') and productid=".$col_fields['record_id'];
			$result_image = $adb->query($query);
			for($image_iter=0;$image_iter < $adb->num_rows($result_image);$image_iter++)
			{
				$image_id_array[] = $adb->query_result($result_image,$image_iter,'attachmentsid');
				$image_array[] = $adb->query_result($result_image,$image_iter,'name');
				$imagepath_array[] = $adb->query_result($result_image,$image_iter,'path');
			}
			if(count($image_array)>1)
			{
//				if(count($image_array) < 4)
//					$sides=count($image_array)*2;
//				else
//					$sides=8;
//
//				$image_lists = '<div id="Carousel" style="position:relative;vertical-align: middle;">
//					<img src="modules/Products/placeholder.gif" width="571" height="117" style="position:relative;">
//					</div><script>var Car_NoOfSides='.$sides.'; Car_Image_Sources=new Array(';
//
//				for($image_iter=0;$image_iter < count($image_array);$image_iter++)
//				{
//					$images[]='"'.$imagepath_array[$image_iter].$image_id_array[$image_iter]."_".base64_encode_filename($image_array[$image_iter]).'","'.$imagepath_array[$image_iter].$image_id_array[$image_iter]."_".base64_encode_filename($image_array[$image_iter]).'"';
//				}
//				$image_lists .=implode(',',$images).');
	/**</script><script language="JavaScript" type="text/javascript" src="modules/Products/Productsslide.js"></script><script language="JavaScript" type="text/javascript">Carousel();</script>';**/
//				$label_fld[] =$image_lists;

               $num = count($image_array);

                for($image_iter=0;$image_iter < count($image_array);$image_iter++)
				{
					$images[]=$imagepath_array[$image_iter].$image_id_array[$image_iter]."_".base64_encode_filename($image_array[$image_iter]);
				}

				for($i=0;$i<$num;$i++){
                    $image_lists .= '<a href="'.$images[$i].'" target="_blank"><img src="'.$images[$i].'"  border="0" width="150" height="150" ></a> &nbsp;&nbsp;';
				}
		      //end
				$label_fld[] =$image_lists;


			}elseif(count($image_array)==1)
			{
				$label_fld[] ='<a href="'.$imagepath_array[0].$image_id_array[0]."_".base64_encode_filename($image_array[0]).'" target="_blank" ><img src="'.$imagepath_array[0].$image_id_array[0]."_".base64_encode_filename($image_array[0]).'" border="0" width="150" height="150"></a>';
			}else
			{
				$label_fld[] ='';
			}

		}
		if($tabid==4)
		{
			//$imgpath = getModuleFileStoragePath('Contacts').$col_fields[$fieldname];
			$sql = "select ec_attachments.* from ec_attachments inner join ec_seattachmentsrel on ec_seattachmentsrel.attachmentsid = ec_attachments.attachmentsid where (ec_attachments.type like '%image%' or ec_attachments.type like '%img%') and ec_seattachmentsrel.crmid='".$col_fields['record_id']."'";
			$image_res = $adb->query($sql);
			$image_id = $adb->query_result($image_res,0,'attachmentsid');
			$image_path = $adb->query_result($image_res,0,'path');
			$image_name = $adb->query_result($image_res,0,'name');
			$imgpath = $image_path.$image_id."_".base64_encode_filename($image_name);
			$width = 160;
			$height = get_scale_height($imgpath,$width);
			if($image_name != '')
				$label_fld[] ='<img src="'.$imgpath.'" width="'.$width.'" height="'.$height.'" class="reflect" alt="">';
			else
				$label_fld[] = '';
		}

	}

	elseif($uitype==63)
        {
	   $label_fld[] =$mod_strings[$fieldlabel];
	   $label_fld[] = $col_fields[$fieldname].'h&nbsp; '.$col_fields['duration_minutes'].'m';
        }
	elseif($uitype == 6)
        {
		$label_fld[] =$mod_strings[$fieldlabel];
          	if($col_fields[$fieldname]=='0')
                $col_fields[$fieldname]='';
		if($col_fields['time_start']!='')
                {
                       $start_time = $col_fields['time_start'];
                }
		if(!isValidDate($col_fields[$fieldname]))
		{
			$displ_date = '';
		}
		else
		{
			$displ_date = getDisplayDate($col_fields[$fieldname]);
		}

		$label_fld[] = $displ_date.'&nbsp;'.$start_time;
	}
	elseif($uitype == 5 || $uitype == 23 || $uitype == 70)
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$cur_date_val = $col_fields[$fieldname];
		$end_time = "";
		if(isset($col_fields['time_end']) && $col_fields['time_end'] != '' && ($tabid == 9 || $tabid == 16) && $uitype == 23)
		{
			$end_time = $col_fields['time_end'];
		}
		if(!isValidDate($cur_date_val))
		{
			$display_val = '';
		}
		else
		{
			$display_val = getDisplayDate($cur_date_val);
		}
		$label_fld[] = $display_val.'&nbsp;'.$end_time;
	}
	elseif($uitype == 1007) {
		$label_fld[] = isset($mod_strings[$fieldlabel])?$mod_strings[$fieldlabel]:$fieldlabel;
		$cur_approve_val = $col_fields[$fieldname];
		$label_fld[] = getApproveStatusById($cur_approve_val);
	}
	elseif($uitype == 1008) //display approvedby in detailview page
	{
		if(isset($mod_strings[$fieldlabel])) {
			$label_fld[] = $mod_strings[$fieldlabel];
		} else {
			$label_fld[] = $fieldlabel;
		}
		$value = $col_fields[$fieldname];
		$label_fld[] = getUserName($value);
	}
	elseif($uitype == 71 || $uitype == 72)
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$display_val = $col_fields[$fieldname];
        $label_fld[] = $display_val;
	}
	elseif($uitype == 75 || $uitype == 81)
    {
		$vendor_name = "";
		$label_fld[] =$mod_strings[$fieldlabel];
		$vendor_id = $col_fields[$fieldname];
		if($vendor_id != '')
		{
			   $vendor_name = getVendorName($vendor_id);
		}
		$label_fld[] = $vendor_name;
		$label_fld["secid"] = $vendor_id;
		$label_fld["link"] = "index.php?module=Vendors&action=DetailView&record=".$vendor_id;
		//$label_fld[] = '<a href="index.php?module=Products&action=VendorDetailView&record='.$vendor_id.'">'.$vendor_name.'</a>';
    }
	elseif($uitype == 76)
        {
		 $label_fld[] =$mod_strings[$fieldlabel];
           $potential_id = $col_fields[$fieldname];
           if($potential_id != '')
           {
                   $potential_name = getPotentialName($potential_id);
           }
          $label_fld[] = $potential_name;
		$label_fld["secid"] = $potential_id;
		$label_fld["link"] = "index.php?module=Potentials&action=DetailView&record=".$potential_id;
        }
	elseif($uitype == 78)
        {
		 $label_fld[] =$mod_strings[$fieldlabel];
           $quote_id = $col_fields[$fieldname];
           if($quote_id != '')
           {
                   $quote_name = getQuoteName($quote_id);
           }
          $label_fld[] = $quote_name;
		$label_fld["secid"] = $quote_id;
		$label_fld["link"] = "index.php?module=Quotes&action=DetailView&record=".$quote_id;
        }
	elseif($uitype == 79)
        {
 		 $label_fld[] =$mod_strings[$fieldlabel];
           $purchaseorder_id = $col_fields[$fieldname];
           if($purchaseorder_id != '')
           {
                   $purchaseorder_name = getPoName($purchaseorder_id);
           }
           $label_fld[] = $purchaseorder_name;
		 $label_fld["secid"] = $purchaseorder_id;
		 $label_fld["link"] = "index.php?module=PurchaseOrder&action=DetailView&record=".$purchaseorder_id;
        }
	elseif($uitype == 80)
        {
		 $label_fld[] =$mod_strings[$fieldlabel];
           $salesorder_id = $col_fields[$fieldname];
           if($salesorder_id != '')
           {
                   $salesorder_name = getSoName($salesorder_id);
           }
          $label_fld[] = $salesorder_name;
		$label_fld["secid"] = $salesorder_id;
		$label_fld["link"] = "index.php?module=SalesOrder&action=DetailView&record=".$salesorder_id;
    }
	elseif($uitype == 1010)
    {
		$label_fld[] =$mod_strings[$fieldlabel];
		$invoice_id = $col_fields[$fieldname];
		$invoice_name = "";
		if($invoice_id != '')
		{
			$invoice_name = getInvoiceName($invoice_id);
		}
		$label_fld[] = $invoice_name;
		$label_fld["secid"] = $invoice_id;
		$label_fld["link"] = "index.php?module=Invoice&action=DetailView&record=".$invoice_id;
    }
	elseif($uitype == 30)
	{
		$rem_days = 0;
		$rem_hrs = 0;
		$rem_min = 0;
		$reminder_str ="";
		$rem_days = floor($col_fields[$fieldname]/(24*60));
		$rem_hrs = floor(($col_fields[$fieldname]-$rem_days*24*60)/60);
		$rem_min = ($col_fields[$fieldname]-$rem_days*24*60)%60;

		$label_fld[] =$mod_strings[$fieldlabel];
		if($col_fields[$fieldname])
                {
                        $reminder_str= $rem_days.'&nbsp;'.$mod_strings['LBL_DAYS'].'&nbsp;'.$rem_hrs.'&nbsp;'.$mod_strings['LBL_HOURS'].'&nbsp;'.$rem_min.'&nbsp;'.$mod_strings['LBL_MINUTES'].'&nbsp;&nbsp;'.$mod_strings['LBL_BEFORE_EVENT'];
                }
		$label_fld[] = '&nbsp;'.$reminder_str;
	}elseif($uitype == 85) //Added for Skype by Minnie
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$label_fld[]= $col_fields[$fieldname];
	}elseif($uitype == 86) //Added for qq by Minnie
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$label_fld[]= $col_fields[$fieldname];
	}elseif($uitype == 87) //Added for msn by Minnie
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$label_fld[]= $col_fields[$fieldname];
	}elseif($uitype == 88) //Added for trade by Minnie
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$label_fld[]= $col_fields[$fieldname];
	}elseif($uitype == 89) //Added for yahoo by Minnie
	{
		$label_fld[] =$mod_strings[$fieldlabel];
		$label_fld[]= $col_fields[$fieldname];
	} elseif($uitype == 1006)
	{
		//added by dingjianting on 2007-1-27 for new module Exhibitions
		$catalog_name = "";
		$label_fld[] = $mod_strings[$fieldlabel];
		$catalogid = $col_fields[$fieldname];
		if($catalogid != '')
		{
			$catalog_name = getCatalogName($catalogid);
		}
		$label_fld[] = $catalog_name;
		$label_fld["secid"] = $catalogid;
		$label_fld["link"] = "index.php?module=Catalogs&action=CatalogDetailView&parenttab=Product&catalogid=".$catalogid;
	} elseif($uitype == 1009)
	{
		$vcontact_name = "";
		$label_fld[] = $mod_strings[$fieldlabel];
		$vcontactsid = $col_fields[$fieldname];
		if($vcontactsid != '')
		{
			$vcontact_name = getVcontactName($vcontactsid);
		}
		$label_fld[] = $vcontact_name;
		$label_fld["secid"] = $vcontactsid;
		$label_fld["link"] = "index.php?module=Vcontacts&action=DetailView&record=".$vcontactsid;
	}
	elseif($uitype == 1013)
	{
		$faqcategory_name = "";
		$label_fld[] = $mod_strings[$fieldlabel];
		$faqcategoryid = $col_fields[$fieldname];
		if($faqcategoryid != '')
		{
			$faqcategory_name = getFaqcategoryName($faqcategoryid);
		}
		$label_fld[] = $faqcategory_name;
		$label_fld["secid"] = $faqcategoryid;
		$label_fld["link"] = "index.php?module=Faqcategorys&action=FaqcategoryDetailView&faqcategoryid=".$faqcategoryid;
	}
	else
	{
		 $label_fld[] =$mod_strings[$fieldlabel];
		 if($col_fields[$fieldname]=='0') $col_fields[$fieldname]='';
		 $label_fld[] = $col_fields[$fieldname];

	}
	$label_fld[]=$uitype;
	$log->debug("Exiting getDetailViewOutputHtml method ...");
	return $label_fld;
}

/** This function returns a HTML output of associated ec_products for a given entity (Quotes,Invoice,Sales order or Purchase order)
  * Param $module - module name
  * Param $focus - module object
  * Return type string
  */

function getDetailAssociatedProducts($module,$focus)
{
	global $log;
	//changed by dingjianting on 2007-11-05 for php5.2.x
	$log->debug("Entering getDetailAssociatedProducts() method ...");
	global $adb;
	global $theme;
	global $log;
	global $app_strings,$current_user;
	$theme_path="themes/".$theme."/";
	$image_path=$theme_path."images/";
    //changed by dingjianting on 2006-12-29 for gloso project
	if($module != 'PurchaseOrder')
	{
		if($module == '') {//changed by dingjianting on 2007-2-25 for gloso project and quote
			//$colspan = '4';
			$colspan = '7';
		} else {
			$colspan = '8';
		}
	}
	else
	{
		//$colspan = '3';
		$colspan = '7';
	}

	//Get the taxtype of this entity
	//$taxtype = getInventoryTaxType($module,$focus->id);

	$output = '';
	//Header Rows
	$output .= '<table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0" class="crmTable" id="proTab">
	   <tr valign="top">
	   	<td colspan="'.$colspan.'" class="dvInnerHeader"><b>'.$app_strings['LBL_PRODUCT_DETAILS'].'</b></td>
	   </tr>
	   <tr valign="top">
		<td width=20% class="lvtCol">
			<b>'.$app_strings['LBL_PRODUCT_NAME'].'</b>
		</td>';
	$output .= '<td width=10% class="lvtCol"><b>'.$app_strings['LBL_PRODUCT_CODE'].'</b></td>';
	$output .= '<td width=15% class="lvtCol"><b>'.$app_strings['LBL_PRODUCT_SERIALNO'].'</b></td>';

	//Add Quantity in Stock column for SO, Quotes and Invoice
	if($module == 'Quotes' || $module == 'SalesOrder' || $module == 'Invoice')
		$output .= '<td width=10% class="lvtCol"><b>'.$app_strings['LBL_QTY_IN_STOCK'].'</b></td>';

	$output .= '
	    <td width=10% class="lvtCol"><b>'.$app_strings['LBL_QTY'].'</b></td>
		<td width=10% class="lvtCol" align="left"><b>'.$app_strings['LBL_LIST_PRICE'].'</b></td>
		<td width=15% wrap class="lvtCol" align="left"><b>'.$app_strings['LBL_COMMENT'].'</b></td>';
	if($module != '') {//changed by dingjianting on 2007-2-25 for gloso project and quote
		$output .= '
			<td width=10% nowrap class="lvtCol" align="right"><b>'.$app_strings['LBL_PRODUCT_TOTAL'].'</b></td>';
	}
	$output .= '</tr>';


	// DG 15 Aug 2006
	// Add "ORDER BY sequence_no" to retain add order on all inventoryproductrel items

	if($module == 'Quotes')
	{
		$query="select ec_products.productname,ec_products.unit_price,ec_products.qtyinstock,ec_products.productcode,ec_products.serialno, ec_inventoryproductrel.* from ec_inventoryproductrel inner join ec_products on ec_products.productid=ec_inventoryproductrel.productid where id=".$focus->id." ORDER BY sequence_no";
	}
	elseif($module == 'PurchaseOrder')
	{
		$query="select ec_products.productname,ec_products.unit_price,ec_products.qtyinstock,ec_products.productcode,ec_products.serialno,ec_inventoryproductrel.* from ec_inventoryproductrel inner join ec_products on ec_products.productid=ec_inventoryproductrel.productid where id=".$focus->id." ORDER BY sequence_no";
	}
	elseif($module == 'SalesOrder')
	{
		$query="select ec_products.productname,ec_products.unit_price,ec_products.qtyinstock,ec_products.productcode,ec_products.serialno,ec_inventoryproductrel.* from ec_inventoryproductrel inner join ec_products on ec_products.productid=ec_inventoryproductrel.productid where id=".$focus->id." ORDER BY sequence_no";
	}
	elseif($module == 'Invoice')
	{
		$query="select ec_products.productname,ec_products.unit_price,ec_products.qtyinstock,ec_products.productcode,ec_products.serialno,ec_inventoryproductrel.* from ec_inventoryproductrel inner join ec_products on ec_products.productid=ec_inventoryproductrel.productid where id=".$focus->id." ORDER BY sequence_no";
	}

	$result = $adb->query($query);
	$num_rows=$adb->num_rows($result);
	$netTotal = '0.00';
	for($i=1;$i<=$num_rows;$i++)
	{
		$productid=$adb->query_result($result,$i-1,'productid');
		$productname=$adb->query_result($result,$i-1,'productname');
		$comment=$adb->query_result($result,$i-1,'comment');
		if(empty($comment)) $comment = "&nbsp;";
		$qtyinstock=$adb->query_result($result,$i-1,'qtyinstock');
		$qty=$adb->query_result($result,$i-1,'quantity');
		$unitprice=$adb->query_result($result,$i-1,'unit_price');
		$listprice=$adb->query_result($result,$i-1,'listprice');
		$total = $qty*$listprice;
		$unitprice = convertFromDollar($unitprice,1);
		$listprice = convertFromDollar($listprice,1);
		$total = convertFromDollar($total,1);
		$netprice = $total;
		$productcode = $adb->query_result($result,$i-1,'productcode');
		$serial_no = $adb->query_result($result,$i-1,'serialno');

		//For Product Name
		$output .= '
			   <tr valign="top">
				<td class="crmTableRow small lineOnTop">&nbsp;<a href="index.php?action=DetailView&module=Products&record='.$productid.'" target="_blank">'.$productname.'</a></td>';
		//Upto this added to display the Product name and comment
		$output .= '<td class="crmTableRow small lineOnTop" nowrap>&nbsp;'.$productcode.'</td>';
		$output .= '<td class="crmTableRow small lineOnTop" nowrap>&nbsp;'.$serial_no.'</td>';
		if($module != 'PurchaseOrder')
		{
			$output .= '<td class="crmTableRow small lineOnTop">&nbsp;'.$qtyinstock.'</td>';
		}
		$output .= '<td class="crmTableRow small lineOnTop">&nbsp;'.$qty.'</td>';
		$output .= '<td class="crmTableRow small lineOnTop">&nbsp;'.$listprice.'</td>';
		$output .= '<td class="crmTableRow small lineOnTop" valign="bottom" align="left">&nbsp;'.$comment.'</td>';
		if($module != '') {//changed by dingjianting on 2007-2-25 for gloso project and quote
			$output .= '<td class="crmTableRow small lineOnTop" align="right">&nbsp;'.$total.'</td>';
	    }
		$output .= '</tr>';
		$netTotal = $netTotal + $netprice;
	}

	$output .= '</table>';

	//$netTotal should be equal to $focus->column_fields['hdnSubTotal']
	$netTotal = $focus->column_fields['hdnSubTotal'];
	$netTotal = convertFromDollar($netTotal,1);

	//Display the total, adjustment, S&H details
	$output .= '<table width="100%" border="0" cellspacing="0" cellpadding="5" class="crmTable">';
	//Decide discount
	if($module != '') {//changed by dingjianting on 2007-2-25 for gloso project and quote
		$finalDiscount = '0.00';
		if($focus->column_fields['hdnDiscountPercent'] != '' && $focus->column_fields['hdnDiscountPercent'] != '0.0')
		{
			$finalDiscount = ($focus->column_fields['hdnSubTotal']*$focus->column_fields['hdnDiscountPercent']/100);
			////changed by dingjianting on 2006-11-10 for simplized chinese
			//$final_discount_info = $focus->column_fields['hdnDiscountPercent']." % of $netTotal = $finalDiscount";
			$final_discount_info = $focus->column_fields['hdnDiscountPercent']." % X $netTotal = $finalDiscount";
		}
		elseif($focus->column_fields['hdnDiscountAmount'] != '')
		{
			$finalDiscount = $focus->column_fields['hdnDiscountAmount'];
			$finalDiscount = convertFromDollar($finalDiscount,1);
			$final_discount_info = $app_strings['LBL_FINAL_DISCOUNT_AMOUNT']." = $finalDiscount";
		}
		if($final_discount_info != '')
			$final_discount_info = 'onclick="alert(\''.$final_discount_info.'\');"';

		$output .= '<tr>';
		$output .= '<td width="80%" align="right" class="crmTableRow small lineOnTop">(-)&nbsp;<b><a href="javascript:;" '.$final_discount_info.'>'.$app_strings['LBL_DISCOUNT'].'</a></b></td>';
		$output .= '<td width="20%" align="right" class="crmTableRow small lineOnTop">'.$finalDiscount.'</td>';
		$output .= '</tr>';

		$shAmount = ($focus->column_fields['hdnS_H_Amount'] != '')?$focus->column_fields['hdnS_H_Amount']:'0.00';
		$shAmount = convertFromDollar($shAmount,1);
		$output .= '<tr>';
		$output .= '<td align="right" class="crmTableRow small">(+)&nbsp;<b>'.$app_strings['LBL_SHIPPING_AND_HANDLING_CHARGES'].'</b></td>';
		$output .= '<td align="right" class="crmTableRow small">'.$shAmount.'%</td>';
		$output .= '</tr>';


		$adjustment = ($focus->column_fields['txtAdjustment'] != '')?$focus->column_fields['txtAdjustment']:'0.00';
		$adjustment = convertFromDollar($adjustment,1);
		$output .= '<tr>';
		$output .= '<td align="right" class="crmTableRow small">&nbsp;<b>'.$app_strings['LBL_ADJUSTMENT'].'</b></td>';
		$output .= '<td align="right" class="crmTableRow small">'.$adjustment.'</td>';
		$output .= '</tr>';

		$grandTotal = ($focus->column_fields['hdnGrandTotal'] != '')?$focus->column_fields['hdnGrandTotal']:'0.00';
		$grandTotal = convertFromDollar($grandTotal,1);
		$output .= '<tr>';
		$output .= '<td align="right" class="crmTableRow small lineOnTop"><b>'.$app_strings['LBL_GRAND_TOTAL'].'</b></td>';
		$output .= '<td align="right" class="crmTableRow small lineOnTop">'.$grandTotal.'</td>';
		$output .= '</tr>';
	}
	$output .= '</table>';

	$log->debug("Exiting getDetailAssociatedProducts method ...");
	return $output;

}

/** This function returns the related ec_tab details for a given entity or a module.
* Param $module - module name
* Param $focus - module object
* Return type is an array
*/

function getRelatedLists($module,$focus)
{  
	
	global $log;
	//changed by dingjianting on 2007-11-05 for php5.2.x
	$log->debug("Entering getRelatedLists() method ...");
	$focus_list = array();
	$relatedLists = array();
	global $adb;
	$cur_tab_id = getTabid($module);
	$sql1 = "select ec_relatedlists.*,ec_tab.name as related_tabname from ec_relatedlists left join ec_tab on ec_tab.tabid=ec_relatedlists.related_tabid where ec_relatedlists.tabid=".$cur_tab_id." and ec_relatedlists.presence=0 order by sequence";

	$result = $adb->query($sql1);
	$num_row = $adb->num_rows($result);
	for($i=0; $i<$num_row; $i++)
	{
		$rel_tab_id = $adb->query_result($result,$i,"related_tabid"); 
		$related_tabname = $adb->query_result($result,$i,"related_tabname"); 
		$function_name = $adb->query_result($result,$i,"name");  
		$label = $adb->query_result($result,$i,"label");
 
		if(method_exists($focus,$function_name)) {

			if($function_name != "get_generalmodules" && $function_name != "get_child_list" && $function_name != "get_parent_list") {

				$focus_list[$label] = $focus->$function_name($focus->id);
			} else {

				$focus_list[$label] = $focus->$function_name($focus->id,$related_tabname);
			}
		}
		
	}

	/*
	$approvehistory=getApproveHistory($focus->id);
	if($approvehistory!==false){
		$focus_list['审批历史']=$approvehistory;
	}
	*/
	
	$log->debug("Exiting getRelatedLists method ...");
	return $focus_list;
}

/** This function returns the detailed block information of a record in a module.
* Param $module - module name
* Param $block - block id
* Param $col_fields - column ec_fields array for the module
* Param $tabid - ec_tab id
* Return type is an array
*/

function getDetailBlockInformation($module, $result,$col_fields,$tabid,$block_label)
{
	global $log;
	//changed by dingjianting on 2007-11-05 for php5.2.x
	$log->debug("Entering getDetailBlockInformation() method ...");
	global $adb;
	global $mod_strings;
	$label_data = Array();
	$returndata = Array();
	$noofrows = $adb->num_rows($result);
	
	for($i=0; $i<$noofrows; $i++)
	{	
		$fieldtablename = $adb->query_result($result,$i,"tablename");
		$fieldcolname = $adb->query_result($result,$i,"columnname");
		$uitype = $adb->query_result($result,$i,"uitype");
		$fieldname = $adb->query_result($result,$i,"fieldname"); 
		$fieldlabel = $adb->query_result($result,$i,"fieldlabel");
		$maxlength = $adb->query_result($result,$i,"maximumlength");
		$block = $adb->query_result($result,$i,"block");
		$generatedtype = $adb->query_result($result,$i,"generatedtype");
		$displaytype = $adb->query_result($result,$i,"displaytype");
		$tabid = $adb->query_result($result,$i,"tabid");
		$custfld = getDetailViewOutputHtml($uitype, $fieldname, $fieldlabel, $col_fields,$generatedtype,$tabid);
		if(is_array($custfld))
		{
			$link = isset($custfld["link"]) ? $custfld["link"] : "";
			$label_data[$block][] = array($custfld[0]=>array("value"=>$custfld[1],"ui"=>$custfld[2],"link"=>$link,"fldname"=>$fieldname));
		}
		$i++; 
		if($i<$noofrows)
		{
			$fieldtablename = $adb->query_result($result,$i,"tablename");
			$fieldcolname = $adb->query_result($result,$i,"columnname");
			$uitype = $adb->query_result($result,$i,"uitype");
			$fieldname = $adb->query_result($result,$i,"fieldname");
			$fieldlabel = $adb->query_result($result,$i,"fieldlabel");
			$maxlength = $adb->query_result($result,$i,"maximumlength");
			$block = $adb->query_result($result,$i,"block");
			$generatedtype = $adb->query_result($result,$i,"generatedtype");
			$displaytype = $adb->query_result($result,$i,"displaytype");
			$tabid = $adb->query_result($result,$i,"tabid"); 
			$custfld = getDetailViewOutputHtml($uitype, $fieldname, $fieldlabel, $col_fields,$generatedtype,$tabid);

			if(is_array($custfld))
			{

				$link = isset($custfld["link"]) ? $custfld["link"] : "";
				$label_data[$block][] = array($custfld[0]=>array("value"=>$custfld[1],"ui"=>$custfld[2],"link"=>$link,"fldname"=>$fieldname));
			}
		}
		
	}  
	foreach($label_data as $headerid=>$value_array)
	{
		$detailview_data = Array();
		for ($i=0,$j=0;$i<count($value_array);$i=$i+2,$j++)
		{
			$key2 = null;
			$keys=array_keys($value_array[$i]);
			$key1=$keys[0];
			if(isset($value_array[$i+1]) && is_array($value_array[$i+1]))
			{
				$keys= array_keys($value_array[$i+1]);
				$key2= $keys[0];
			}
			$value_ke2 = "";
			if(isset($value_array[$i+1][$key2])) {
				$value_ke2 = $value_array[$i+1][$key2];
			}
			$detailview_data[$j]=array($key1 => $value_array[$i][$key1],$key2 => $value_ke2);
		}
		$label_data[$headerid] = $detailview_data;
	}
	foreach($block_label as $blockid=>$label)
	{
		if($label == '')
		{
			if(isset($mod_strings[$curBlock])) {
				$curBlock = $mod_strings[$curBlock];
			}
			$returndata[$curBlock] = array_merge((array)$returndata[$curBlock],(array)$label_data[$blockid]);
		}
		else
		{
			$curBlock = $label;
			if(isset($mod_strings[$label])) {
				$label = $mod_strings[$label];
			}

			if(isset($returndata[$label]) && is_array($returndata[$label])) {
				$returndata_arr = $returndata[$label];
			} else {
				$returndata_arr = array();
			}
			if(isset($label_data[$blockid]) && is_array($label_data[$blockid])) {
				$returndata[$label] = array_merge((array)$returndata_arr,(array)$label_data[$blockid]);
			}
		}
	}
	$log->debug("Exiting getDetailBlockInformation method ...");
	return $returndata;


}

function detailViewNavigation($module,$record,$isNext=false){
	if(isset($_SESSION[$module.'_listquery'])){
		global $list_max_entries_per_page,$adb,$log;
		$query = $_SESSION[$module.'_listquery'];
		/*
		$noofrows = $_SESSION[$module.'_listrows'];
		$start = $_SESSION['lvs'][$module]['start'];
		//Retreive the Navigation array
		$navigation_array = getNavigationValues($start, $noofrows, $list_max_entries_per_page);
		//Postgres 8 fixes
		if( $adb->dbType == "pgsql")
			 $query = fixPostgresQuery( $query, $log, 0);

		$start_rec = $navigation_array['start'];
		$end_rec = $navigation_array['end_val'];
		//limiting the query
		if ($start_rec == 0)
			$limit_start_rec = 0;
		//elseif($start_rec == 1)
		//	$limit_start_rec = 0;
		else
			$limit_start_rec = $start_rec - 1;//for previous record if record is first , then get last of previous page
		//$max_entries = $list_max_entries_per_page + 1;//for next record if record is last , then get first of next page
		$max_entries = $list_max_entries_per_page;
		 if( $adb->dbType == "pgsql")
			 $list_result = $adb->query($query. " OFFSET ".$limit_start_rec." LIMIT ".$max_entries);
		 else {
			 $query = $query. " LIMIT ".$limit_start_rec.",".$max_entries;
			 $list_result = $adb->query($query);
		 }
		 */
		 $list_result = $adb->query($query);
		 $num_row1 = $adb->num_rows($list_result);
		 for($i=0;$i<$num_row1;$i++) {
			 $crmid = $adb->query_result($list_result,$i,"crmid");
			 if($crmid == $record) {
				 if($isNext) {
					 if($i == ($num_row1-1)) {//last record,no next record
						 return false;
					 }
					 $nextcrmid = $adb->query_result($list_result,($i+1),"crmid");
					 return $nextcrmid;
				 } else {
					 if($i == 0) {//first record , no previous record
						return false;
					 }
					 $precrmid = $adb->query_result($list_result,($i-1),"crmid");
					 return $precrmid;
				 }

			 }
		 }
	}
	return false;
}

?>
