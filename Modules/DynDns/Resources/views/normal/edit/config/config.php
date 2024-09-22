<div class="divTab">
                            <div class="tab-item">
							    <a class="atab tab-icon email first active" title="tab0">Email</a>
                                <a class="atab tab-icon ga" title="tab1">Ga</a>
                                <a class="atab tab-icon config" title="tab2">Cấu hình</a>
                                <a class="atab tab-icon favicon" title="tab3">Favicon</a>
                                <a class="atab tab-icon robot" title="tab4">Robots.txt</a>
                                <a class="atab tab-icon sitemap" title="tab5">Sitemap</a>                                 
                                <a class="atab tab-icon meta" title="tab6">Tag Meta</a>
                                <a class="atab tab-icon seo" title="tab7">SEO</a>
                                 <a class="atab tab-icon htaccess" title="tab8">htaccess</a>
                            </div>
                    
                            <div style="display: block;" class="tab0 tabcontent ui-corner-all">
                                <label class="desc">
                                    SMTP
                                </label>
                                   <input name="smtp" class="full" value="<?=$row['smtp']?>" type="text">
                                <label class="desc">
                                    Cổng                                </label>
                                   <input name="port" class="full" value="<?=$row['port']?>" type="text">
                                 <label class="desc">
                                    Chứng thực                                </label>
                                    <select name="auth" class="select">
                                    <option <?=@$row['auth']==1?'selected="selected"':''?>value="1">Có</option>
                                    <option <?=@$row['auth']==0?'selected="selected"':''?> value="0">Không</option>
                                </select>
                                 <label class="desc">
                                    SSL
                                </label>
                                   <select name="ssl" class="select">
                                    <option <?=@$row['ssl']==1?'selected="selected"':''?>value="1">Có</option>
                                    <option <?=@$row['ssl']==0?'selected="selected"':''?>value="0">Không</option>
                                </select>
                                 <label class="desc">
                                    Tài khoản smtp                                </label>
                                   <input name="smtp_account" class="full" value="<?=$row['smtp_account']?>" type="text">
                                <label class="desc">
                                    Mật khẩu smtp                                </label> 
                                   <input name="smtp_password" class="full" value="<?=$row['smtp_password']?>" type="password">
                                
                                <label class="desc">
                                    Tiêu đề Email                                </label> 
                                   <input name="email_subject" class="full" value="<?=$row['email_subject']?>" type="text">
                                <label class="desc">
                                    Email gửi                                </label>
                                   <input name="smtp_sender" class="full" value="<?=$row['smtp_sender']?>" type="text">
                                <label class="desc">
                                    Email nhận                                </label>
                                   <input name="smtp_receiver" class="full" value="<?=$row['smtp_receiver']?>" type="text">
                            
								<label class="desc">
                                    Tên người gửi                                </label>
                                   <input name="smtp_name_sender" class="full" value="<?=$row['smtp_name_sender']?>" type="text">
							</div>
                            <div style="display: none;" class="tab1 tabcontent ui-corner-all">
                                 <label class="desc">Gmail</label>
                                   <input name="gmail" value="<?=@$row['gmail']?>" class="full" type="text">
                                <label class="desc">Password</label>
                                   <input name="password" value="<?=@$row['password']?>" class="full" type="text">
                                <label class="desc">Profile ID</label>
                                   <input name="profileID" class="full" value="<?=@$row['profileID']?>" type="text">
                                <label class="desc">Tracking Code</label>
                                   <textarea name="tracking_code" class="full" rows="10"><?=@$row['tracking_code']?></textarea>
                            </div>
                            <div style="display: none;" class="tab2 tabcontent ui-corner-all">
                                    <h1 class="title">Header</h1>
    <label class="desc">Tên công ty(VN)</label>
    <input class="full" name="cp_vn" value="<?=@$row['cp_vn']?>" type="text">
    <label class="desc">Tên công ty(EN)</label>
    <input class="full" name="cp_en" value="<?=@$row['cp_en']?>" type="text">
    <label class="desc">Slogan(VN)</label>
    <input class="full" name="cp_slogan_vn" value="<?=@$row['cp_slogan_vn']?>" type="text">
    <label class="desc">Slogan(EN)</label>
    <input class="full" name="cp_slogan_en" value="<?=@$row['cp_slogan_en']?>" type="text">

    <label class="desc">Hotline</label>
    <input class="full" name="hotline" value="<?=@$row['hotline']?>" type="text">


    <h1 class="title">Footer</h1>
    <label class="desc">Trụ sở chính(Tiếng Việt)</label>
    <textarea name="address_1_vn" class="full" rows="7"><?=@$row['address_1_vn']?></textarea>
    <label class="desc">VP đại diện(Tiếng Việt)</label>
    <textarea name="address_2_vn" class="full" rows="7"><?=@$row['address_2_vn']?></textarea>

    <label class="desc">Trụ sở chính(English)</label>
    <textarea name="address_1_en" class="full" rows="7"><?=@$row['address_1_en']?></textarea>
    <label class="desc">VP đại diện(English)</label>
    <textarea name="address_2_en" class="full" rows="7"><?=@$row['address_2_en']?></textarea>

    <label class="desc">@Copyright(Tiếng Việt)</label>
    <textarea name="copyright_vn" class="full" rows="7"><?=@$row['copyright_vn']?></textarea>
        <label class="desc">@CopyrightT(Tiếng Việt)</label>
    <textarea name="copyright_en" class="full" rows="7"><?=@$row['copyright_en']?></textarea>
    
    <label class="desc">Facebook</label>
    <input class="full" name="s_facebook" value="<?=@$row['s_facebook']?>" type="text">

    <label class="desc">Google</label>
    <input class="full" name="s_google" value="<?=@$row['s_google']?>" type="text">

    <label class="desc">Youtube</label>
    <input class="full" name="s_youtube" value="<?=@$row['s_youtube']?>" type="text">

    <h1 class="title">Contact</h1>
    <label class="desc">Trụ sở chính(Tiếng Việt)</label>
    <textarea name="c_address_1_vn" class="full" rows="7"><?=@$row['c_address_1_vn']?></textarea>
    <label class="desc">VP đại diện(Tiếng Việt)</label>
    <textarea name="c_address_2_vn" class="full" rows="7"><?=@$row['c_address_2_vn']?></textarea>

    <label class="desc">Trụ sở chính(English)</label>
    <textarea name="c_address_1_en" class="full" rows="7"><?=@$row['c_address_1_en']?></textarea>
    <label class="desc">VP đại diện(English)</label>
    <textarea name="c_address_2_en" class="full" rows="7"><?=@$row['c_address_2_en']?></textarea>

    <label class="desc">Phone</label>
    <textarea name="c_phone" class="full" rows="7"><?=@$row['c_phone']?></textarea>
    <label class="desc">Email</label>
    <textarea name="c_email" class="full" rows="7"><?=@$row['c_email']?></textarea>

    <label class="desc">Catalogue</label>
    <a href="#" class="upload-file" data-store="#document">Upload</a>
    <input name="catalogue" id="document" value="<?=@$row['catalogue']?>" class="field text full" type="text">
                                <!--<label class="desc">Google Map</label>
                                   <textarea name='config[_google_map_]' class="full" rows="10"></textarea>
                                <label class="desc" >Địa chỉ</label>
                                   <textarea name='config[_address_]' class="full" rows="7"></textarea>
                                <label class="desc">Google Map trên Mobile</label>
                                   <textarea name='config[_google_map_mobile_]' class="full" rows="10"></textarea>
                                <label class="desc" >Địa chỉ trên Mobile</label>
                                   <textarea name='config[_address_mobile_]' class="full" rows="7"></textarea>
                                -->
                            </div>
                            <div style="display: none;" class="tab3 tabcontent ui-corner-all">
                             <script type="text/javascript">

				function openKCFinder(textarea) {
					window.KCFinder = {
						callBackMultiple: function(files) {
							window.KCFinder = null;
							//textarea.value = "";
							for (var i = 0; i < files.length; i++)							
							{
								var img = "<img src='" + files[0] + "' />";
								//$('.featured_photo').html(img);
	            				document.getElementById('featured_photo_'+textarea).innerHTML  = img;
							 	document.getElementById(textarea).value = files[i];
							}
						}
					};
					window.open('<?=_media?>/admin/_template3/js/kcfinder/browse.php?type=images&dir=files/public',
						'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
						'directories=0, resizable=1, scrollbars=0, width=800, height=600'
					);
				}
				function delimage(textarea)
				{
					document.getElementById('featured_photo_'+textarea).innerHTML  = "";
					document.getElementById(textarea).value = "";
				}
				</script>    
                
               
                <div class="portlet-content">
                	<?php $ele_image="logo";?>
                    <div class="featured_photo" id="featured_photo_<?=$ele_image?>">
                    <label class="desc">Logo</label>
                     <?php if(@$row[$ele_image]!=''):?>
                        <img src="<?=@$row[$ele_image]?>" alt="" />
                        <?php else:?>        
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php endif?>
                    </div>
                    <div>
                        <a href="javascript:openKCFinder('<?=$ele_image?>')">Tải lên</a>
                        <a href="javascript:delimage('<?=$ele_image?>')">Tháo xuống</a>
                       
                        <input name="<?=$ele_image?>" id="<?=$ele_image?>" value="<?=@$row[$ele_image]?>" type="hidden">
                    </div>
    			</div>
                
                <div class="portlet-content">
                	<?php $ele_image="favicon";?>
                    <div class="featured_photo" id="featured_photo_<?=$ele_image?>">
                    <label class="desc">Favicon</label>
                     <?php if(@$row[$ele_image]!=''):?>
                        <img src="<?=@$row[$ele_image]?>" alt="" />
                        <?php else:?>        
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php endif?>
                    </div>
                    <div>
                        <a href="javascript:openKCFinder('<?=$ele_image?>')">Tải lên</a>
                        <a href="javascript:delimage('<?=$ele_image?>')">Tháo xuống</a>
                       
                        <input name="<?=$ele_image?>" id="<?=$ele_image?>" value="<?=@$row[$ele_image]?>" type="hidden">
                    </div>
    			</div>
                <hr />              
                <div class="portlet-content">
                	<?php $ele_image="admin_logo";?>
                    <div class="featured_photo" id="featured_photo_<?=$ele_image?>">
                    <label class="desc">CRM logo</label>
                     <?php if(@$row[$ele_image]!=''):?>
                        <img src="<?=@$row[$ele_image]?>" alt="" />
                        <?php else:?>        
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php endif?>
                    </div>
                    <div>
                        <a href="javascript:openKCFinder('<?=$ele_image?>')">Tải lên</a>
                        <a href="javascript:delimage('<?=$ele_image?>')">Tháo xuống</a>
                       
                        <input name="<?=$ele_image?>" id="<?=$ele_image?>" value="<?=@$row[$ele_image]?>" type="hidden">
                    </div>
    			</div>
                
                <div class="portlet-content">
                	<?php $ele_image="login_logo";?>
                    <div class="featured_photo" id="featured_photo_<?=$ele_image?>">
                    <label class="desc">Login logo</label>
                     <?php if(@$row[$ele_image]!=''):?>
                        <img src="<?=@$row[$ele_image]?>" alt="" />
                        <?php else:?>        
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php endif?>
                    </div>
                    <div>
                        <a href="javascript:openKCFinder('<?=$ele_image?>')">Tải lên</a>
                        <a href="javascript:delimage('<?=$ele_image?>')">Tháo xuống</a>
                       
                        <input name="<?=$ele_image?>" id="<?=$ele_image?>" value="<?=@$row[$ele_image]?>" type="hidden">
                    </div>
    			</div>
                
                
                            </div>
                            <div style="display: none;" class="tab4 tabcontent ui-corner-all">
                            
                            <textarea name="robot" rows="2" cols="20" id="robot" class="full" spellcheck="false" style="height:500px;"><?php
