<?php

// global
global $field_group;

?>
<div class="acf-field">
	<div class="acf-label">
		<!-- <label><?php _e('Rules', 'acf'); ?></label> -->
		<label><?php _e('Quy tắc', 'acf'); ?></label>
		<!-- <i tabindex="0" class="acf-icon acf-icon-help acf-js-tooltip" title="<?php esc_attr_e('Create a set of rules to determine which edit screens will use these advanced custom fields', 'acf'); ?>">?</i> -->
		<i tabindex="0" class="acf-icon acf-icon-help acf-js-tooltip" title="<?php esc_attr_e('Tạo một bộ quy tắc để xác định màn hình chỉnh sửa nào sẽ sử dụng các trường tùy chỉnh nâng cao này', 'acf'); ?>">?</i>
	</div>
	<div class="acf-input">
		<div class="rule-groups">

			<?php
			foreach ($field_group['location'] as $i => $group) :

				// bail early if no group
				if (empty($group)) {
					return;
				}


				// view
				acf_get_view(
					'html-location-group',
					array(
						'group'    => $group,
						'group_id' => "group_{$i}",
					)
				);

			endforeach;
			?>

			<!-- <h4><?php _e('or', 'acf'); ?></h4> -->
			<h4><?php _e('hoặc', 'acf'); ?></h4>

			<!-- <a href="#" class="button add-location-group"><?php _e('Add rule group', 'acf'); ?></a> -->
			<a href="#" class="button add-location-group"><?php _e('Thêm nhóm trường mới', 'acf'); ?></a>

		</div>
	</div>
</div>
<script type="text/javascript">
	if (typeof acf !== 'undefined') {

		acf.newPostbox({
			'id': 'acf-field-group-locations',
			'label': 'left'
		});

	}
</script>