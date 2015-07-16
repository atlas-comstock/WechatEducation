<?php foreach ($list as $item){ $image = $item->user_image;?>
<li>
<div class="topic">
<div class="bottom_hr">
</div>
<div class="topic_zan">
<div id="compo">
<p id="author_head">
<img id="topic_author_head" src="<?php echo $image;?>" />
		</p>
		<p>
		<img src="<?=base_url()?>style/conan_style/image/thumb.ico" />
		<span>
		<?php $count = $item->read_count;
                                            if ($count>=100) echo '99+';
                                            else echo $count;
                                            ?>
                                            </span>
                                        </p>
                                        <p>
                                            <img src="<?=base_url()?>style/conan_style/image/star.ico" />
                                            <span>
                                                收藏
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="topic_view">
                                    <span class="author">
                                        来自:<?php echo $item->topic_user_name;?>
                                    </span>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="author">
									<?php echo $item->topic_date?>
									</span>
                                    <br />
                                    <span class="title">
                                       <a href="comm/load_topic?openid=<?php echo $_REQUEST['openid'];?>&quesid=<?php echo $item->topic_id;?>"><?php echo $item->topic_title;?></a>
                                    </span>
                                    <p>
                                    <?php echo $item->topic_content;?>
                                    </p>
                                </div>
                            </div>
                        </li>
 <?php }?>