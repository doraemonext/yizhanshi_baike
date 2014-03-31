<div class="right" id="guidance">
    <div class="ask-question">
        <a href="<?=site_url('add')?>"><img src="http://www.junyoo.net/images/fw_title.gif"/></a>
    </div>
    <div class="division"></div>
    <div class="caption">
        <div></div>
        <p>问题搜索</p>
    </div>
    <div>
        <div id="search-sidebar">
            <?=form_open('search', array('class' => 'search', 'method' => 'get'))?>
                <div>
                    <label for="category-box">请选择搜索分类：</label>
                    <select name="category" id="category-box">
                        <option value="0">全部分类</option>
                        <?php foreach ($category as $row): ?>
                        <option value="<?=$row['id']?>"><?=$row['title']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div>
                    <label for="search-box">请输入搜索内容：</label>
                    <input name="search" id="search-box" maxlength="60" type="text" />
                </div>
                <br>
                <div>
                    <input id="search-button" type="submit" value="搜索"/>
                </div>
            </form>
        </div>
    </div>
    <div class="division"></div>
    <div class="caption">
        <div></div>
        <p>搜索热词</p>
    </div>
    <div id="hotwords">
        <ul class="hotwords">
            <?php
            $size = array(1, 1, 0, 1, 0, 1, 0, 0);
            $i = 0;
            foreach ($search_tags as $row) {
                if ($size[$i] == 1) {
                    echo '<li class="long"><a href="'.site_url('search?category=0&search=').$row['title'].'">'.$row['title'].'</a></li>';
                } else {
                    echo '<li class="short"><a href="'.site_url('search?category=0&search=').$row['title'].'">'.$row['title'].'</a></li>';
                }

                $i = ($i + 1) % 8;
            }
            ?>
        </ul>
    </div>
    <div class="division"></div>
    <div class="caption">
        <div></div>
        <p>热点问题</p>
    </div>
    <div>
        <ul class="side">
            <?php foreach ($heat as $num => $row): ?>
            <li><?=$num+1?>. <a href="<?=site_url('question/view').'/'.$row['id']?>"><?=$row['title']?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="division"></div>
    <div class="caption">
        <div></div>
        <p>分类列表</p>
    </div>
    <div>
        <ul class="side">
            <li><a href="<?=site_url('/')?>"><strong>全部分类</strong></a></li>
            <?php foreach ($category as $row): ?>
            <?php if ($category_id == $row['id']): ?>
            <li class="active"><a href="<?=site_url('home/category').'/'.$row['id']?>"><?=$row['title']?></a></li>
            <?php else: ?>
            <li><a href="<?=site_url('home/category').'/'.$row['id']?>"><?=$row['title']?></a></li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
