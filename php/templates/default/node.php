<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="title">
    <div class="float-left fs14">
        <a href="/">',$options['name'],'</a> &raquo; ',$c_obj['name'],'(',$c_obj['articles'],')';
        if($cur_user && $cur_user['flag']>=99){
            echo ' &nbsp;&nbsp;&nbsp; • <a href="/admin-node-',$c_obj['id'],'#edit">编辑</a>';
        }
echo '    </div>';
if($cur_user && $cur_user['flag']>4){
    echo '<div class="float-right"><a href="/newpost/',$cid,'" rel="nofollow" class="newpostbtn">+发新帖</a></div>';
}
echo '    <div class="c"></div>
</div>

<div class="main-box home-box-list">';

if($c_obj['about']){
    echo '<div class="post-list grey"><p>',$c_obj['about'],'</p></div>';
}

foreach($articledb as $article){
echo '
<div class="post-list">
    <div class="item-avatar"><a href="/member/',$article['uid'],'">';
if($is_spider){
    echo '<img src="/avatar/normal/',$article['uavatar'],'.png" alt="',$article['author'],'" />';
}else{
    echo '<img src="/static/grey.gif" data-original="/avatar/normal/',$article['uavatar'],'.png" alt="',$article['author'],'" />';
}
echo '    </a></div>
    <div class="item-content">
        <h1><a href="/t-',$article['id'],'">',$article['title'],'</a></h1>
        <span class="item-date">by <a href="/member/',$article['uid'],'">',$article['author'],'</a>';
if($article['comments']){
    echo ' •  ',$article['edittime'],' •  最后回复来自 <a href="/member/',$article['ruid'],'">',$article['rauthor'],'</a>';
}else{
    echo ' •  ',$article['addtime'];
}
echo '        </span>
    </div>';
if($article['comments']){
    $gotopage = ceil($article['comments']/$options['commentlist_num']);
    if($gotopage == 1){
        $c_page = '';
    }else{
        $c_page = '-'.$gotopage;
    }
    echo '<div class="item-count"><a href="/t-',$article['id'],$c_page,'#reply',$article['comments'],'">',$article['comments'],'</a></div>';
}
echo '    <div class="c"></div>
</div>';

}

if($c_obj['articles'] > $options['list_shownum']){ 
echo '<div class="pagination">';
if($page>1){
echo '<a href="/n-',$cid,'-',$page-1,'" class="float-left">&laquo; 上一页</a>';
}
if($page<$taltol_page){
echo '<a href="/n-',$cid,'-',$page+1,'" class="float-right">下一页 &raquo;</a>';
}
echo '<div class="c"></div>
</div>';
}


echo '</div>';


?>