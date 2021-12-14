<tr id ="page_content">
  <td align="left" valign="top"><table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="bodyareamain"><table width="100%" height="100%" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr valign="left">
              <td class="bodyarea"><div class="admin-content">
                  <h2><?php echo $this->input->get('id')?'Edit Party - "'.$list[0]['master_party_name'].'"':'Add New State'; ?></h2>
                  <div class="content-center">
                    <ul class="form">
                    	<?php echo form_open_multipart('admin/master_state/import'); ?>
                        <li> <span class="label">Import CSV:</span>
                        	<input type="file" name="userfile" id="userfile" />
						</li>
                      <li class="button">
                        <input type="submit" value="<?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?>" class="admin-button" />
                      </li>
                      </form>
                    </ul>
                  </div>
                  
               
                  
                  
                </div></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
</tr>
