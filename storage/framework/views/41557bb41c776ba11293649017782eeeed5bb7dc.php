<?php $__env->startComponent('mail::message'); ?>
# Account created

Click on the button to activate your account

<?php $__env->startComponent('mail::button', ['url' => route('activate-account', $user->activation_token)]); ?>
Button Text
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
