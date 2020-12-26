

			<div class="form-group row">
				<label class="black col-md-3 control-label">Level</label>
				<div class="col-md-9">
					<label class="form-radio-label">
						<input class="form-radio-input" type="radio" name="f[level]" onclick="radioLevel('1','0')" value="1" checked>
						<span class="form-radio-sign">Level 1</span>
					</label>
					<label class="form-radio-label ml-3">
						<input class="form-radio-input" type="radio" name="f[level]" onclick="radioLevel('2','0')" value="2">
						<span class="form-radio-sign">Level 2</span>
					</label>
				</div>
			</div>
			
			<div class="form-group row menuInduk" style="display:none;">
				<label class="black col-md-3 control-label">Menu Induk</label>
				<div class="col-md-9">
					<select class="form-control show-tick" id="Induk" name="main" data-live-search="true">
						<option value="">=== Choose ===</option>
						<?php 
					    $db=$this->db->get_where("main_menu",array('level'=>1,'hak_akses'=>$uri))->result();
					    foreach($db as $val){
						   echo "<option value='".$val->id_menu."'>[".$val->id_menu."] - ".$val->nama."</option>";
					    }
					    ?>
				    </select>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Name</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[nama]" placeholder="">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Link</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[link]" placeholder="">
				</div>
			</div>

			<div class="form-group row">
				<label class="black col-md-3 control-label">Target</label>
				<div class="col-md-9">
					<label class="form-radio-label">
						<input class="form-radio-input" type="radio" name="f[target]" value="direct" checked>
						<span class="form-radio-sign">Direct</span>
					</label>
					<label class="form-radio-label ml-3">
						<input class="form-radio-input" type="radio" name="f[target]" value="newtab">
						<span class="form-radio-sign">New Tab</span>
					</label>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="black col-md-3 control-label">Icon</label>
				<div class="col-md-9">
					<input required type="text" class="form-control" name="f[icon]" placeholder="">
					<input required type="hidden" class="form-control" name="f[hak_akses]" value="<?php echo $uri;?>" placeholder="">
				</div>
			</div>

		


