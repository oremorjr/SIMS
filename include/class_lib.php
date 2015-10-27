<?php
require('db_config.php');

$db=new DB();


class User{
 
    public function login_() 
	{
		  if (isset($_SESSION["SESS_MEMBER_UID"]))
		  {
			header("Location: home/welcome");
			exit;
		  }       
    }
	public function not_login_(){
		if(!isset($_SESSION['SESS_MEMBER_UID'])){
			header("location: ../login");
		}
	}

    public function user_logout() {
        $_SESSION['SESS_MEMBER_UID'] = FALSE;
        session_destroy();
		
    }
	function curPageName() {
		if(isset($_GET['page'])){
			return $page_name=$_GET['page'].'.php';
		}else{
			return $page_name="index.php";
		}
	}

	
	
	
}
class User_Record {
	
	private $query;
	private $where;
	private $order;
	private $result = array();

	var $lastQuery;


	# selects the data from the table
	public function select($query, $where, $order) {
		
		$this->query = $query;
		$this->where = ($where == NULL) ? NULL : $where;
		$this->order = ($order == NULL) ? NULL : $order;
		
		$fullQuery = $this->query . $this->where . $this->order;
		$this->lastQuery = $fullQuery;
		$this->result = mysql_query($fullQuery);
		
		if ($this->result()) { return true; }
		
		return false;
		
	}
	
	# used to validate result from select()
	private function result() {
		
		if ($this->result) { return true; }
		
		echo mysql_error();
		return false;
	
	}

	# displays the data from the select() member
	public function display() {
		
		if ($this->select($this->query, $this->where, $this->order)) {
		
			echo '<h3>' . $this->lastQuery . '</h3><br />';
		
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				echo '<b>' . $row['UID'] . ' </b>' . $row['fname'] . '<br />';
			}
			
			return true;
			
		}
		
		return false;
	
	}

}
class all_users {
	
	private $query;
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	//DB FIELDS
	public $fullname, $access, $utype, $photo, $UTID, $status;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {

			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->fullname= $row['fname'];
				$this->utype=$row['user_type'];
				$this->access=$row['last_access'];
				$this->photo=$row['user_photo'];
				$this->UTID=$row['utype'];
				$this->status=$row['u_login'];
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
}
class company {
	
	private $query;

	
	//DB FIELDS
	public $name, $logo, $address, $contact, $currency, $cp, $tagline, $tin;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {

			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->name= $row['company_name'];
				$this->logo= $row['company_logo'];
				$this->address= $row['s_address'];
				$this->contact= $row['s_contact_no'];
				$this->currency= $row['s_currency'];
				$this->cp= $row['st_cp_no'];
				$this->tagline= $row['s_tagline'];
				$this->tin= $row['s_TIN'];
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
}
class receipt {
	
	private $query;

	
	//DB FIELDS
	public $tno, $tdate, $staff, $customer, $supplier, $t_rno;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {

			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->tno= $row['t_receiptno'];
				$this->tdate= $row['t_trans_date'];
				$this->supplier= $row['t_supplier_id'];
				$this->customer= $row['t_customer_id'];
				$this->t_rno= $row['t_rno'];
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
}



class supplier {
	
	private $query;

	
	//DB FIELDS
	public $name, $code, $contact, $t_count, $id, $sup_address1;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
			$this->t_count=mysql_num_rows($this->result);
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->name= $row['sup_name'];
				$this->id= $row['SID'];
				$this->sup_address1= $row['sup_address1'];
				$this->contact= $row['sup_contact_no'];
				$id=$this->id;
				$q=mysql_query("SELECT * from osd_product_unit where p_supplier_unit_id=$id ");
				$qc=mysql_num_rows($q);				
						?>
						<tr id="list-<?php echo $id;?>">
							<td width="15%"><?php echo $id;?></td>
                          					<td><div class="n1-<?php echo $id;?>"><?php echo $this->name; ?></div>
                          					<div class="sub n2-<?php echo $id;?>"><?php echo $this->sup_address1; ?></div>
                          					</td>
 
