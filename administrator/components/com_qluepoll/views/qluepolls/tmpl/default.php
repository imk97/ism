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
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="controller" value="qluepoll" />
	<?php echo JHtml::_('form.token'); ?>

	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo 'ID'; ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
			<th width="70%">
				<?php echo 'Question' ;?>
			</th>
			<th>User Votes</th>
			<th width="7%">
				<?php echo 'Votes' ?>
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
							<a href="<?php echo JRoute::_('index.php?option=com_qluepoll&task=qluepoll.edit&id=' . $row->id); ?>" title="<?php echo 'edit'; ?>"><?php echo  $row->question; ?></a>

						</td>
						<td><a href="<?php echo JRoute::_('index.php?option=com_qluepoll&view=qluepollvote&id=' . $row->id); ?>">User Votes</a></td>
						<td align="center">
							<a href="<?php echo JRoute::_('index.php?option=com_qluepoll&view=qluepoll&layout=votes&id=' . $row->id); ?>" title="<?php echo 'votes'; ?>"><?php echo $row->votes; ?> (Analytics)</a>
						</td>

					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</form>


