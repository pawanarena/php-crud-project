<div class="pagination">
		<?php if ($currentPage > 1): ?>
			<a class="page-link" href="/list_users/<?= $currentPage - 1 ?>">Previous</a>
		<?php else: ?>
			<span class="page-link disabled">Previous</span>
		<?php endif; ?>
		<?php
			$startPage = max(1, $currentPage - 2);
			$endPage = min($currentPage + 2, $totalPages);
			if ($startPage > 1) {
				echo '<a class="page-link" href="/list_users/1">1</a>';
				if ($startPage > 2) {
					echo '<span class="separator">...</span>';
				}
			}
			for ($i = $startPage; $i <= $endPage; $i++): 
		?>
			<?php if ($i == $currentPage): ?>
				<span class="page-link active"><?php echo $i; ?></span>
			<?php else: ?>
				<a class="page-link" href="/list_users/<?= $i; ?>"><?php echo $i; ?></a>
			<?php endif; ?>
		<?php endfor; ?>
		<?php
			if ($endPage < $totalPages) {
				if ($endPage < ($totalPages - 1)) {
					echo '<span class="separator">...</span>';
				}
				echo '<a class="page-link" href="/list_users/' . $totalPages . '">' . $totalPages . '</a>';
			}
		?>
		<?php if ($currentPage < $totalPages): ?>
			<a class="page-link" href="/list_users/<?= $currentPage + 1 ?>">Next</a>
		<?php else: ?>
			<span class="page-link disabled">Next</span>
		<?php endif; ?>
	</div>