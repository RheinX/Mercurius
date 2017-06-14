
<div class="tpl-content-wrapper">
    <div class="tpl-content-page-title">
        用户信息
    </div>
    <ol class="am-breadcrumb">
        <li><a href="index.php/Admin_Controller/user" class="am-icon-home">首页</a></li>
        <li><a href="index.php/Admin_Controller/user">用户</a></li>
        <li class="am-active">用户信息</li>
    </ol>
    <div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span> 列表
            </div>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-small input-inline">
                    <div class="input-icon right">
                        <i class="am-icon-search"></i>
                        <input type="text" class="form-control form-control-solid" placeholder="搜索..."> </div>
                </div>
            </div>


        </div>
        <div class="tpl-block">
<!--            <div class="am-g">-->
<!--                -->
<!--            </div>-->
            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th >店铺名称</th>
                                <th >号码</th>
                                <th >评分</th>
                                <th >评语</th>
                                <th >日期</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($user as $data): ?>
                                <tr>
                                    <td><?php echo $data['resName']?></td>
                                    <td><a href="#"><?php echo $data['phoneNum']?></a></td>
                                    <td><?php echo $data['score'];?></td>
                                    <td class="am-hide-sm-only"><?php echo $data['comment']?></td>
                                    <td class="am-hide-sm-only"><?php echo $data['time']?></td>

                                </tr>
                            <?php endforeach;?>

                            </tbody>
                        </table>
                        <!--                            <div class="am-cf">-->
                        <!---->
                        <!--                                <div class="am-fr">-->
                        <!--                                    <ul class="am-pagination tpl-pagination">-->
                        <!--                                        <li class="am-disabled"><a href="#">«</a></li>-->
                        <!--                                        <li class="am-active"><a href="#">1</a></li>-->
                        <!--                                        <li><a href="#">2</a></li>-->
                        <!--                                        <li><a href="#">3</a></li>-->
                        <!--                                        <li><a href="#">4</a></li>-->
                        <!--                                        <li><a href="#">5</a></li>-->
                        <!--                                        <li><a href="#">»</a></li>-->
                        <!--                                    </ul>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <hr>

                    </form>
                </div>

            </div>
        </div>
        <div class="tpl-alert"></div>
    </div>










</div>

</div>


<script src="resources/assets/js/jquery.min.js"></script>
<script src="resources/assets/js/amazeui.min.js"></script>
<script src="resources/assets/js/app.js"></script>
</body>

</html>