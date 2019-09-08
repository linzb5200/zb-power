@extends('home.layouts.user.base')

@section('content')
    <div class="fly-panel layui-text">
        <div class="fly-panel-title fly-filter">
            充值飞吻
        </div>
        <div class="fly-panel-main">
            <form class="layui-form" action="/order/buy/">
                <blockquote class="layui-elem-quote" style="margin-top: 10px;">
                    飞吻用途可详见：
                    <a href="/jie/13435/" target="_blank">
                        《关于社区飞吻》
                    </a>
                </blockquote>
                <div class="layui-form-item" style="margin-top: 20px;">
                    <label class="layui-form-label">
                        充值：
                    </label>
                    <div class="layui-input-inline" style="width: 150px;">
                        <select name="airKiss" lay-filter="airKiss">
                            <option value="1000" selected="">
                                1000飞吻
                            </option>
                            <option value="5000">
                                5000飞吻
                            </option>
                            <option value="99999">
                                99999飞吻
                            </option>
                        </select>
                        <div class="layui-unselect layui-form-select">
                            <div class="layui-select-title">
                                <input type="text" placeholder="请选择" value="1000飞吻" readonly="" class="layui-input layui-unselect">
                                <i class="layui-edge">
                                </i>
                            </div>
                            <dl class="layui-anim layui-anim-upbit" style="">
                                <dd lay-value="1000" class="layui-this">
                                    1000飞吻
                                </dd>
                                <dd lay-value="5000" class="">
                                    5000飞吻
                                </dd>
                                <dd lay-value="99999" class="">
                                    99999飞吻
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        金额：
                    </label>
                    <div class="layui-input-block">
                        <input type="hidden" name="price" id="LAY_price" value="10">
                        <div class="layui-form-mid" style="font-size: 23px; color: #FF5722;">
                            ￥
                            <span id="LAY_price_text">
							10
						</span>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        支付方式：
                    </label>
                    <div class="layui-input-block">
                        <input type="radio" name="pay_type" value="alipay" title="" checked="">
                        <div class="layui-unselect layui-form-radio layui-form-radioed">
                            <i class="layui-anim layui-icon">
                                
                            </i>
                            <div>
                                <i class="iconfont icon-alipay" title="支付宝" style="top: -1px;">
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <input type="hidden" name="itemid" value="16">
                        <button class="layui-btn layui-btn-danger" lay-submit="" lay-filter="orderPay">
                            立即提交
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection