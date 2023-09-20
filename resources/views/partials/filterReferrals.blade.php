
<form action="{{ route('referrals.search') }}" class="frm-search" method="POST">
	{{ csrf_field() }}
	<input type="search" name="search" placeholder="search referrals..." class="form-input">
	<button type="submit" class="btn btn-primary btn">Filter</button>
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
		width:300px;
    }
	.btn{
		margin-left: 10px;
		
	}
</style>
