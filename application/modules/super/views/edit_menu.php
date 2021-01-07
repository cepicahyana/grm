<?php 
$id=isset($data->id_menu)?($data->id_menu):'';
$nama=isset($data->nama)?($data->nama):'';
$level=isset($data->level)?($data->level):'';
$id_main=isset($data->id_main)?($data->id_main):'';
$dropdown=isset($data->dropdown)?($data->dropdown):'';	
$icon=isset($data->icon)?($data->icon):'';		
$role=isset($data->hak_akses)?($data->hak_akses):'';	
$link=isset($data->link)?($data->link):'';
$target=isset($data->target)?($data->target):'';		
//countmain
$countmain=$this->db->query("SELECT COUNT(id_main) AS a FROM main_menu WHERE level='2' AND id_main='".$id."'")->row();
$cmain=$countmain->a;					
?>
			<input name="id_menu" type="hidden" value="<?php echo $id ?>">
			<input name="nama_b" type="hidden" value="<?php echo $nama ?>">
			<input name="main_b" type="hidden" value="<?php echo $id_main ?>">

			<?php if($cmain<1){?>
			<div class="form-group row">
				<label class="black col-md-3 control-label">Level</label>
				<div class="col-md-9">
					
						<label class="form-radio-label">
							<input class="form-radio-input" type="radio" name="f[level]" onclick="radioLevel('1','0')" value="1" <?php if($level==1){echo 'checked';} ?>>
							<span class="form-radio-sign">Level 1</span>
						</label>
						<label class="form-radio-label ml-3">
							<input class="form-radio-input" type="radio" name="f[level]" onclick="radioLevel('2','0')" value="2" <?php if($level==2){echo 'checked';} ?>>
							<span class="form-radio-sign">Level 2</span>
						</label>
					
				</div>
			</div>
			<?php }?>
			
			
			<div class="form-group row menuInduk" <?php if($level==1){echo 'style="display:none;"';} ?> >
				<label class="black col-md-3 control-label">Menu Induk</label>
				<div class="col-md-9">
						<?php
							$dataray=array();
							$dataray['']="=== Choose ===";
							$this->db->order_by("id_menu","asc");
							$db=$this->db->get_where("main_menu",array('level'=>1,'id_menu!='=>$id))->result();
							foreach($db as $db)
							{
								$dataray[$db->id_menu]='['.$db->id_menu.'] - '.$db->nama;
							}
							echo form_dropdown("main",$dataray,$id_main,'class="form-control show-tick"');
						?>	
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Name</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[nama]"  value="<?php echo $nama ?>" placeholder="">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Link</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[link]"  value="<?php echo $link ?>" placeholder="">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Target</label>
				<div class="col-md-9">
					<label class="form-radio-label">
						<input class="form-radio-input" type="radio" name="f[target]" value="direct" <?php if($target=='direct'){echo 'checked';} ?>>
						<span class="form-radio-sign">Direct</span>
					</label>
					<label class="form-radio-label ml-3">
						<input class="form-radio-input" type="radio" name="f[target]" value="newtab" <?php if($target=='newtab'){echo 'checked';} ?>>
						<span class="form-radio-sign">New Tab</span>
					</label>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Icon</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[icon]" value="<?php echo $icon;?>" placeholder="">
					<input required type="hidden" class="form-control" name="f[hak_akses]" value="<?php echo $role;?>" placeholder="">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Dropdown</label>
				<div class="col-md-9">
					<label class="form-radio-label">
						<input class="form-radio-input" type="radio" name="f[dropdown]" value="yes" <?php if($dropdown=='yes'){echo 'checked';} ?>>
						<span class="form-radio-sign">Yes</span>
					</label>
					<label class="form-radio-label ml-3">
						<input class="form-radio-input" type="radio" name="f[dropdown]" value="no" <?php if($dropdown=='no'){echo 'checked';} ?>>
						<span class="form-radio-sign">No</span>
					</label>
				</div>
			</div>