							<td>
							 <?php
							 if(current_user('edit-supplier')):
							 ?>
							<a  data-value="<?php echo $this->id; ?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-edit"></i> Edit
							</a>
							<?php
							endif;
							if($qc==0){
							if(current_user('delete-supplier')):
							?>
							<a id="delete_id"  data-value="<?php echo $this->id; ?>" data-toggle="modal" data-original-title="del" data-placement="bottom"  href="#del-modal"   class="btn_delete btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-remove"></i>
							</a>	
							<?php
							endif;
							}
							?>							
							</td>							  
						  

                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}



	# selects the data from the table
	public function select_home($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
			$this->t_count=mysql_num_rows($this->result);
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->name= $row['sup_name'];
				$this->id= $row['SID'];
				$this->sup_address1= $row['sup_address1'];
				$this->contact= $row['sup_contact_no'];
				$id=$this->id;
				$q=mysql_query("SELECT * from osd_product_unit where p_supplier_unit_id=$id ");
				$qc=mysql_num_rows($q);				
						?>
						<tr>
                          					<td><div><a href="?page=receivings&amp;ID=<?php echo $this->id;?>"  ><?php echo $this->name; ?></a></div>
                          					<div style="font-size:11px;font-style:italic;"><?php echo $this->sup_address1; ?></div>
                          					</td>
 
							 

                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}













	public function select_link($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
			$this->t_count=mysql_num_rows($this->result);
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->name= $row['sup_name'];
				$this->code= $row['sup_code'];
				$this->contact= $row['sup_contact_no'];
						?>
						<tr>
                          <td><?php echo $this->code; ?></td>
                          <td><?php echo $this->name; ?></td>
                          <td><?php echo $this->contact; ?></td>
						  <td><a href="?page=choose-category&SID=<?php echo $this->code;?>">Choose this supplier</a></td>
                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}	
	
	
	# selects the data from the table
	public function select_list($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {

			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->name= $row['sup_name'];
				$this->code= $row['sup_code'];
				$this->contact= $row['sup_contact_no'];
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}	
	
	
	
}
class category {
	
	private $query;

	
	//DB FIELDS
	public $name, $code, $t_count;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;
	# selects the data from the table
	public function select_list($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->name= $row['cat_name'];
				$this->code= $row['CID'];
				
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->name= $row['cat_name'];
				$this->code= $row['CID'];
				$id=$this->code;
				$q=mysql_query("SELECT * from osd_product where p_category_id=$id ");
				$qc=mysql_num_rows($q);
						?>
						<tr  id="del_<?php echo $this->code; ?>">
                          <td><?php echo $this->code; ?></td>
                          <td><?php echo $this->name; ?></td>
                         <td>
                         	<?php if(current_user('edit-category')):?>
							<a  data-value="<?php echo $this->code; ?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-edit"></i> Edit
							</a>
		<?php endif;?>
							<?php
							if($qc==0){
							?>
							<a id="delete_id"  data-value="<?php echo $this->code; ?>" data-toggle="modal" data-original-title="del" data-placement="bottom"  href="#del-modal"   class="btn_delete btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-remove"></i>
							</a>	
							<?php
							}
							?>							
							</td>
                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
}
class category_link {
	
	private $query;

	
	//DB FIELDS
	public $name, $code;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->name= $row['cat_name'];
				$this->code= $row['CID'];
						?>
						<tr>
                          <td><?php echo $this->name; ?></td>
						  <td><a href="?page=view-product&SID=<?php echo $_GET['SID']?>&CID=<?php echo $this->code;?>">Select this category</a></td>
                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
}

class product {
	
