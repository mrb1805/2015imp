<div class="widget">
    <h2>Stats</h2>
    <div class="inner">
		<?php
		//Setting Fucntions to Varibles 
		$user_count_all = user_count_all();
		$user_count = user_count();
		$user_count_admin = user_count_admin();
		
		//Counting to decide suffix
		$reg_suffix = ($user_count !=1) ? 's' : '';
		$all_suffix = ($user_count_all !=1) ? 's' : '';
		$admin_suffix = ($user_count_admin !=1) ? 's' : '';
		?>
	    <ul>
			<li>We currently have <?php echo user_count(); ?> activated user<?php echo $reg_suffix; ?>.</li>
			
		    <li>We currently have <?php echo user_count_all(); ?> user<?php echo $all_suffix; ?> in the database.</li>
			
			<li>We currently have <?php echo user_count_admin(); ?> admin<?php echo $admin_suffix; ?>.</li>
		</ul>
    </div>
</div>