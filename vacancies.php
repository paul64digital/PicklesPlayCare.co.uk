<?php $title="Pickles Playcare Vacancies &amp; Fees"; include('./includes/header.php')?>

<p class="subtitle">Vacancies</p>
<p>I have full and part time vacancies available for children aged 0 to 8 years.</p>
<p>I am able to drop off and collect children from Bean Primary School and can do a preschool run for Jumping Beans Village Preschool.</p>

<p><br/>Please contact me for vacancy information</p>

<p class="subtitle">Fees</p>
<p>My hours of care are from 7.30am until 6.30pm.</p>
<p>I charge an hourly rate of &pound;4.50 per child and accept payment from parents/guardians as well as any childcare voucher scheme.</p>

<p><br/></p>

<script type="text/javascript" src="js/pricecalc.js"></script>

<?php
	function date_add($givendate,$hour=0,$min=0,$sec=0,$mth=0,$day=0,$yr=0) {
		$cd = strtotime($givendate);
		$newdate = /*date('Y-m-d H:i:s',*/ mktime(	date('H',$cd)+$hour,
												date('i',$cd)+$min, 
												date('s',$cd)+$sec,
												date('m',$cd)+$mth,
												date('d',$cd)+$day, 
												date('Y',$cd)+$yr
											)
					/*)*/;
		return $newdate;
	}
	
	function getOptions($selected) {
	
		/*Set the start time and end time*/
		$nextTime = "07:30";
		//$lastTime = "18:30"
	
		for ( $counter = 0; $counter <= 22; $counter += 1) {
			$options = $options . "<option value='$nextTime'";
			
			if ($selected == $nextTime) {
				$options = $options . " selected='selected'";
			}
			
			$options = $options . ">$nextTime</option>";
			
			$nextTime = date('H:i',date_add($nextTime,0,30,0,0,0,0));
		}
		
		return $options;
	}
?> 

<p class="subtitle">Price Calculator</p>
<p>If you would like to calculate your fees please use the calculator below.</p>
<p>NOTE: If you only require before and after school hours you would need to do two calculations; One for before school and one for after.</p>
<!--please work out the total hours your child will be in my care e.g 8am until 9.00am and 3.00pm until 6.30pm =4.5 hours per day-->

<form id='price_calc' method='post' action=''>
<table style="margin:auto">
<tr>
	<td>Start Time:</td>
	<td><select name='start' id='start'><?php print getOptions("07:30"); ?></select></td>
</tr>
<tr>
	<td>End Time:</td>
	<td><select name='end' id='end'><?php print getOptions("18:30"); ?></select></td>
</tr>
<tr>
	<td>No. of Days:</td>
	<td><input type='text' name='days' id='days' value='3' size='5' style="text-align:right"/></td>
</tr>
<tr>
	<td colspan='2' style="text-align:center"><input type='button' name='calc' id='calc' value='Calculate' onclick='calc_price(this.form)' /> <input type='reset' id='reset' value='Start Over'/></td>
</tr>
<tr>
	<td>Cost per day:</td>
	<td><input type='text' name='cp_day' id='cp_day' value='' size='5' style="text-align:right"/> <span class="watermark">Number of hours x hourly rate</span></td>
</tr>
<tr>
	<td>Cost per week:</td>
	<td><input type='text' name='cp_week' id='cp_week' value='' size='5' style="text-align:right"/> <span class="watermark">Cost per day x number of days</span></td>
</tr>
<tr>
	<td>Cost per month:</td>
	<td><input type='text' name='cp_mnth' id='cp_mnth' value='' size='5' style="text-align:right"/> <span class="watermark">Cost per week x 52(weeks) / 12(months)</span></td>
</tr>
</table>
</form>

<?php include('./includes/footer.php')?>