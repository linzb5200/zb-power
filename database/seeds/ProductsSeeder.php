<?php

use Illuminate\Database\Seeder;
use App\Models\Products\ProductsCate;
use Overtrue\Pinyin\Pinyin;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //样式
        $parent_id_style = 0;
        $cate = ProductsCate::create(['parent_id' => $parent_id_style,'title' => 'PPT模板','pinyin'=>'ppt']);
        $pid = $cate->id;
        $childs = ['节日庆典','竞聘求职','毕业答辩','校园培训','教学课件','工作总结','商业计划书','公司介绍','家长会','公开演讲','公益宣传','产品介绍','室内设计','职业规划','金融理财'];
        $this->child($childs,$pid);

        $cate = ProductsCate::create(['parent_id' => $parent_id_style,'title' => 'Excel表格','pinyin'=>'excel']);
        $pid = $cate->id;
        $childs = ['采购','财务会计','行政管理','日常生活','建筑装修','学校管理','人力资源'];
        $this->child($childs,$pid);

        $cate = ProductsCate::create(['parent_id' => $parent_id_style,'title' => 'Word模板','pinyin'=>'word']);
        $pid = $cate->id;
        $childs = ['学校管理','邀请函','贺卡','海报','手抄报','工作总结范文','信纸模板','工作总结范文','作文模板','校园手抄报','合同范本','合同范本','计划策划'];
        $this->child($childs,$pid);

        $cate = ProductsCate::create(['parent_id' => $parent_id_style,'title' => '简历模板','pinyin'=>'resume']);
        $pid = $cate->id;
        $childs = ['销售简历','财务简历','语言类简历','设计师简历','应届毕业生简历','人力资源简历','程序员简历','教育培训简历','英文简历','行政简历','产品简历','医疗简历','通用行业'];
        $this->child($childs,$pid);

        $cate = ProductsCate::create(['parent_id' => $parent_id_style,'title' => '设计元素','pinyin'=>'design']);
        $pid = $cate->id;
        $childs = ['漂浮素材','效果元素','装饰图案','促销标签','节日元素','艺术字','图标元素','不规则图形','边框纹理','产品实物','卡通手绘','文案集','背景素材','其他'];
        $this->child($childs,$pid);
    }

    public function child($childs,$pid)
    {
        $py = new Pinyin();
        foreach ($childs as $child){
            $pinyin = $py->abbr($child);
            ProductsCate::create([
                'parent_id' => $pid,
                'title' => $child,
                'pinyin'=>$pinyin
            ]);
        }
    }
}
