 <?php foreach ($list as $item){?>
                        <li>
                            <div class="topic">
                                <div class="myanswer">
                                    <span class="author">
                                        来自:<?php echo $item->topic_user_name;?>
                                    </span>
                                    <br />
                                    <span class="title">
                                        <a href="load_topic?openid=<?php echo $_REQUEST['openid'];?>&quesid=<?php echo $item->topic_id;?>"><?php echo $item->topic_title;?></a>
                                    </span>
                                    <p>
                                        <?php echo $item->topic_content;?>
                                    </p>
                                </div>
                                <hr style="border: 1px solid #cccccc;opacity: 0.2;"/>
                            </div>
                        </li>
                        <?php }?>
