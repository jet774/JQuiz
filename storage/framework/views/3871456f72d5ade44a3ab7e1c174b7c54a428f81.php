<?php $__env->startSection('content'); ?>
    <h3 class="page-title"><?php echo app('translator')->getFromJson('quickadmin.questions-options.title'); ?></h3>

    <p>
        <a href="<?php echo e(route('questions_options.create')); ?>" class="btn btn-success"><?php echo app('translator')->getFromJson('quickadmin.add_new'); ?></a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo app('translator')->getFromJson('quickadmin.list'); ?>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped <?php echo e(count($questions_options) > 0 ? 'datatable' : ''); ?> dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th><?php echo app('translator')->getFromJson('quickadmin.questions-options.fields.question'); ?></th>
                        <th><?php echo app('translator')->getFromJson('quickadmin.questions-options.fields.option'); ?></th>
                        <th><?php echo app('translator')->getFromJson('quickadmin.questions-options.fields.correct'); ?></th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php if(count($questions_options) > 0): ?>
                        <?php $__currentLoopData = $questions_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $questions_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($questions_option->id); ?>">
                                <td></td>
                                <td><?php echo e(isset($questions_option->question->question_text) ? $questions_option->question->question_text : ''); ?></td>
                                <td><?php echo e($questions_option->option); ?></td>
                                <td><?php echo e($questions_option->correct == 1 ? 'Yes' : 'No'); ?></td>
                                <td>
                                    <a href="<?php echo e(route('questions_options.show',[$questions_option->id])); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->getFromJson('quickadmin.view'); ?></a>
                                    <a href="<?php echo e(route('questions_options.edit',[$questions_option->id])); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('quickadmin.edit'); ?></a>
                                    <?php echo Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['questions_options.destroy', $questions_option->id])); ?>

                                    <?php echo Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')); ?>

                                    <?php echo Form::close(); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5"><?php echo app('translator')->getFromJson('quickadmin.no_entries_in_table'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        window.route_mass_crud_entries_destroy = '<?php echo e(route('questions_options.mass_destroy')); ?>';
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>