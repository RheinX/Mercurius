


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
<!--                                    <th class="table-check"><input type="checkbox" class="tpl-table-fz-check"></th>-->
                                    <th class="table-id">号码</th>
                                    <th class="table-title">名称</th>
                                    <th class="table-type">状态</th>
                                    <th class="table-author am-hide-sm-only">法人代表</th>
                                    <th class="table-date am-hide-sm-only">修改日期</th>
                                    <th class="table-set">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($user as $data): ?>
                                    <tr>
                                        <td><?php echo $data['shopID']?></td>
                                        <td><a href="#"><?php echo $data['resName']?></a></td>
                                        <td><?php

                                            if($data['status']==2)
                                                echo "通过";
                                            else if($data['status']==1)
                                                echo "正在审核";
                                            else if($data['status']==3)
                                                echo "审核失败";
                                            else if($data['status']==4)
                                                echo "封号";
                                            else
                                                echo "未验证!";

                                            ?></td>
                                        <td class="am-hide-sm-only"><?php echo $data['realName']?></td>
                                        <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a class="am-btn am-btn-default am-btn-xs am-text-secondary"
                                                       href="index.php/Admin_Controller/userInfo/<?php echo $data['shopID']?>">
                                                        <span class="am-icon-pencil-square-o"></span> 查看</a>
<!--                                                    <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>-->
                                                    <a class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                                       href="index.php/Admin_Controller/handleAccount/<?php echo $data['shopID'];?>/<?php if(4==$data['status']) echo '1';else echo '4';?>"><span class="am-icon-trash-o">
                                                        </span> <?php if(4==$data['status']) echo "解封";else echo "封号"?></a>
                                                </div>
                                            </div>
                                        </td>
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