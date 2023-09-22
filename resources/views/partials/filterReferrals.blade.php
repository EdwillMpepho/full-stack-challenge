
<form action="{{ route('referrals.search') }}" class="frm-search" method="POST">
	{{ csrf_field() }}
	<select name="filter" class="form-input">
		<option value="">please select filter/search</option>
		<option value="reference_no">reference Number</option>
		<option value="country">country</option>
		<option value="province">province</option>
		<option value="organisation">organisation</option>
		<option value="district">district</option>
		<option value="city">city</option>
		<option value="street_address">street_address</option>
		<option value="zipcode">zipcode</option>
		<option value="gps_location">gps location</option>
		<option value="facility_name">facility name</option>
		<option value="facility_type">facility type</option>
		<option value="provider_name">provider name</option>
		<option value="position">position</option>
		<option value="phone">phone</option>
		<option value="email">email</option>
		<option value="website">website</option>
		<option value="pills_available">pills_available</option>
		<option value="code_to_use">code to use</option>
		<option value="type_of_service">type of service</option>
		<option value="note">note</option>
		<option value="women_evaluation">women evaluation</option>
	</select>
	<input type="search" name="search" class="form-text" placeholder="search ...">
	<button type="submit" class="btn btn-primary btn-search">search</button>
</form>

<style>
	.frm-search{
		display:flex;
		justify-content: flex-start;
		align-items: flex-start;
		flex-direction:row;
	}
	.form-input{
		margin-top: 10px;
		border:none;
		outline: none;
		border-bottom: 1px solid #ccc;
		width:200px;
		height: 40px;
	}
	.form-text{
		margin-top: 20px;
		margin-left: 10px;
		border:none;
		outline: none;
		border-bottom: 1px solid #ccc;
		width:200px;
	}
	.btn{
		margin-left: 10px;
	}
	.btn-search{
		margin-top: 15px;
	}
	
</style>
