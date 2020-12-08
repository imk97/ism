<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_qluepoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<form action="index.php" method="post" id="adminForm" name="adminForm">
	<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
	<input type="hidden" name="option" value="com_qluepoll" />
	<input type="hidden" name="view" value="qluepollvote" />
	<input type="hidden" name="id" value="<?=$this->poll_id?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="controller" value="qluepollvote" />
	<?php echo JHtml::_('form.token'); ?>

	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo 'ID'; ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="10%">
				Name
			</th>
			<th width="10%">
				IP Address
			</th>
			<th width="7%">
				Answer
			</th>
			<th>
				Voted at
			</th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) : ?>

					<tr>
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
							<a href="<?php echo JRoute::_('index.php?option=com_users&view=user&layout=edit&id=' . $row->user_id); ?>" title="<?php echo 'view'; ?>"><?php echo $row->username; ?></a>

						</td>
                        <td> 
							<?=$row->ip?>
                        </td>
						<td>
							<?=$this->awnsers[$row->awnser_id]?>
						</td>
						<td>
							<?=$row->voted_at?>
						</td>

					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</form>


