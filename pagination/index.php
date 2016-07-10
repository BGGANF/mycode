<html>
<head>
    <title>PHP + MYSQL 分页查询</title>
    <style>
        body{
            font-size: 14px;
            width: 100%;
        }
        div.content{
            height: 300px;
        }
        div.page{
            text-align: center;
        }
        div.page a{
            border:#aaaadd 1px solid;
            text-decoration: none;
            padding: 2px 5px 2px 5px;
            margin: 2px;
        }
        .current{
            border:#000099 1px solid;
            background: #000099;
            padding: 4px 6px 4px 6px;
            margin: 2px;
            color: white;
            font-weight: bold;
        }
        .disable{
            border: #eee 1px solid;
            padding: 4px 6px 4px 6px;
            margin: 2px;
            color: #ddd;
        }
        div.page form {
            display: inline;
        }
    </style>
</head>

<body>
    <?php
    /**
     * Created by PhpStorm.
     * User: FuChuan
     * Date: 2016/3/30
     * Time: 10:40
     */
    require_once('../SqlHelper/SqlHelper.php');
    /**
     * 1、传入页码
    **/
    $page = $_GET['p'];
    /**
     * 2、根据页码取出数据：php->mysql处理
    **/
    $pageSize = 10;        //页面记录显示的条数
    $showPage = 5;         //页码显示的数目
    //编写sql获取分页数据SELECT *FROM 表明 LIMIT 起始位置，显示条数
    $sql = 'SELECT *FROM tb_user LIMIT ' . ($page-1)*$pageSize . ",$pageSize";
    $result = $sqlHelper->getRows($sql);
    //获取总条数
    $total_sql = 'SELECT COUNT(*) FROM tb_user';
    $total = $sqlHelper->getOneRow($total_sql)[0];
    //计算总页数
    $total_pages = ceil($total/$pageSize);
    //计算偏移量
    $pageOffset = ($showPage-1)/2;
    //初始化数据
    $start = 1;
    $end = $total_pages;
    /**
     * 3、显示数据 + 分页条
    **/
    ?>

    <div class="content">
        <table border="1" cellspacing="0" width="40%" align="center">
            <tr>
                <th>ID</th>
                <th>NAME</th>
            </tr>
            <?php foreach($result as $v){?>
            <tr>
                <td><?= $v['id']; ?></td>
                <td><?= $v['name']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="page">
        <?php if($page > 1){?>
            <a href="<?php $_SERVER['PHP_SELF']?>?p=1">首页</a>
            <a href="<?php $_SERVER['PHP_SELF']?>?p=<?= $page-1; ?>">< 上一页</a>
        <?php }else{ ?>
            <a class="disable" >首页</a>
            <a class="disable" >< 上一页</a>
        <?php } ?>

        <?php
            if($total_pages > $showPage){
                if($page > $pageOffset + 1){
                    echo '...';
                }
                if($page > $pageOffset){
                    $start = $page - $pageOffset;
                    $end = $total_pages > $page+$pageOffset ?  $page+$pageOffset : $total_pages;
                }else{
                    $start = 1;
                    $end = $total_pages > $showPage ? $showPage : $total_pages;
                }
                if($page + $pageOffset > $total_pages){
                    $start = $start - ($page + $pageOffset -$end);
                }
            }
        ?>

        <?php for($i = $start;$i <= $end;$i++){ ?>
            <?php if($page == $i){?>
                <a class="current" href="<?php $_SERVER['PHP_SELF']?>?p=<?= $i; ?>"><?= $i; ?></a>
            <?php }else{?>
                <a href="<?php $_SERVER['PHP_SELF']?>?p=<?= $i; ?>"><?= $i; ?></a>
            <?php } ?>
        <?php } ?>

        <?php
            if($total_pages > $showPage && $total_pages > $page+$pageOffset){
                echo '...';
            }
        ?>

        <?php if($page < $total_pages){ ?>
            <a href="<?php $_SERVER['PHP_SELF']?>?p=<?= $page+1; ?>">下一页 ></a>
            <a href="<?php $_SERVER['PHP_SELF']?>?p=<?= $total_pages; ?>">尾页</a>
        <?php }else{ ?>
            <a class="disable" >下一页 ></a>
            <a class="disable" >尾页</a>
        <?php } ?>

        共<?= $total_pages?>页

        <form action=" " method="get">
            到第<input type="text" size="2" name="p">页
            <input type="submit" value="确定">
        </form>
    </div>
</body>
</html>


















