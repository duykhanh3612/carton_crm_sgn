<?php if (@$GLOBALS['module']['left_navigation']) : ?>
<component id="component-left_navigation" is-ajax data-ajax="<?= @$ajax ?>" data-return="html" data-module="<?= @$module ?>" data-model="<?= @$model ?>"></component>
<script src="assets/js/drag_left_navigation_menu.js?ver=31012023"></script>
<?php endif ?>