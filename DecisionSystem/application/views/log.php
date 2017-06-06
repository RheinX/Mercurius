


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
            <div class="am-g">
                <!--                    <div class="am-u-sm-12 am-u-md-6">-->
                <!--                        <div class="am-btn-toolbar">-->
                <!--                            <div class="am-btn-group am-btn-group-xs">-->
                <!--                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>-->
                <!--                                <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 保存</button>-->
                <!--                                <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> 审核</button>-->
                <!--                                <button type="button" class="am-btn am-btn-default am-btn-danger"><span class="am-icon-trash-o"></span> 删除</button>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="am-u-sm-12 am-u-md-3">-->
                <!--                        <div class="am-form-group">-->
                <!--                            <select data-am-selected="{btnSize: 'sm'}">-->
                <!--                                <option value="option1">所有类别</option>-->
                <!--                                <option value="option2">IT业界</option>-->
                <!--                                <option value="option3">数码产品</option>-->
                <!--                                <option value="option3">笔记本电脑</option>-->
                <!--                                <option value="option3">平板电脑</option>-->
                <!--                                <option value="option3">只能手机</option>-->
                <!--                                <option value="option3">超极本</option>-->
                <!--                            </select>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="am-u-sm-12 am-u-md-3" >-->
                <!--                        <div class="am-input-group am-input-group-sm">-->
                <!--                            <input type="text" class="am-form-field">-->
                <!--                            <span class="am-input-group-btn">-->
                <!--            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button"></button>-->
                <!--          </span>-->
                <!--                        </div>-->
                <!--                    </div>-->
            </div>
            <div class="am-g">
                <div class="am-u-sm-12">
                    <form class="am-form">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>

                                <th >时间</th>
                                <th >操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($user as $data): ?>
                                <tr>
                                    <td><?php echo $data['time']?></td>
                                    <td><?php echo $data['operation']?></a></td>

                                </tr>
                            <?php endforeach;?>

                            </tbody>
                        </table>

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