<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Candidate;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CandidateController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Candidate(), function (Grid $grid) {
            $grid->export();
            $grid->column('id')->sortable();
            $grid->column('candidate_name', '候选人名称');
            $grid->column('candidate_age', '候选人年龄')->display(function ($e){
                return $e.'岁';

            });

            $grid->column('educational', '个人学历')->select(['研究生','博士','本科','大专','中专','高中']);
            $grid->column('experience', '工作经验')->display(function ($e){
                return $e.'年';
            });
            $grid->column('price', '期望薪资')->display(function ($e){
                return $e.'k';
            });
            $grid->column('position', '担任过职位');
            $grid->column('company', '上家公司');
            $grid->column('candidate_state', '状态')->radio(['通过','淘汰']);
            $grid->column('candidate_people_image', '候选人图像')->image('', 100, 100);
            $grid->column('created_at', '投递日期');
            $grid->column('updated_at', '修改日期')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('experience','工作经验');
                $filter->between('created_at','投递时间筛选')->datetime();
                $filter->between('price','期望薪资');
                $filter->equal('educational')->select(['研究生','博士','本科','大专','中专','高中']);

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Candidate(), function (Show $show) {
            $show->field('id');
            $show->field('candidate_name');
            $show->field('candidate_age');
            $show->field('educational');
            $show->field('experience');
            $show->field('price');
            $show->field('position');
            $show->field('company');
            $show->field('candidate_people_image');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Candidate(), function (Form $form) {
            $form->display('id');
            $form->text('candidate_name', '候选人名称')->maxLength('50')->required();
            $form->number('candidate_age', '候选人年龄')->required()->maxLength(5)->max(100);
            $form->select('educational', '个人学历')->options(['研究生','博士','本科','大专','中专','高中'])->required();
            $form->number('experience', '工作经验')->required()->max(30);
            $form->hidden('candidate_state', '工作经验');
            $form->text('price', '期望薪资')->required()->maxLength(8);
            $form->text('position', '担任过职位')->required()->maxLength(100);
            $form->text('company', '上家公司')->required()->maxLength(100);
            $form->image('candidate_people_image', '候选人图像')->required()->compress([
                'width' => 100,
                'height' => 100,
                // 图片质量，只有type为`image/jpeg`的时候才有效。
                'quality' => 90,
                // 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
                'allowMagnify' => false,
                // 是否允许裁剪。
                'crop' => false,
                // 是否保留头部meta信息。
                'preserveHeaders' => true,
                // 如果发现压缩后文件大小比原来还大，则使用原来图片
                // 此属性可能会影响图片自动纠正功能
                'noCompressIfLarger' => true,
                // 单位字节，如果图片大小小于此值，不会采用压缩。
                'compressSize' => 100
            ]);
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
