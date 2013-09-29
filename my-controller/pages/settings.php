<h2>Manage Site Settings</h2>
<script>
    $(document).ready(function(){
        //sure to get the position of the tab to be selected
        $('.t_content').hide();
        var selected="<?php echo isset($_GET['show'])?$_GET['show']:''; ?>";
        if(selected==""){
            $('.tabs_class:eq(0)').addClass('tab_select');
            $('.t_content:eq(0)').show();
        }else{
            $('.tabs_class:eq('+selected+')').addClass('tab_select');
            $('.t_content:eq('+selected+')').show();
        }
        
        $('.tabs_class').click(function(){
            $('.tab_select').removeClass('tab_select');
            $('.t_content').hide();
            $(this).addClass('tab_select');
            $('.t_content:eq('+$('.tabs_class').index(this)+')').show();
        });
    });
</script>
<div id="custom_tab">
    <div id="tab_holder">
        <div class="tabs_class">
            Settings
        </div>
        <div class="tabs_class">
            Banner
        </div>
        <div class="tabs_class">
            Category
        </div>
        <div class="tabs_class">
            Resource
        </div>
        
    </div>
    <div id="tab_content_holder">
        <form action="?page=act_settings&amp;fol=actpages" method="post" enctype="multipart/form-data">
        <div class="t_content">
            <table id="dataGrid">
                <tr>
                    <td>Site Name</td>
                    <td><input type="text" name="sitename" value="<?php echo stripslashes($setting_options['sitename']); ?>" /></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" name="district" value="<?php echo stripslashes($setting_options['district']); ?>" /></td>
                </tr>
                <tr>
                    <td>Phone No</td>
                    <td><input type="text" name="site_phone" value="<?php echo stripslashes($setting_options['site_phone']); ?>" /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="site_email" value="<?php echo stripslashes($setting_options['site_email']); ?>" /></td>
                </tr>
                <tr>
                    <td>Site Features</td>
                    <td><a href="javascript:void(0)" id="site_features">Click Here to Change Site Features <img src="images/gear.png" width="22" alt="gear" /></a></td>
                </tr>
                <tr>
                    <td>Slider Limit</td>
                    <td><input type="text" name="slider_limit" value="<?php echo stripslashes($setting_options['slider_limit']); ?>" /></td>
                </tr>
                <tr>
                    <td>Allow File upload in Pages</td>
                    <td>
                        <?php 
                            echo $obj->generate_file_upload_script('allow_page_file_uploads',$setting_options['allow_page_file_uploads']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Allow File upload in Articles</td>
                    <td>
                        <?php 
                            echo $obj->generate_file_upload_script('allow_article_file_uploads',$setting_options['allow_article_file_uploads']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Allow Comments in Articles</td>
                    <td>
                        <?php 
                            echo $obj->generate_file_upload_script('allow_article_comments',$setting_options['allow_article_comments']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Enable Page Add(Main)</td>
                    <td>
                        <?php 
                            echo $obj->generate_file_upload_script('allow_category_add_pages',$setting_options['allow_category_add_pages']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Enable Category Add(News)</td>
                    <td>
                        <?php 
                            echo $obj->generate_file_upload_script('allow_category_add_news',$setting_options['allow_category_add_news']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Enable Category Add<b>(Associates)</b></td>
                    <td>
                        <?php 
                            echo $obj->generate_file_upload_script('allow_category_add_associates',$setting_options['allow_category_add_associates']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Enable Category Add<b>(Advertisement)</b></td>
                    <td>
                        <?php 
                            echo $obj->generate_file_upload_script('allow_category_add_ad',$setting_options['allow_category_add_ad']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="btn_submit" value="Save " /></td>
                </tr>
                
            </table>
            
        </div>
        <div class="t_content">
            <table id="dataGrid">
                <?php 
                    if($setting_options['banner']!=""){
                        echo '<tr>
                                <td></td>
                                <td><img src="../uploads/banner/thumbs/'.$setting_options['banner'].'" alt="Company Banner" /></td>
                                </tr>';
                    }
                ?>
                <tr>
                    <td>Banner Image</td>
                    <td><input type="file" name="image" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="btn_submit_banner" value="Save " /></td>
                </tr>
            </table>
        </div>
        
        <div class="t_content">
            <table id = "dataGrid" class="dhold" width="40%">
                <tr>
                    <td width="40%">Select Type</td>
                    <td>
                        <select name="category_type" onchange="get_selected_category(this.value)">
                            <option>Select a Category type</option>
                            <option value="pages">Pages</option>
                            <option value="articles">Articles</option>
                            <option value="members">Members</option>
                            <option value="ad">Advertisement</option>
                            <option value="products">Products</option>
                            
                        </select>
                    </td>
                </tr>               
            </table>
        </div>
        
        <div class="t_content">
            <table id = "dataGrid">
                <?php 
                    $all_resource = $obj->getResourceType();
                    //$obj->printArray($all_resource);
                    foreach($all_resource as $val){
                        echo '<tr>
                                <td>'.stripslashes($val['category']).'</td>
                                <td>
                                    <label>
                                    <input type="radio" value="0" name="isactive['.$val['id'].']" '.checkSelected($val['enabled'], 0, true).' />Disabled
                                    </label>
                                    <label>
                                        <input type="radio" value="1" name="isactive['.$val['id'].']" '.checkSelected($val['enabled'], 1, true).' />Enabled
                                    </label>
                                </td>
                              </tr>';
                    }
                ?>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btn_res_enabled" value="Submit" /></td>
                </tr>
            </table>
        </div>
        </form>
    </div>
</div>