	private $query;

	
	//DB FIELDS
	public $id, $name, $code, $stock, $price, $t_count, $cat_name, $sup_name, $sup_id, $cid, $level, $selling_price, $unit_id, $image, $brand;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;
	# selects the data from the table
	public function select_list($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
			$this->t_count=mysql_num_rows($this->result);
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {				
				$this->id= $row['PID'];
				$this->name= $row['p_name'];
				$this->code= $row['p_pcode'];
				$this->cat_name= $row['cat_name'];
				$this->cid= $row['CID'];  
				$this->level= $row['p_reorder_level']; 
				$this->image= $row['p_image_name']; 
				$this->brand= $row['p_brand']; 
				
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
	public function select_list2($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
			$this->t_count=mysql_num_rows($this->result);
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {				
				$this->id= $row['PID'];
				$this->name= $row['p_name'];
				$this->code= $row['p_pcode'];
				$this->cat_name= $row['cat_name'];
				$this->cid= $row['CID']; 
				$this->sup_id= $row['p_supplier_id'];
				$this->level= $row['p_reorder_level'];  
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}	
	
	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
			$this->t_count=mysql_num_rows($this->result);
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->id= $row['PID'];
				$this->name= $row['p_name'];
				$this->code= $row['p_pcode'];
				$id=$this->id;
				$q=mysql_query("SELECT * from osd_product_unit where pu_product_code=$id ");
				$qc=mysql_num_rows($q);	
				$q2=mysql_query("SELECT * from osd_unit_item where ui_pid=$id and ui_status=1 ");
				$qc2=mysql_num_rows($q2);	
				$this->brand= $row['p_brand']; 
				$d=' ';
				if($qc2==0){
				$d='disabled="disabled" ';
				}					
						?>
						<tr  id="del_<?php echo $this->id; ?>">
                          <td width="10%"><?php echo $this->id; ?></td>
                          
                          <td width="50%">
						  <div><?php echo $this->name; ?></div>
						  <div style="font-size:10px;"><?php echo $this->brand; ?></div>
						 
						  </td>
						  <td>
							<!-- <a   <?php echo $d;?> href="?page=add-image&PID=<?php echo $this->id;?>" class="btn_update btn btn-sm btn-default minimize-box">
							<i class="glyphicon glyphicon-plus-sign"></i>
							</a> -->
							<a  <?php echo $d;?> href="?page=view-product-list&PID=<?php echo $this->id;?>" class="btn_update btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-list-alt"></i> 
							</a>
							<a   data-value="<?php echo $this->id; ?>" data-toggle="modal" data-original-title="unit" data-placement="bottom"  href="#unit-modal"   class="btn_unit btn btn-sm btn-default minimize-box">
							<i class="glyphicon glyphicon-wrench"></i> 
							</a> 							
						 					   
							 
							<a  <?php echo $d;?> data-value="<?php echo $this->id; ?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-edit"></i> 
							</a> 
							<?php
							if($qc==0){
							?>
							<a id="delete_id"  data-value="<?php echo $this->id; ?>" data-toggle="modal" data-original-title="del" data-placement="bottom"  href="#del-modal"   class="btn_delete btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-remove"></i>
							</a>								
							<?php
							}
							?>							
							</td>								  
                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}

	
	
}

 
 

class product_list {
	
	private $query;

	
	//DB FIELDS
	public $unit, $price, $stock, $dateop, $batchno;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->unit= $row['u_name'];
				$this->price= $row['pu_price'];
				$this->stock= $row['pu_stocks'];
				$this->batchno= $row['pu_batchno'];
				$this->dateop= $row['pu_datepurchased'];
						?>
						<tr>
							<td><?php echo $this->batchno; ?></td>
							<td><?php echo $this->dateop; ?></td>
							<td><?php echo $this->unit; ?></td>
							<td>₱<?php echo $this->price; ?></td>
							<td><?php echo $this->stock; ?></td>
                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
}

class unit {
	
	private $query;

	
	//DB FIELDS
	public $unit, $symbol, $id, $uiid, $status, $price, $s_price;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->unit= $row['u_name'];
				$this->symbol= $row['u_symbol'];
				$this->id= $row['UID'];
				$id=$this->id;
				$q=mysql_query("SELECT * from osd_unit_item where ui_uid=$id and ui_status=1 ");
				$qc=mysql_num_rows($q);				
						?>
						<tr  id="del_<?php echo $this->id; ?>" class="list-<?php echo $this->id; ?>">
							<td width="15%"><?php echo $this->id; ?></td>
							<td class="n1-<?php echo $this->id;?>"><?php echo $this->unit; ?></td>
							<td class="n2-<?php echo $this->id;?>"><?php echo $this->symbol; ?></td>
							<td>
							<?php 
							if(current_user('edit-unit')):
							?>
							<a  data-value="<?php echo $this->id; ?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-edit"></i>
							</a>
							<?php
							endif;
							if($qc==0){
							if(current_user('delete-unit')):
							?>
							<a  id="delete_id" data-value="<?php echo $this->id; ?>" data-toggle="modal" data-original-title="del" data-placement="bottom"  href="#del-modal"   class="btn_delete btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-edit"></i>DEL
							</a>							
							<?php
							endif;
							}

							?>							
							</td>							
                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
	# selects the data from the table
	public function select_combo($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
		if($this->t_count!=0){
			$i=0;
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->unit= $row['u_name'];
				$this->symbol= $row['u_symbol'];
				$this->id=$row['UIID'];
				$this->status=$row['ui_status'];
				$this->price=$row['ui_selling_price'];
				$this->s_price=$row['ui_supplier_price'];
				$c='';
				$s="display:none;";
				$i++;
				if($this->status==1){
					$c='checked';
					$s="";
				}
						?>
						<tr>
						<td>
					
						<div class="col-lg-12 c_label"><?php echo $this->unit;?>  </div>
						</td> 
 

 					
						<td>
						<div class="col-lg-4">
						<div id="c_<?php echo $this->id;?>" class="onoffswitch">
							<input type="hidden" name="count[]" value="<?php echo $i;?>">
							<input type="hidden" id="status_<?php echo $this->id;?>" name="status_<?php echo $i;?>" value="<?php echo $this->id;?>">
							<input type="checkbox" <?php echo $c;?> data-value="<?php echo $this->id;?>" class="onoffswitch-checkbox unitcheck" id="myonoffswitch<?php echo $this->id;?>" name="f_<?php echo $i;?>" value="1" >
							<label class="onoffswitch-label" for="myonoffswitch<?php echo $this->id;?>">
								<div class="onoffswitch-inner"></div>
								<div class="onoffswitch-switch"></div>
							</label>
							
						</div>
						</div>						

						
					 
						</td>


						</tr>
 				
	 				
						 
						<?php
			}
			}else{
			 
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
	public function select_combo2($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->unit= $row['u_name'];
				$this->symbol= $row['u_symbol'];
				$this->uiid= $row['UIID'];
						?>
						<option value="<?php echo $this->uiid;?>">
						<?php echo $this->unit;?>
						</option>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}	
	
}

class customer {
	
	private $query;

	
	//DB FIELDS
	public $cid, $fname, $lname, $c_address1;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->cid= $row['CID'];
				$this->fname= $row['c_firstname'];
				$this->lname= $row['c_lastname'];
				$this->c_address1= $row['c_address1'];
				$id=$this->cid;
				$q=mysql_query("SELECT * from osd_transaction where t_customer_id=$id ");
				$qc=mysql_num_rows($q);						
						?>
						<tr id="del_<?php echo $this->cid; ?>" class="list-<?php echo $this->cid; ?>">
							<td width="1%"><?php echo $this->cid; ?></td>
							<td><div class="n1-<?php echo $this->cid; ?>"><?php echo $this->fname; ?></div>
							<div class="sub n2-<?php echo $this->cid; ?>"><?php echo $this->c_address1; ?></div>
							</td> 
							<td>
							 <?php if(current_user('edit-customer')): ?>							
							<a  title="Edit Customer" data-value="<?php echo $this->cid; ?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-edit"></i> 
							</a>						
							<?php
							endif;
							if($qc==0){
							if(current_user('delete-customer')):
							?>
							<a id="delete_id" title="Delete Customer" data-value="<?php echo $this->cid; ?>" data-toggle="modal" data-original-title="del" data-placement="bottom"  href="#del-modal"   class="btn_delete btn btn-sm btn-default minimize-box">
								<i class="glyphicon glyphicon-remove"></i>
							</a>	
							<?php
							endif;
							}
							?>								
							
							</td>
                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}




	public function home_customer($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->cid= $row['CID'];
				$this->fname= $row['c_firstname'];
				$this->lname= $row['c_lastname'];
				$this->c_address1= $row['c_address1'];
				$id=$this->cid;
				$q=mysql_query("SELECT * from osd_transaction where t_customer_id=$id ");
				$qc=mysql_num_rows($q);						
						?>
						<tr id="del_<?php echo $this->cid; ?>">
							 
							<td><div><a  href="?page=pos&ID=<?php echo $this->cid; ?>"   ><?php echo $this->fname; ?></a></div>
							<div style="font-size:11px;font-style:italic;"><?php echo $this->c_address1; ?></div>
							</td> 
							 
                        </tr>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}











	# selects the data from the table
	public function select_combo($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->unit= $row['u_name'];
				$this->symbol= $row['u_symbol'];
				$this->id= $row['UID'];
						?>
						<option value="<?php echo $this->id;?>">
						<?php echo $this->unit;?>
						</option>
						<?php
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
}


class sales {
	
	private $query;

	
	//DB FIELDS
	public $id, $t_trans_date, $amount, $RNO, $total, $profit, $disc;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
			$a=0;
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->id= $row['TID'];
				$this->RNO= $row['t_receiptno'];
				$dt= $row['t_trans_date'];
				$date=date('M d, Y', strtotime($dt));
				$this->amount= $row['t_amount_t'];
				$amount=number_format($this->amount, 2, '.', ',');
				$id=$this->id;	
				$a=$a+$this->amount;
				$this->total=$a;
				$this->profit=$row['t_profit'];
				$this->disc=$row['t_disc'];
				
				
						?>
						<tr id="del_<?php echo $id; ?>">
							<td width="1%"><?php echo $this->RNO; ?></td>
							<td><?php echo $date; ?></td>
							<td><?php echo $amount; ?></td>
							<td><?php echo $this->profit; ?></td>
							<td><?php echo $this->disc; ?></td>
						 
							<td>
							<a href="?page=view-receipt&mode=1&TID=<?php echo $this->id; ?>"  class="btn_del btn btn-sm btn-default">
								<i class="glyphicon glyphicon-barcode"></i> Receipt
							</a></td>

                        </tr>
						<?php
			}
			
			
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
 
}

class user_transaction {
	
	private $query;

	
	//DB FIELDS
	public $current_tno;
	//
	private $result = array();
	
	public $data = array(array());
	public $row = array();

	var $lastQuery;

	# selects the data from the table
	public function select($query) {
		
		$this->query = $query;

		$this->lastQuery = $this->query;
		$this->result = @mysql_query($this->query);
		
		if ($this->result) {
		$this->t_count=mysql_num_rows($this->result);	
			while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
				$this->current_tno= $row['t_receiptno'];
			}
			#var_dump ($this->data);
			return true;	
		}
		
		# if it makes it here there is a problem!
		echo mysql_error();
		return false;
	}
 
}

function plural($amount, $singular = '', $plural = 's' ) {
    if ( $amount <= 1 )
        return $singular;
    else
        return $plural;
}	

 
?>