<!-- User Config -->
<div id="app-user-config" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
    	<h3>Configuración</h3>
  	</div>
 	 <div class="modal-body form-horizontal">
		<div class="control-group">
			<label class="control-label" for="anno_fiscal">Año Fiscal</label>
			<div class="controls">
				<select id="anno_fiscal" >
					<?php foreach ($app_fiscal_year as $value): ?>
						<option value="<?php echo $value['ano_pro']; ?>" <?php echo ($value['fiscal']==='0') ? 'disabled' : '' ?> >
							<?php echo $value['ano_pro']; ?>
						</option>
					<?php endforeach ?>
				</select>
				<span class="help-block"><small>La selección estará disponible solo en la sesión actual.</small></span>
			</div><!-- // end controls -->
		</div><!-- // end control-group -->
  	</div><!-- // end modal body -->	
  	<div class="modal-footer">
    	<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
  	</div>
</div><!-- // end cuser config -->
 
<!-- 
 * Menu Contextual : !important no borrar 
 //-->
<div id="window-context-menu" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <ul class="nav nav-list">
    <li class="nav-header">{app_title}</li>
    <li>{app_copyright} | RIF {company_com_rif}</li>
	<li class="divider"></li>
  </ul>
</div>