$myfile = fopen("robots.txt", "r");
echo fread($myfile,filesize("robots.txt"));
fclose($myfile);
?> </textarea>
                            </div>
                              <div style="display: none;" class="tab5 tabcontent ui-corner-all">
                            
                            <textarea name="sitemap" rows="2" cols="20" id="sitemap" class="full" spellcheck="false" style="height:500px;"><?php
$myfile = fopen("sitemap.xml", "r");
echo fread($myfile,filesize("sitemap.xml"));
fclose($myfile);
?> </textarea>
                            </div>
                             <div style="display: none;" class="tab6 tabcontent ui-corner-all">
                            <textarea name="meta" id="meta" class="full" style="height:500px;"><?=html_entity_decode(@$row['meta'])?></textarea>
                            </div>
                            
                            <div style="display: none;" class="tab7 tabcontent ui-corner-all">
                            <label class="desc">Key word</label>
                            <textarea name="keywords" id="keywords" class="full" style="height:100px;"><?=@$row['keywords']?></textarea>
                            
                            <label class="desc">Description</label>
                            <textarea name="description" id="description" class="full" style="height:100px;"><?=@$row['description']?></textarea>
 
                            <label class="desc">Author</label>
                            <textarea name="author" id="author" class="full" style="height:100px;"><?=@$row['description']?></textarea>
                            
                            <label class="desc">Generator</label>
                            <textarea name="generator" id="generator" class="full" style="height:100px;"><?=@$row['description']?></textarea>                           
                            
                            </div>
                             <div style="display: none;" class="tab8 tabcontent ui-corner-all">
                            
                            <textarea name="htaccess" rows="2" cols="20" id="httaccess" class="full" spellcheck="false" style="height:500px;"><?php
$myfile = fopen(".htaccess", "r");
echo fread($myfile,filesize(".htaccess"));
fclose($myfile);
?> </textarea>
                            </div>
                           
                </div>
          